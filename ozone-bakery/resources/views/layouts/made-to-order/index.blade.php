@extends('layouts.main')

@section('content')
    <section class="bg-neutral-100 flex flex-col text-4xl pt-8 pb-20">
        <div class="flex flex-col">
            <div class="flex justify-center w-full">
                <div class="flex flex-col items-stretch w-6/12 w-full">
                    <div id="scrollTarget"
                        class="relative shrink-0 box-border h-auto text-3xl grow-0 w-auto ml-20 mt-5 mb-2.5 pl-10">

                        <h3 class="text-3xl">
                            All Products
                        </h3>

                        <p class="text-lg" style="color: green">
                            For custom orders, all products are available at 20% off.
                        </p>
                        
                        <hr class="mt-3 mb-4" style="border-color: #c4b7a6; border-width: 2px; width: 90%;">


                        <div class="ml-4 mt-2">
                            <p class="text-lg " style="color: rgb(184, 60, 60)";>
                                * Minimum purchase per product is 500 Baht.
                            </p>

                            <p class="text-lg" style="color: rgb(184, 60, 60)">
                                * Minimum purchase per order is 1,000 Baht.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div
                class="flex flex-wrap max-md:flex-col max-md:items-stretch max-md:gap- ml-20 mr-20 pl-20 pr-20 mt-5 mx-auto">
                @csrf
                @foreach ($products as $product)
                    <div class="flex flex-col items-stretch w-3/12 max-md:w-full mb-5">
                        <a
                            class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }} "
                                class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">

                            <h3 class="text-2xl mx-auto">
                                {{ $product->name }}
                            </h3>

                            <p class="text-xl mx-auto my-2.5">
                                Price: {{ $product->price * $discount }} Baht
                            </p>

                            <form id=checkout-form method="GET" action="{{ route('mto-checkout') }}">
                                <p class="justify-content-center">
                                    <input type="hidden" name="items[{{ $product->id }}][product_id]"
                                        value="{{ $product->id }}">
                                </p>

                                <p class="text-center">
                                    <input type="number" class="quantity-input text-center"
                                        data-price="{{ $product->price * $discount }}" data-product-id="{{ $product->id }}"
                                        data-min-price="500" name="items[{{ $product->id }}][amount]" value="0"
                                        min="0">
                                </p>

                            </form>

                            <div>
                                <h3 class="product-total-price text-2xl mx-auto text-center font-bold mt-2">
                                    Total: 0 Baht
                                </h3>

                                <span class="product-error-message" style="color: rgb(184, 60, 60);"></span>
                            </div>

                        </a>
                    </div>
                @endforeach

            </div>
            <div>
                <span id="total-price">
                    Total Price: 0 Baht
                </span>
                <span id="error-message" style="color: red;"></span>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>
                <div>
                    <p id="datePane">Estimated Date: <span id="estimatedDate">Loading...</span></p>
                </div>

                <input type='hidden' name='pickup_date' id='pickup_date' value=''>

                <button id="fetchButton" type="button"
                    class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover.bg-stone-600 transition-all text-sm rounded-3xl">
                    Estimated Date
                </button>
            </div>

            <button id="checkoutButton" type="submit"
                class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover.bg-stone-600 transition-all text-sm rounded-3xl">
                Checkout
            </button>
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
                            "<span class='error-message text-xl mx-auto'>Total price must be more than 500</span>";
                    } else {
                        productErrorElement.innerHTML = ""; // Clear the error message
                    }


                    total += productTotal;
                });

                totalPriceElement.textContent = `Total Price: ${total.toFixed(2)} Baht`;

                // Check if the total price is greater than 1000
                if (total > 1000) {
                    totalPriceElement.style.color = "green"; // Change color to green for total price
                    totalPriceElement.textContent += " (Eligible for Continue)";
                    showEstimatedDate();
                } else {
                    totalPriceElement.style.color = "red"; // Change color to red for total price
                    totalPriceElement.textContent += " (Total must be more than 1000 to Continue)";
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
