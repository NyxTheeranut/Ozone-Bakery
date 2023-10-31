@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <a onclick="goBack()" style="cursor: pointer;" class="mr-auto mt-2 text-2xl font-semibold text-gray-800 dark:text-black">
            < Order History </a>

            <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">
                <div id="order-p">
                    <p class="ml-3 mb-5 text-2xl font-semibold">
                        @foreach ($order->order_details as $index => $order_detail)
                            {{ $order_detail->product->name }}
                            @if ($index < count($order->order_details) - 1)
                                ,
                            @endif
                        @endforeach
                    </p>
                    <hr class="mt-0 mb-4" style="border-color: #c4b7a6; border-width: 2px;">
                    
                    <p class="ml-3 mb-5 text-2xl font-semibold">
                        Products: 
                        @foreach ($order->order_details as $index => $order_detail)
                            {{ $order_detail->product->name }}
                            @if ($index < count($order->order_details) - 1)
                                ,
                            @endif
                        @endforeach
                    </p>
                    
                    <p class="ml-3 mb-5 text-2xl font-semibold">
                        Quantity: {{ $order->order_details->sum('amount') }}
                    </p>
                    
                    <p class="ml-3 mb-5 text-2xl font-semibold">
                        Date: {{ $order->created_at }}
                    </p>
                    
                    <p class="ml-3 mb-5 text-2xl font-semibold">
                        Payment Status: {{ $order->status }}
                    </p>
                    
                    <p class="ml-3 text-2xl font-semibold">
                        Total: {{ $order->order_details->sum(function($detail) {
                            return $detail->amount * $detail->product->price;
                        }) }} Baht
                    </p>
                </div>
            </div>
        </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
