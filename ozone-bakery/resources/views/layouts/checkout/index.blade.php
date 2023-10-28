@extends('layouts.main')

@section('content')

@foreach ($cartItems as $cartItem)
@php
$totalPrice = 0;
@endphp
<div>
    <p>
        Product: {{ $cartItem['product']->name }}
        Quantity: {{ $cartItem['quantity'] }}
        Price: {{ $cartItem['product']->price }}
        @php
        $totalPrice += $cartItem['product']->price * $cartItem['quantity'];
        @endphp
    </p>
</div>
@endforeach
<p>
    <strong>Total Price:</strong> {{ $totalPrice }}
    <button type="submit" class="bg-pink-200" onsubmit="">
        Place Order
    </button>
</p>

<!-- Add any additional checkout information and styling as needed -->

@endsection