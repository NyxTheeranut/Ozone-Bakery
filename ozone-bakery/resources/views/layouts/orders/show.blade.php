@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <a onclick="goBack()" style="cursor: pointer;"
            class="mr-auto mt-2 text-2xl font-semibold text-gray-800 dark:text-black">
            &lt; Order History
        </a>

        <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">

            <p class="ml-3 mb-5 text-2xl font-semibold">
                Order #{{ $order->id }}
            </p>
            <hr class="mt-0 mb-4" style="border-color: #c4b7a6; border-width: 2px;">

            <div class="flex flex-row">
                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Date: 
                </p>

                <p class="ml-3 mb-5 text-2xl">
                    {{ $order->created_at }}
                </p>
            </div>

            <div class="flex flex-row">
                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Customer Name: 
                </p>

                <p class="ml-3 mb-5 text-2xl">
                    {{ $order->user->name }}
                </p>
            </div>
            
            <div class="flex flex-row">
                <p class="ml-3 text-2xl font-semibold">
                    Order Status: 
                </p>

                <p class="ml-3 text-2xl">
                    {{ $order->status }}
                </p>
            </div>

            <hr class="mt-5" style="border-color: #c4b7a6; border-width: 2px;">

            @php
                $total = 0;
            @endphp

            <div class="max-w-4xl flex flex-row">
                <table class="min-w-full mt-3 mb-5 ml-7" style="font-size: 1.3em;">

                    <thead>
                        <tr>
                            <th class="text-2xl text-left font-semibold pb-4 p-2 ml-3">Product</th>
                            <th class="text-2xl font-semibold pb-4 p-2 ml-3">Quantity</th>
                            <th class="text-2xl text-right font-semibold pb-4 p-2 ml-3">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_details as $order_detail)
                            <tr>
                                <td class="text-left pl-3">{{ $order_detail->product->name }}</td>
                                <td class="text-center">{{ $order_detail->amount }}</td>
                                <td class="text-right pr-3">{{ $order_detail->product->price * $order_detail->amount }}</td>
                            </tr>
                            @php
                                $total += $order_detail->product->price * $order_detail->amount;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="ml-3 text-2xl font-semibold">
                Total Price: {{ $total }} Baht
            </div>

        </div>
    </div>

    <script>
        function goBack() {
        const urlParams = new URLSearchParams(window.location.search);
        const source = urlParams.get('source');

        if (source === 'page1') {
            // Redirect to Page 1
            window.location.href = '/history';
        } else {
            window.location.href = '/';
        } 
    }
    </script>
@endsection
