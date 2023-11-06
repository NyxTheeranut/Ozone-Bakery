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
                            <p class="text-xl " style="color: rgb(184, 60, 60)" ;>
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
                @csrf
                <div class="product-container flex flex-wrap max-md:flex-col max-md:items-stretch">
                    <!-- Product cards will be placed in this container -->
                </div>
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

                    <textarea name="description" id="description" cols="30" rows="10" class="ml-5 mr-5 text-xl"
                        style="width: 100%;" placeholder="Describe your custom bakery order (e.g., flavors, design, dietary needs)."></textarea>
                </div>

                <div class="flex flex-col mr-20 w-[40%]">
                    <h1 class="text-3xl text-left font-semibold mr-20">
                        Total Price:
                        <span id="totalPrice">0</span>
                        Baht
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

                    <button id="estimateDateButton" onclick="onEstimateDateButtonClicked()"
                        class="flex flex-wrap block mb-auto py-2 px-3 mr-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                        Estimate Pick-up Date
                    </button>

                    <form action="/mto/checkout" method="POST">
                        @csrf
                        <input type='hidden' name="items" id='items' value=''>
                        <input type='hidden' name="pickup_date" id='pickupDate' value=''>
                        <input type='hidden' name="description" id='description' value=''>
                        <button id="checkoutButton" type="submit"
                            class="flex flex-wrap block mb-auto py-2 px-3 mr-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                            Checkout
                        </button>
                    </form>
                </div>

            </div>

    </section>

    <script>
        function fetchDataFromAPI() {
            fetch('/api/made-to-orders')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (Array.isArray(data.products)) {
                        const products = data.products;
                        const discount = 0.8; // Define the discount value here
                        const productContainer = document.querySelector('.product-container');

                        // Clear any existing content in the container
                        productContainer.innerHTML = '';

                        products.forEach(product => {
                            const productElement = document.createElement('div');
                            productElement.classList.add('flex', 'flex-row', 'items-stretch', 'w-3/12',
                                'max-md:w-full', 'mb-5');
                            productElement.style.flex = '0 0 25%';

                            productElement.innerHTML = `
    <a class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300">
        <img src="${product.image_path}" alt="${product.name}" class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">
        <h3 class="text-2xl font-semibold mx-auto">${product.name}</h3>
        <p class="text-xl mx-auto my-2.5">Price: ${(product.price * discount).toFixed(2)} Baht</p>
        <p class="text-center">
    <input type="number" onchange="onQuantityChange(product)" id="quantity${product.id}" class="quantityInput text-center rounded-3xl border border-stone-200 bg-stone-100 hover-bg-stone-200 transition-all" style="border-width: 4px;" data-price="${product.price * discount}" data-product-id="${product.id}" value="0" min="0">
                    </p>
        <div>
            <h3 class="text-2xl mx-auto text-center font-bold mt-2">Total: <span id="totalPrice${product.id}" class="productTotalPrice">0</span> Baht</h3>
        </div>
    </a>
    <span id="isValid${product.id}" class="isValid" value="1"></span>
    <span id="errorMessage${product.id}" class="text-sm" style="color: rgb(184, 60, 60);"></span>
`;

                            // Add an event listener for quantity change
                            const quantityInput = productElement.querySelector('.quantityInput');
                            quantityInput.addEventListener('change', function() {
                                onQuantityChange(product);
                            });

                            productContainer.appendChild(productElement);
                        });
                    } else {
                        console.error('API response does not contain a valid products array.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function onQuantityChange(product) {
            var quantityInput = document.getElementById("quantity" + product.id);
            var totalPriceElement = document.getElementById("totalPrice" + product.id);
            var errorMessage = document.getElementById("errorMessage" + product.id);
            var isValid = document.getElementById("isValid" + product.id);

            var quantity = quantityInput.value;
            var price = parseFloat(quantityInput.getAttribute("data-price"));

            isValid.value = 1;

            var totalPrice = quantity * price;

            if (quantity == 0) {
                errorMessage.textContent = "";
            } else if (totalPrice < 500) {
                isValid.value = 0;
                errorMessage.textContent = "The minimum purchase requirement is 500 Baht per product.";
            } else {
                errorMessage.textContent = "";
            }

            totalPriceElement.textContent = totalPrice.toFixed(2);
            updateTotalPrice();

            if (checkValid()) onValid();
            else onInValid();
        }

        // Define the discount variable here

        // Call the function to fetch and populate data when needed
        fetchDataFromAPI();


        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("estimateDateButton").style.display = "none";
            document.getElementById("checkoutButton").style.display = "none";
        });

        function updateCheckoutForm() {
            var items = [];
            var quantityInputs = document.getElementsByClassName("quantityInput");
            for (var i = 0; i < quantityInputs.length; i++) {
                var quantity = quantityInputs[i].value;
                if (quantity == 0) {
                    continue;
                }
                var productId = quantityInputs[i].getAttribute("data-product-id");
                items.push({
                    product_id: productId,
                    amount: quantity
                });
            }
            console.log(items, document.getElementById("pickupDate").value, document.getElementById("description")
                .value, );

            document.getElementById("items").value = JSON.stringify(items);
            document.getElementById("pickupDate").value = document.getElementById("pickupDate").textContent;
            document.getElementById("description").value = document.getElementById("description").value;
        }

        function onEstimateDateButtonClicked() {
            var items = [];
            var quantityInputs = document.getElementsByClassName("quantityInput");
            for (var i = 0; i < quantityInputs.length; i++) {
                var quantity = quantityInputs[i].value;
                if (quantity == 0) {
                    continue;
                }
                var productId = quantityInputs[i].getAttribute("data-product-id");
                items.push({
                    product_id: productId,
                    amount: quantity
                });
            }
            console.log(items);
            fetch('/mto/estimate-date', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        items: items
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("estimateDateButton").style.display = "none";
                    document.getElementById("estimatedDate").textContent = data.estimatedDate;
                    document.getElementById("pickupDate").value = data.estimatedDate;
                    document.getElementById("checkoutButton").style.display = "block";
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            updateCheckoutForm();
        }

        function onValid() {
            document.getElementById("checkoutButton").style.display = "none";
            document.getElementById("estimateDateButton").style.display = "block";
        }

        function onInValid() {
            document.getElementById("estimateDateButton").style.display = "none";
            document.getElementById("checkoutButton").style.display = "none";
        }

        function onQuantityChange(product) {
            var quantity = document.getElementById("quantity" + product.id).value;
            var totalPrice = document.getElementById("totalPrice" + product.id);
            var errorMessage = document.getElementById("errorMessage" + product.id);
            var isValid = document.getElementById("isValid" + product.id);

            isValid.value = 1;

            price = (product.price * {{ $discount }} * quantity).toFixed(2);

            if (quantity == 0) {
                errorMessage.textContent = "";
            } else if (price < 500) {
                isValid.value = 0;
                errorMessage.textContent = "The minimum purchase requirement is 500 Baht per product.";
            } else {
                errorMessage.textContent = "";
            }
            totalPrice.textContent = price;
            updateTotalPrice();

            if (checkValid()) onValid();
            else onInValid();
        }

        function updateTotalPrice() {
            productTotalPrices = document.getElementsByClassName("productTotalPrice");
            var totalPrice = 0;
            for (var i = 0; i < productTotalPrices.length; i++) {
                totalPrice += parseFloat(productTotalPrices[i].textContent);
            }
            document.getElementById("totalPrice").textContent = totalPrice.toFixed(2);
        }

        function checkValid() {
            isValid = document.getElementsByClassName("isValid");
            for (var i = 0; i < isValid.length; i++) {
                if (isValid[i].value == 0) {
                    return false;
                }
            }
            if (document.getElementById("totalPrice").textContent < 1000) {
                return false;
            }
            return true;
        }
    </script>
@endsection
