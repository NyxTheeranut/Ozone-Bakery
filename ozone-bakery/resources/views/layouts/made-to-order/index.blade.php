@extends('layouts.main')

@section('content')
    <section class="bg-neutral-100 flex flex-col text-4xl pt-8 pb-20">
        <div class="flex flex-col">
            <div class="flex justify-center w-full">
                <div class="flex flex-col items-stretch w-6/12 w-full">
                    <div id="scrollTarget"
                        class="relative shrink-0 box-border h-auto text-3xl grow-0 w-auto ml-20 mt-5 mb-2.5 pl-20">

                        <h3 class="text-3xl mb-2">
                            Custom Orders
                        </h3>

                        <p class="text-xl ml-5" style="color: #008000">
                            For custom orders, all products are available at 20% off.
                        </p>

                        <div class="ml-4 mt-2">
                            <p class="text-xl " style="color: rgb(184, 60, 60)";>
                                The minimum purchase requirement is 500 Baht per product and 1,000 Baht per order.
                            </p>
                        </div>

                        <hr class="mt-3" style="border-color: #c4b7a6; border-width: 2px; width: 90%;">

                        <p class="text-lg mt-5 bg-stone-200 py-3 p-2 rounded-xl" style="max-width: 35%;">
                            1. Select the type of products and specify the quantity you want.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap max-md:flex-col max-md:items-stretch max-md:gap- ml-20 mr-20 pl-20 pr-20 mx-auto">
                <form id=checkout-form method="GET" action="{{ route('mto-checkout') }}">
                @csrf
                @foreach ($products as $product)
                    <div class="flex flex-row items-stretch w-3/12 max-md:w-full mb-5" style="flex: 0 0 25%;">
                        <a
                            class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }} "
                                class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">

                            <h3 class="text-2xl font-semibold mx-auto">
                                {{ $product->name }}
                            </h3>

                            <p class="text-xl mx-auto my-2.5">
                                Price: {{ $product->price * $discount }} Baht
                            </p>

                            
                                <p class="justify-content-center">
                                    <input type="hidden" name="items[{{ $product->id }}][product_id]"
                                        value="{{ $product->id }}">
                                </p>

                                <p class="text-center">
                                    <input type="number"
                                        class="quantity-input text-center rounded-3xl border border-stone-200 bg-stone-100 hover:bg-stone-200 transition-all"
                                        style="border-width: 4px;" data-price="{{ $product->price * $discount }}"
                                        data-product-id="{{ $product->id }}" data-min-price="500"
                                        name="items[{{ $product->id }}][amount]" value="0" min="0">
                                </p>

                            

                            <div>
                                <h3 class="product-total-price text-2xl mx-auto text-center font-bold mt-2">
                                    Total: 0 Baht
                                </h3>

                            </div>

                        </a>

                        <span class="product-error-message ml-5" style="color: rgb(184, 60, 60);"></span>

                    </div>
                @endforeach
                <hr class="mt-3 mb-4" style="border-color: #c4b7a6; border-width: 2px; width: 100%;">

                <p class="text-lg mt-5 mb-5 bg-stone-200 py-3 p-2 rounded-xl" style="max-width: 50%;">
                    2. Tell us about the details and estimate the avalable pick-up date.
                </p>
            </div>

            <div class="flex flex-row w-full justify-center">

                <div class="flex flex-row ml-20 mb-auto w-[60%]">
                    <h1 class="text-3xl ml-20">
                        Description:
                    </h1>

                    <textarea name="description" id="description" cols="30" rows="10" class="ml-5 mr-5 text-xl" style="width: 100%;"
                        placeholder="Describe your custom bakery order (e.g., flavors, design, dietary needs)."></textarea>
                </div>

                <div class="flex flex-col mr-20 w-[40%]">
                    <h1 id="total-price" class="text-3xl text-left font-semibold mr-20">
                        Total Price: 0 Baht
                    </h1>
                    <span id="error-message" class="text-sm" style="color: rgb(184, 60, 60);"></span>

                    <div class="mt-5 mb-5">
                        <p id="datePane" class="text-3xl font-semibold">
                            Estimated Date:
                            <span id="estimatedDate">
                                Loading...
                            </span>
                        </p>
                    </div>

                    <input type='hidden' name='pickup_date' id='pickup_date' value=''>

                    <button id="fetchButton" type="button"
                        class="flex flex-wrap block mb-auto py-2 px-3 mr-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                        Estimate Pick-up Date
                    </button>

                    <button id="checkoutButton" type="submit"
                        class="flex flex-wrap block mt-auto py-2 px-3 ml-auto mr-20 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                        <p class="">
                            Checkout
                            </p>
                    </button>
                </div>
            
            </div>
