@extends('layouts.main')

@section('content')
<!-- Card Section -->
<div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
    <a onclick="goBack()" style="cursor: pointer;" class="flex flex-row mr-auto mt-6 text-2xl font-semibold text-gray-800 dark:text-black">
        <img src="https://cdn-icons-png.flaticon.com/512/3683/3683627.png" alt="" class="h-6 w-6 mr-2 mt-1 mb-2">
        All Products
    </a>
    <!-- Card -->
    <div class="bg-white rounded-xl shadow-lg mt-5 p-4 sm:p-7 ">
        <div class="mb-3 flex flex-wrap">

            <section class="flex flex-col items-stretch w-[30%] max-md:w-full">

                <div style="width: 350px; height: 350px; overflow: hidden;">
                    <img src="{{ asset($product->image_path) }}" class="rounded-3xl" style="object-fit: cover; width: 100%; height: 100%;">
                </div>

            </section>

            <section class="flex flex-col items-stretch w-[40%] ml-8 max-md:w-full">
                <h2 class="mt-2 text-3xl font-bold text-gray-800 text-black" style="font-size: 2.5em;">
                    {{ $product->name }}
                </h2>

                <hr class="mt-4" style="border-color: #c4b7a6; border-width: 2px; width: 100%;">

                <p class="text-xl pl-6 mt-4 mb-10 flex flex-wrap">
                    {{ $product->description }}
                </p>

                </text>

                <div class="flex flex-row mt-auto">
                    <h1 class="text-3xl font-semibold mt-auto mb-3">
                        Price: {{ $product->price }} Baht
                    </h1>

                </div>

            </section>

            <section class="flex flex-col items-stretch w-[25%] mr-5 ml-auto mt-auto max-md:w-full">
                <span id="stock" class="text-xl mt-10 mb-2 font-bold"></span>
                <div class="flex flex-row">
                    <span id="quantityLabel" style="margin-right: 58px;" class="text-xl font-semibold mr-5 mt-2">
                        Amount:
                    </span>
                    <input type="number" id="amount" value="1" min="1" class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all" style="border-width: 4px;">
                </div>

                <div class="flex flex-row">
                    <span class="text-xl font-semibold mr-5 mt-2">Pickup Date: </span>
                    <input class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all" style="border-width: 4px;" type="date" value="{{ $pickupDate }}" id="pickupDate" onchange="onPickupDateChange()">
                </div>

                <button onclick="onAddToCartButtonClicked()" id="addToCartButton" class="flex flex-wrap block mt-3 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                    + | Add to Cart
                </button>
            </section>
        </div>


        <div class="pl-5">


        </div>



    </div>

</div>
<!-- End Card -->
</div>
<!-- End Card Section -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        let stock = "{{$product->getStock($pickupDate)}}";
        document.getElementById("stock").textContent = "Stock: " + stock;
        if (stock == 0) {
            document.getElementById("stock").textContent = "Out of stock";
            document.getElementById("amount").style.display = "none";
            document.getElementById("addToCartButton").style.display = "none";
            document.getElementById("quantityLabel").style.display = "none";
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
        if (!confirm("Are you sure you want to add " + document.getElementById("amount").value + " {{$product->name}} to your cart?")) {
            return;
        }
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