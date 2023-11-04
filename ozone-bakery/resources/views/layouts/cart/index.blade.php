@extends('layouts.main')

@section('content')
    @php
        $totalPrice = 0;
    @endphp
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
        <h1 class="text-3xl font-semibold mt-10 ml-10 mb-6">
            Shopping Cart</h1>
        @if ($carts->isEmpty())
            <!-- No products message -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <!-- Body -->

                        <div class="bg-stone-200 rounded-xl shadow-lg mt-0 mb-4 p-4 sm:p-7" style="width: 100%;">
                            <div class="max-w-sm w-full min-h-[400px] flex flex-col justify-center mx-auto px-6 py-4">
                                <h2 class="mt-5 font-semibold text-2xl text-gray-800 dark:text-black text-center">
                                    No products ?
                                </h2>
                                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400 text-center">
                                    Find yourself a nice bakery below
                                </p>
                                <div class="mt-5 grid sm:flex gap-2 justify-center">
                                    <a href="/products"
                                        class="text-3lg py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-stone-500 text-white hover:bg-stone-600 focus:outline-none transition-all">
                                        
                                        Select a product
                                    </a>
                                </div>

                            </div>
                            <!-- End Body -->
                        </div>
                    </div>
                </div>
            </div>
        @else
            @foreach ($carts as $item)
                <div class="max-w-screen-lg px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
                    <div class="bg-white rounded-xl shadow-lg mt-7 p-4 sm:p-7 ">
                        <div class="mb-3 flex flex-wrap">
                            <section class="flex flex-col items-center justify-center w-[25%] max-md:w-full">
                                <div class="flex flex-wrap items-center">
                                    <img src="{{ asset($item->product->image_path) }}" class="h-40 w-40 rounded-3xl">
                                </div>
                            </section>

                            <section class="flex flex-col items-stretch w-[40%] ml-5 max-md:w-full">
                                <h2 class="mt-2 text-3xl font-bold text-gray-800 text-black text-left">
                                    {{ $item->product->name }}
                                </h2>
                                <span class="item-price text-xl mt-auto mb-3">Price:
                                    {{ $item->product->price }} Baht
                                </span>
                                <h1 class="text-2xl font-semibold mt-auto mb-3">
                                    Quantity: <input class="quantityInput  text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all" style="border-width: 4px;"
                                        type="number" data-cart="{{ $item }}"
                                        data-price="{{ $item->product->price }}" onchange="onQuantityInputChange()"
                                        style="border-width: 2px;"
                                        class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                        name="cart_items[{{ $item->id }}][amount]" value="{{ $item->amount }}"
                                        min="0" max="100">
                                </h1>
                            </section>
                            <section class="flex flex-col items-stretch w-[20%] ml-auto mt-auto max-md:w-full">
                                <span class="item-price text-2xl font-semibold mt-auto mb-3">
                                    Total:
                                    <span id="totalPrice{{ $item->id }}"></span>
                                    Baht
                                </span>
                            </section>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    </div>

    <div class="max-w-screen-lg px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
        @if (!$carts->isEmpty())
        <hr class="mt-3" style="border-color: #c4b7a6; border-width: 2px; width: 100%;">
        <div class="text-3xl font-semibold ml-auto mt-5 flex justify-between">
            <div class="flex items-center">
                <span class="ml-10 font-bold">Total Price:</span>
            </div>
            <div class="flex items-center">
                <span class="mr-10" id="totalPrice">{{ $totalPrice }}</span>
                Baht
            </div>
        </div>
        <div class="mt-5 ml-10">
            <span class="text-2xl font-semibold">Pickup Date: </span>
            <input class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all" style="border-width: 4px;"
            type="date" value="{{ $pickupDate }}" id="pickupDate" onchange="onPickupDateChange()">
            <button onclick="onConfirmChangeButtonClicked()" id="confirmChangeButton"
                class="flex flex-wrap block mt-7 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all p-5 mr-10"
                style="display: none;">
                Confirm Changes
            </button>
        </div>
        @endif
    </div>

    <div class="max-w-screen-lg ml-auto mr-auto px-4 py-1 sm:px-2 lg:px-2 lg:py-1">
        @if (!$carts->isEmpty())
            <div class="text-3xl font-semibold ml-auto mb-5 flex justify-between">
                <button id="checkoutButton" onclick="onCheckoutButtonClicked()"
                    class="flex flex-wrap block mt-5 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all p-5 mr-10">
                    Checkout
                </button>
            </div>
        @endif
    </div>
    


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ("{{ $carts->isEmpty() ? 'true' : 'false' }}") {
                document.getElementById('checkoutButton').style.display = 'none';
            }
            fetchData();
        });

        function fetchData() {
            const quantityInputs = document.getElementsByClassName("quantityInput");
            for (const quantityInput of quantityInputs) {
                const cart = JSON.parse(quantityInput.getAttribute('data-cart'));
                fetch('/products/' + cart.product_id + '/stocks', {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(cart.product_id + " stock : " + data);
                        if (quantityInput.value > data) {
                            quantityInput.value = data;
                        }
                        quantityInput.max = data;
                    })
                    .catch(error => console.error(error));
            }
            updateTotalPrice();
        }

        function onCheckoutButtonClicked() {
            location.href = "/checkout";
        }

        function onConfirmChangeButtonClicked() {
            const quantityInputs = document.getElementsByClassName("quantityInput");
            for (const quantityInput of quantityInputs) {
                let cart = JSON.parse(quantityInput.getAttribute('data-cart'));
                let amount = Math.min(quantityInput.value, quantityInput.max);
                console.log("amount: " + amount);
                console.log("quantityInput.max: " + quantityInput.max);
                fetch('/api/carts/' + cart.id, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            amount: amount,
                        })
                    }).then(response => response.json())
                    .then(data => {})
                    .catch(error => {
                        console.error(error);
                    });
            }

            showCheckoutButton();

            setTimeout(function() {
                location.reload();
            }, 500); // 1000 milliseconds = 1 second
        }

        function hideCheckoutButton() {
            document.getElementById('checkoutButton').style.display = 'none';
            document.getElementById('confirmChangeButton').style.display = 'block';
        }

        function showCheckoutButton() {
            document.getElementById('checkoutButton').style.display = 'block';
            document.getElementById('confirmChangeButton').style.display = 'none';
        }

        function onQuantityInputChange() {
            updateTotalPrice();
            hideCheckoutButton();
        }

        function updateTotalPrice() {
            const quantityInputs = document.getElementsByClassName("quantityInput");
            let totalPrice = 0;
            for (const quantityInput of quantityInputs) {
                cart = JSON.parse(quantityInput.getAttribute('data-cart'));
                let price = quantityInput.getAttribute('data-price');
                let totalProductPrice = parseFloat(price) * parseFloat(quantityInput.value);
                document.getElementById('totalPrice' + cart.id).textContent = totalProductPrice;
                totalPrice += totalProductPrice;
            }
            document.getElementById('totalPrice').textContent = totalPrice;
        }

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
                fetchData();
                setTimeout(function() {
                    onConfirmChangeButtonClicked();
                }, 500); // 1000 milliseconds = 1 second
            })
        }
    </script>
@endsection
