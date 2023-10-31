@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <a onclick="goBack()" style="cursor: pointer;"
            class="mr-auto mt-2 text-2xl font-semibold text-gray-800 dark:text-black">
            &lt; Order History
        </a>

        <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">
            <div id="order-p">
                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Order #{{ $order->id }}
                </p>
                
                <hr class="mt-0 mb-4" style="border-color: #c4b7a6; border-width: 2px;">

                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Date: {{ $order->created_at }}
                </p>

                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Customer Name: {{ $order->user->name }}
                </p>

                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Payment Status: {{ $order->status }}
                </p>

                @php
                    $total = 0;
                @endphp

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_details as $order_detail)
                            <tr>
                                <td>{{ $order_detail->product->name }}</td>
                                <td>{{ $order_detail->amount }}</td>
                                <td>{{ $order_detail->product->price * $order_detail->amount }}</td>
                            </tr>
                            @php
                                $total += $order_detail->product->price * $order_detail->amount;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                <p class="ml-3 text-2xl font-semibold">
                    Total Price: {{ $total }} Baht
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
