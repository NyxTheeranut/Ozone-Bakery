@extends('layouts.main')

@section('content')
    <form method="POST" action="{{ route('cart.update') }}" id="cart-form">
        @csrf
        @method('PUT')

        @php
            $totalPrice = 0;
        @endphp
        <div>
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
                                <h2 class="mt-8 text-3xl font-bold text-gray-800 text-black text-left">
                                    {{ $item->product->name }}
                                </h2>

                                <h1 class="text-2xl font-semibold mt-auto mb-3">
                                    Quantities: <input type="number" class="quantity-input text-center rounded-xl"
                                        name="cart_items[{{ $item->id }}][amount]" value="{{ $item->amount }}"
                                        min="0" max="100"> pieces
                                </h1>
                            </section>
                            <section class="flex flex-col items-stretch w-[20%] ml-auto mt-auto max-md:w-full">
                                <span class="item-price text-2xl font-semibold mt-auto mb-3">Price:
                                    {{ $item->product->price }} Baht</span>
                            </section>
                        </div>
                    </div>
                </div>
                @php
                    $totalPrice += $item->product->price * $item->amount;
                @endphp
            @endforeach
        </div>
        <div class="flex flex-row">
            <div class=" black mt-auto py-2 px-3 ml-10 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl transition-all text-sm rounded-3xl p-5 mr-10">
            <h class="font-bold">Total Price:</h>
            <h id="total-price">{{ $totalPrice }}</h>
            </div>

            <button type="submit"
                class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all text-sm rounded-3xl p-5 mr-10"
                style="display: none;">
                Confirm Changes
            </button>

            <form method="GET" action="{{ route('checkout') }}" id="checkout-form">
                @foreach ($carts as $item)
                    <input type="hidden" name="cart_items[{{ $item->id }}][product]" value="{{ $item->product->id }}">
                    <input type="hidden" name="cart_items[{{ $item->id }}][quantity]" value="{{ $item->amount }}">
                @endforeach
                <button type="submit" id="checkout-button"
                    class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all text-sm rounded-3xl p-5 mr-10">
                    Checkout
                </button>
            </form>
        </div>


    </form>



    <script>
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const form = document.getElementById('cart-form');
        const checkoutButton = document.getElementById('checkout-button');
        const totalPriceElement = document.getElementById('total-price');

        quantityInputs.forEach(input => {
            input.addEventListener('input', () => {
                updatePrice(input);
            });
        });

        function updatePrice(input) {
            const itemPrice = input.closest('div').querySelector('.item-price');
            const productPrice = parseFloat(itemPrice.textContent); // Get the original product price
            const newQuantity = parseFloat(input.value); // Get the new quantity

            // Recalculate the total price
            let totalPrice = 0;
            quantityInputs.forEach(input => {
                const itemPrice = input.closest('div').querySelector('.item-price');
                const quantity = parseFloat(input.value);
                totalPrice += parseFloat(itemPrice.textContent) * quantity;
            });
            totalPriceElement.textContent = totalPrice;

            // Show the "Confirm Changes" button
            const confirmButton = form.querySelector('button[type="submit"]');
            confirmButton.style.display = 'block';

            // Show the "Checkout" button
            checkoutButton.style.display = 'none';
        }
    </script>
@endsection
