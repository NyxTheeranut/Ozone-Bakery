@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
        <!-- Card -->
        <div class="flex flex-row">
            <h1 class="mt-3 text-3xl font-bold">
                Order History
            </h1>

            <select name="order_type" id="order_type"
                class="pl-2 pt-1 pb-1 pr-1 ml-auto mt-5 border border-2 border-gray-400 h-8 w-40 rounded-xl">
                <option value="retail">
                    Retail Orders
                </option>

                <option value="custom">
                    Custom Orders
                </option>
            </select>
        </div>

        <div id="order-p" class="order-content">
            @foreach ($orders as $order)
                @if (Auth::check() && $order->user_id == Auth::user()->id)
                    <a href="/order/{{ $order->id }}">
                        <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7 hover:bg-stone-200">

                            <p class="ml-0 mb-5 text-2xl font-semibold">
                                Order #{{ $order->id }}
                            </p>

                            <hr class="mt-0 mb-4" style="border-color:#c4b7a6; border-width: 2px;">

                            <p class="ml-3 mb-2 text-xl font-semibold">
                                Date: {{ $order->created_at }}
                            </p>

                            <p class="ml-3 mb-2 text-xl font-semibold">
                                Payment Status: {{ $order->payment_status }}
                            </p>

                            <p class="ml-3 text-2xl font-semibold">
                                Total: {{ $order->order_details->sum(function($detail) {
                                    return $detail->amount * $detail->product->price;
                                }) }} Baht
                            </p>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>

        <div id="made-to-order-p" class="order-content" style="display: none;">
            @foreach ($madeToOrderData as $madeToOrder)
                @if (Auth::check() && $madeToOrder->user_id == Auth::user()->id)
                    <a href="/orders/{{ $madeToOrder->id }}">
                        <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7 hover:bg-stone-200">
                            <h1 class="ml-0 mb-5 text-2xl font-semibold">
                                Order #{{ $madeToOrder->id }}
                            </h1>
                            <hr class="mt-0 mb-4" style="border-color:#c4b7a6; border-width: 2px;">
                            <p class="ml-3 mb-2 text-xl font-semibold">
                                Date: {{ $madeToOrder->created_at }}
                            </p>
                            <p class="ml-3 mb-2 text-xl font-semibold">
                                Status: {{ $madeToOrder->order_status }}
                            </p>
                            <p class="ml-3 mb-2 text-xl font-semibold">
                                Total: {{ $madeToOrder->price }} Baht
                            </p>
                            <p class="ml-3 text-xl font-semibold">
                                Pick-up Date: {{ $madeToOrder->pickup_date }}
                            </p>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Retrieve the selected option from session storage
            var selectedOption = sessionStorage.getItem('selectedOption');
            if (selectedOption) {
                $('#order_type').val(selectedOption);
                toggleOrderContent(selectedOption);
            }

            $('#order_type').on('change', function() {
                var selectedValue = $(this).val();

                // Store the selected option in session storage
                sessionStorage.setItem('selectedOption', selectedValue);

                toggleOrderContent(selectedValue);
            });

            function toggleOrderContent(selectedValue) {
                if (selectedValue === 'retail') {
                    $('#order-p').show(); // Show Retail Orders content
                    $('#made-to-order-p').hide(); // Hide Custom Orders content
                } else if (selectedValue === 'custom') {
                    $('#order-p').hide(); // Hide Retail Orders content
                    $('#made-to-order-p').show(); // Show Custom Orders content
                }
            }
        });
    </script>
@endsection
