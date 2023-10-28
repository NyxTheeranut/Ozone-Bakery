@extends('layouts.main')

@section('content')
<div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
    <!-- Card -->
    <div class="flex flex-row">
        <h1 class="mt-3 text-3xl font-bold">
            Order History
        </h1>

        <select name="order_type" id="order_type" class="pl-2 pt-1 pb-1 pr-1 ml-auto mt-5 border border-2 border-gray-400 h-8 w-40 rounded-xl">
            <option value="retail">
                Retail Orders
            </option>

            <option value="custom">
                Custom Orders
            </option>
        </select>
    </div>
    
    @if(request('order_type') === 'retail')
        @foreach ($orders as $order)
        <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">

            <h1 class="text-2xl">
                Order #{{ $order->id }}
            </h1>

            <p class="ml-3 font-semibold">
                Date: {{ $order->created_at }}
            </p>
        </div>
        @endforeach
    @else
        @foreach ($madeToOrderData as $madeToOrder)
        <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">

            <h1 class="text-2xl">
                Order #{{ $madeToOrder->id }}
            </h1>

            <p class="ml-3 font-semibold">
                Date: {{ $madeToOrder->order_status }}
            </p>
        </div>
        @endforeach
    @endif

</div>
@endsection
