@extends('layouts.main')

@section('content')

<p>
    <p>
        Order id: {{ $madeToOrder->id }}
    </p>
    <p>
        User: {{ $madeToOrder->user->name}}
    </p>
    <p>
        Estimate pickup date: {{ $madeToOrder->pickup_date }}
    </p>
    <p>
        Description: {{ $madeToOrder->description }}
    </p>

    @php
    $total = 0;
    @endphp

    @foreach ( $madeToOrder->madeToOrderDetails as $detail)
    <p>
        Product: {{ $detail->product->name }}
        Quantity: {{ $detail->amount }}
        Price: {{ $detail->product->price * $discount * $detail->amount }}

        @php
        $total += $detail->product->price * $discount * $detail->amount;
        @endphp
    </p>
    @endforeach
    <p>
        Total Price: {{ $total }}
    </p>
</p>

@endsection