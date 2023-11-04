@extends('layouts.main')

@section('content')
    <div>
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bacon-qr-code/style.css') }}">
        @php
            $total = 0;
        @endphp

        <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

            <h1 class="mt-3 text-3xl font-bold">
                Checkout
            </h1>

            <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">
                <div class="mb-2 flex flex-col">
                    <p class="mb-3 text-2xl font-bold">
                        Custom Order
                    </p>
                    <p class="mt-1 text-2xl font-semibold">
                        Pick-up Date: {{ $pickup_date }}
                    </p>

                    <p class="mt-1 text-2xl font-semibold">
                        Description: {{ $description }}
                    </p>
                </div>
                <hr class="mt-0" style="border-color:#c4b7a6; border-width: 2px;">
                <div class="max-w-4xl flex flex-row">
                    <table class="min-w-full mt-3 mb-5 ml-7" style="font-size: 1.3em;">

                        <thead>
                            <tr>
                                <th class="text-2xl text-left font-semibold pb-4 p-2 ml-3 w-[30%]">Product</th>
                                <th class="text-2xl text-cneter font-semibold pb-4 p-2 ml-3 w-[30%]">Unit Price (Baht)</th>
                                <th class="text-2xl text-center font-semibold pb-4 p-2 ml-3 w-[20%]">Quantity</th>
                                <th class="text-2xl text-center font-semibold pb-4 p-2 ml-3 w-[20%]">Amount (Baht)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-left pl-3">{{ $item['product']->name }}</td>
                                    <td class="text-center pr-3">{{ $item['product']->price * $discount }}</td>
                                    <td class="text-center pl-3">{{ $item['amount'] }}</td>
                                    <td class="text-center pr-3">
                                        {{ $item['product']->price * $item['amount'] * $discount }}
                                    </td>
                                </tr>
                                @php
                                    $total += $item['product']->price * $discount * $item['amount'];
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
                        <p class="mb-5 text-left text-lg" style="color: rgb(184, 60, 60);">
                            * Please complete the payment within 10 minutes.
                        </p>
                        <p class="">
                            <img src="https://promptpay.io/0931503337/{{ $total }}.png">
                        </p>

                        <p class="ml-12 font-semibold text-lg" style="color: blue;">
                            Total: {{ $total }} Baht
                        </p>
                    </section>

                    <section class="flex flex-col items-stretch w-[50%] max-md:w-full max-md:h-full">
                        <p class="mb-auto mr-10 pb-4 text-right text-2xl font-semibold">
                            <strong>
                                Total Price:
                            </strong> {{ $total }} Baht

                        <form method="POST" action="{{ route('mto-confirm-order') }}">
                            @csrf
                            <input type="hidden" name="pickup_date" value="{{ $pickup_date }}">
                            <input type="hidden" name="description" value="{{ $description }}">
                            @foreach ($items as $item)
                                <input type="hidden" name="items[{{ $item['product']->id }}][product_id]"
                                    value="{{ $item['product']->id }}">
                                <input type="hidden" name="items[{{ $item['product']->id }}][amount]"
                                    value="{{ $item['amount'] }}">
                            @endforeach

                            <button type="submit"
                                class="bg-pink-200 flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                                Confirm Order
                            </button>
                        </form>
                        </p>
                    </section>

                </div>

            </div>

        </div>

    </div>
@endsection
