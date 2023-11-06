@extends('layouts.main')

@section('content')
    <div>
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bacon-qr-code/style.css') }}">
        @php
            $totalPrice = 0;
        @endphp

        <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

            <h1 class="mt-3 text-3xl font-bold">
                Checkout
            </h1>

            <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">
                <div class="max-w-4xl flex flex-row">
                    <table class="min-w-full mt-3 mb-5 ml-7" style="font-size: 1.3em;">

                        <thead>
                            <tr>
                                <th class="text-2xl text-left font-semibold pb-4 p-2 ml-3 w-[30%]">Product</th>
                                <th class="text-2xl text-center font-semibold pb-4 p-2 ml-3 w-[30%]">Unit Price (Baht)</th>
                                <th class="text-2xl text-center font-semibold pb-4 p-2 ml-3 w-[20%]">Quantity</th>
                                <th class="text-2xl text-center font-semibold pb-4 p-2 ml-3 w-[20%]">Amount (Baht)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td class="text-left pl-3">{{ $cartItem['product']->name }}</td>
                                    <td class="text-center pr-3">{{ $cartItem['product']->price }}</td>
                                    <td class="text-center pl-3">{{ $cartItem['quantity'] }}</td>
                                    <td class="text-center pr-3">{{ $cartItem['product']->price * $cartItem['quantity'] }}
                                    </td>
                                </tr>
                                @php
                                    $totalPrice += $cartItem['product']->price * $cartItem['quantity'];
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <hr class="mt-0 mb-4" style="border-color:#c4b7a6; border-width: 2px;">

                <div class="mb-3 flex flex-wrap">
                    <section class="ml-8 flex flex-col items-stretch w-[47%] max-md:w-full">
                        <div class=" mb-2 text-2xl font-semibold">
                            PromptPay QR Code
                        </div>
                        <p class="mt-5 mb-2">
                            <img src="https://promptpay.io/0931503337/{{ $totalPrice }}.png">
                        </p>

                        <p class="ml-12 font-semibold text-lg" style="color: blue;">
                            Total: {{ $totalPrice }} Baht
                        </p>
                    </section>

                    <section class="flex flex-col items-stretch w-[50%] max-md:w-full max-md:h-full">
                        <div style="margin-top: 200px" class="mb-auto mr-10 pb-4 text-right text-2xl font-semibold">
                            <div class="flex-row mb-4">
                                <span>Pickup Date:</span>
                                {{ $pickupDate }}
                            </div>
                            
                            <span>Total Price:</span> {{ $totalPrice }} Baht
                            <button id="confirmOrderButton" onclick="onConfirmOrderButtonClicked()"
                                style="margin-top: 20px;"
                                class="bg-pink-200 flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all">
                                Confirm Order
                            </button>
                        </div>
                    </section>

                </div>

            </div>

        </div>

    </div>

    <script>
        const confirmOrderButton = document.getElementById('confirmOrderButton');
        const orderShowForm = document.getElementById('orderShowForm');

        function onConfirmOrderButtonClicked() {

            if (!confirm(
                    'Are you sure you want to confirm this order? Please ensure that you have made the payment for this order to proceed.'
                    )) {
                return;
            }

            const orderDetails = [];

            const items = @json($cartItems);
            for (const item of items) {
                const product = item['product'];
                const product_id = product['id'];
                const amount = item['quantity'];

                orderDetails.push({
                    product_id: product_id,
                    amount: amount,
                });
                //console.log(body);
            }

            const userID = @json(Auth::user()->id);
            const pickupDate = @json($pickupDate);

            const body = JSON.stringify({
                user_id: userID,
                pickup_date: pickupDate,
                order_details: orderDetails,
            });

            fetch('/api/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: body,
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:');
                    console.log(data);
                    window.location.href = '/orders/' + data['order_id'];
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection