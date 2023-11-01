@extends('layouts.main')

@section('content')
@php
$total = 0;
@endphp
<p>
    Estimate pickup date: {{ $pickup_date }}
</p>
<p>
    Description: {{ $description }}
</p>
@foreach ($items as $item)
<p>
    Product: {{ $item['product']->name }}
    Quantity: {{ $item['amount'] }}
    Price: {{ $item['product']->price * $discount * $item['amount']}}
    @php
    $total += $item['product']->price * $discount * $item['amount'];
    @endphp
</p>
@endforeach
<p>Total: {{ $total }}</p>

<p>
    PromptPay QR Code
</p>
<p>
    <img src="https://promptpay.io/0931503337/{{$total}}.png">
</p>

<form method="POST" action="{{ route('mto-confirm-order') }}">
    @csrf
    <input type="hidden" name="pickup_date" value="{{ $pickup_date }}">
    <input type="hidden" name="description" value="{{ $description }}">
    @foreach ($items as $item)
    <input type="hidden" name="items[{{ $item['product']->id }}][product_id]" value="{{ $item['product']->id }}">
    <input type="hidden" name="items[{{ $item['product']->id }}][amount]" value="{{ $item['amount'] }}">
    @endforeach
    <button type="submit">Confirm</button>
</form>

@endsection