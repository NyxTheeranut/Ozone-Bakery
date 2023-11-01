@extends('layouts.main')

@section('content')

<form method="GET" action="{{ route('mto-checkout') }}">
    @csrf
    <div class="form-group">
        <label for="pickup_date">Pickup Date:</label>
        @php
        $minDate = date('Y-m-d', strtotime('+3 days'));
        @endphp
        <input type="date" name="pickup_date" id="pickup_date" class="form-control" required min="{{ $minDate }}">

    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    @php
    $total = 0;
    @endphp

    @foreach ($items as $item)
    <p>
        {{ $item['product']->name }}: {{ $item['amount'] }} Price {{ $item['product']->price * $discount * $item['amount']}}
        @php
        $total += $item['product']->price * $discount * $item['amount'];
        @endphp
        <input type="hidden" name="items[{{ $item['product']->id }}][product_id]" value="{{ $item['product']->id }}">
        <input type="hidden" name="items[{{ $item['product']->id }}][amount]" value="{{ $item['amount'] }}">
    </p>
    @endforeach
    <p>Total: {{ $total }}</p>
    <button type="submit" class="btn btn-primary">Checkout</button>
</form>

@endsection

@section('scripts')