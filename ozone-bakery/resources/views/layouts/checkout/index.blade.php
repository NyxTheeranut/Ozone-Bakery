@extends('layouts.main')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bacon-qr-code/style.css') }}">
$totalPrice = 0;
@foreach ($cartItems as $cartItem)
@php
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
    PromptPay QR Code
</p>
<p>
    <img src="https://promptpay.io/0931503337/{{$totalPrice}}.png">
</p>
<p>
    <strong>
        Total Price:
    </strong> {{ $totalPrice }}
<form method="POST" action="{{ route('orders') }}" id="order-form">
    @csrf <!-- Add this line to include the CSRF token -->
    <input type="hidden" name="amount" value="{{ $totalPrice }}">
    @foreach ($cartItems as $cartItem)
    <input type="hidden" name="items[{{ $cartItem['product']->id }}][product_id]" value="{{ $cartItem['product']->id }}">
    <input type="hidden" name="items[{{ $cartItem['product']->id }}][quantity]" value="{{ $cartItem['quantity'] }}">
    @endforeach
    <button type="submit" class="bg-pink-200">
        Confirm Order
    </button>
</form>
</p>

@endsection