</form>

    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const quantityInputs = document.querySelectorAll(".quantity-input");
            const productTotalPriceElements = document.querySelectorAll(".product-total-price");
            const productErrorMessages = document.querySelectorAll(".product-error-message");
            const totalPriceElement = document.getElementById("total-price");
            const checkoutForm = document.getElementById("checkout-form");

            const items = [];

            function hideCheckoutButton() {
                document.getElementById("checkoutButton").style.display = "none";
            }

            function hideEstimatedDate() {
                document.getElementById("fetchButton").style.display = "none";
            }

            function showCheckoutButton() {
                document.getElementById("checkoutButton").style.display = "block";
            }

            function showEstimatedDate() {
                console.log('Showing estimated date...');
                document.getElementById("fetchButton").style.display = "block";
            }

            hideCheckoutButton();
            hideEstimatedDate();

            // Calculate and update the total price for each product and the overall total price
            function updatePrices() {
                hideCheckoutButton();

                let total = 0;
                let allProductsValid = true; // Flag to track product validity

                quantityInputs.forEach((input, index) => {
                    const price = parseFloat(input.getAttribute("data-price"));
                    const quantity = parseFloat(input.value);
                    const minPrice = parseFloat(input.getAttribute("data-min-price"));
                    const productTotalPriceElement = productTotalPriceElements[index];
                    const productErrorElement = productErrorMessages[index];
                    const productTotal = price * quantity;

                    productTotalPriceElement.textContent = `Total: ${productTotal.toFixed(2)} Baht`;

                    // Check if product total is valid
                    if (productTotal < minPrice && quantity > 0) {
                        allProductsValid = false;
                        productErrorElement.innerHTML =
                            "<span class='error-message text-lg mx-auto'>* The total price must exceed 500 Baht.</span>";
                    } else {
                        productErrorElement.innerHTML = ""; // Clear the error message
                    }


                    total += productTotal;
                });

                totalPriceElement.textContent = `Total Price: ${total.toFixed(2)} Baht`;

                // Check if the total price is greater than 1000
                if (total >= 1000) {
                    totalPriceElement.style.color = "#008000"; // Change color to green for total price
                    showEstimatedDate();
                } else {
                    totalPriceElement.style.color = "rgb(184, 60, 60)"; // Change color to red for total price
                    totalPriceElement.innerHTML +=
                        "<br> <p class='text-xl mt-2'>* Total must be more than 1,000 Baht to continue.</p>";
                    hideEstimatedDate();
                }

                // Enable or disable the submit button and show error message
                if (!allProductsValid) {
                    hideEstimatedDate();
                }
            }

            // Listen for input changes on quantity inputs
            quantityInputs.forEach((input) => {
                input.addEventListener("input", updatePrices);
            });

            // Listen for fetchButton click
            fetchButton.addEventListener('click', fetchEstimatedDate);

            // Initial calculation
            updatePrices();

            // Create the request body with the collected items
            const requestBody = {
                items: items,
            };

            function fetchEstimatedDate() {
                console.log('Fetching estimated date...');

                // Clear the items array
                items.length = 0;

                quantityInputs.forEach(input => {
                    const productID = input.getAttribute("data-product-id");
                    const amount = input.value;

                    console.log(`Product ID: ${productID}, Amount: ${amount}`);

                    // Only add items with a non-zero amount
                    if (amount > 0) {
                        items.push({
                            product_id: productID,
                            amount: amount
                        });
                    }
                });

                fetch('{{ route('mto-estimate-date') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(requestBody),
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('estimatedDate').textContent = data.estimatedDate;
                        document.getElementById('pickup_date').value = data.estimatedDate;
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                hideEstimatedDate();
                showCheckoutButton();
            }
        });
    </script>
@endsection