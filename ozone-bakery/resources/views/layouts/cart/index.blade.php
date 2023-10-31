@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('cart.update') }}" id="cart-form">
    @csrf
    @method('PUT')

    @php
    $totalPrice = 0;
    @endphp

    @foreach ($carts as $item)
    <div>
        <img src="{{ asset($item->product->image_path) }}" alt="{{ $item->product->name }}" class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">
        Product Name: {{ $item->product->name }}
        Quantity:
        <input type="number" class="quantity-input" name="cart_items[{{ $item->id }}][amount]" value="{{ $item->amount }}" min="0" max="100">
        Price: <span class="item-price">{{ $item->product->price}}</span>
    </div>
    @php
    $totalPrice += $item->product->price * $item->amount;
    @endphp
    @endforeach

    <div>
        <strong>Total Price:</strong> <span id="total-price">{{ $totalPrice }}</span>
    </div>

    <button type="submit" class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all text-sm rounded-3xl" style="display: none;">
        Confirm Changes
    </button>
</form>

<form method="GET" action="{{ route('checkout') }}" id="checkout-form">
    @foreach ($carts as $item)
        <input type="hidden" name="cart_items[{{ $item->id }}][product]" value="{{ $item->product->id }}">
        <input type="hidden" name="cart_items[{{ $item->id }}][quantity]" value="{{ $item->amount }}">
    @endforeach
    <button type="submit" id="checkout-button" class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all text-sm rounded-3xl">
        Checkout
    </button>
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
