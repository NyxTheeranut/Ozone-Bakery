@extends('layouts.main')

@section('content')
    <!-- Card Section -->
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
        <a onclick="goBack()" style="cursor: pointer;"
            class="flex flex-row mr-auto mt-6 text-2xl font-semibold text-gray-800 dark:text-black">
            <img src="https://cdn-icons-png.flaticon.com/512/3683/3683627.png" alt="" class="h-6 w-6 mr-2 mt-1 mb-2">
            All Products
        </a>
        <!-- Card -->
        <div class="bg-white rounded-xl shadow-lg mt-5 p-4 sm:p-7 ">
            <div class="mb-3 flex flex-wrap">

                <section class="flex flex-col items-stretch w-[30%] max-md:w-full">

                    <div class="flex flex-wrap items-start mt-3 ml-4">
                        <img id="product-image" class="h-90 w-90 rounded-3xl">
                    </div>
                </section>

                <section class="flex flex-col items-stretch w-[40%] ml-8 max-md:w-full">
                    <h2 id="product-name" class="mt-2 text-3xl font-bold text-gray-800 text-black"
                        style="font-size: 2.5em;">
                    </h2>

                    <hr class="mt-4" style="border-color: #c4b7a6; border-width: 2px; width: 100%;">

                    <p id="product-description" class="text-xl pl-6 mt-4 mb-10 flex flex-wrap">
                    </p>

                    <div class="flex flex-col mt-auto">
                        <span id="stock" class="text-xl mt-10 mb-2"></span>
                        <div class="flex flex-row mt-auto">
                            <h1 class="text-3xl font-semibold mt-auto mb-3">
                                Price: <span id="product-price"></span> Baht
                            </h1>
                        </div>
                    </div>
                </section>

                <section class="flex flex-col items-stretch w-[25%] mr-5 ml-auto mt-auto max-md:w-full">

                    <div class="flex flex-row">
                        <span class="text-xl font-semibold mr-5 mt-2">
                            Amount:
                        </span>
                        <input type="number" id="amount" value="1" min="1"
                            class="flex flex-wrap block mt-auto py-2 px-3 mr-auto ml-9 
                        text-center rounded-3xl border border-stone-200 
                        font-semibold text-xl bg-stone-100 hover-bg-stone-200 transition-all 
                        text-sm rounded-3xl text-center mb-4"
                            style="border-width: 4px;">
                    </div>

                    <div class="flex flex-row">
                        <span class="text-xl font-semibold mr-5 mt-2">Pickup Date: </span>
                        <input
                            class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover-bg-white transition-all"
                            style="border-width: 4px;" type="date" value="{{ $pickupDate }}" id="pickupDate"
                            onchange="onPickupDateChange()">
                    </div>

                    <button onclick="onAddToCartButtonClicked()"
                        class="flex flex-wrap block mt-3 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all text-sm rounded-3xl">
                        + | Add to Cart
                    </button>
                </section>
            </div>
        </div>
    </div>
    <div id="popup" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
        <div class="absolute w-60 p-4 bg-green-500 text-white rounded-md">
            Product has been added
        </div>
    </div>
    <!-- End Card -->

    <!-- End Card Section -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            // Fetch product data from the API endpoint
            fetch('/api/products/{{ $product->id }}')
                .then(response => response.json())
                .then(data => {
                    // Update the product details in your HTML
                    document.getElementById("product-name").textContent = data.name;
                    document.getElementById("product-description").textContent = data.description;
                    document.getElementById("product-price").textContent = data.price ;
                    document.getElementById("product-image").src = data.image_path; // Set the image source


                    // Handle other data as needed
                })
                .catch(error => {
                    console.error("Error fetching product data: " + error);
                });
        });
        document.addEventListener("DOMContentLoaded", function(event) {
            let stock = "{{ $product->getStock($pickupDate) }}";
            document.getElementById("stock").textContent = "Stock: " + stock;
            if (stock == 0) {
                document.getElementById("stock").textContent = "Out of stock";
                document.getElementById("amount").style.display = "none";
                document.getElementById("addToCardButton").style.display = "none";
            }
            document.getElementById("amount").max = stock;
            if (document.getElementById("amount").value > stock) {
                document.getElementById("amount").value = stock;
            }
            const now = new Date().toISOString().slice(0, 10);
            document.getElementById("pickupDate").setAttribute('min', now);
        });

        function onPickupDateChange() {
            fetch('/pickupDate', {
                method: 'PUT',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    pickupDate: document.getElementById('pickupDate').value
                })
            }).then(response => {
                location.reload();
            })
        }


        function onAddToCartButtonClicked() {
            // Send a fetch POST request to the route
            fetch("/api/carts", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        user_id: "{{ Auth::user()->id }}",
                        product_id: "{{ $product->id }}",
                        amount: document.getElementById("amount").value,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response as needed, e.g., update the UI
                    console.log("Success: " + data);

                    // Show the pop-up
                    const popup = document.getElementById('popup');
                    popup.style.display = 'block';

                    // Automatically hide the pop-up after 3 seconds
                    setTimeout(function() {
                        popup.style.display = 'none';
                    }, 3000);
                })
                .catch(error => {
                    // Handle errors if any
                    console.error("Error: " + error);
                });
        }

        function goBack() {
            window.history.back();
        }
    </script>
@endsection
