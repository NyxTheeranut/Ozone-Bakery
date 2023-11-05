@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <a class="flex items-center mt-3 text-2xl" onclick="goBack()" style="cursor: pointer;">
            <img src="https://cdn-icons-png.flaticon.com/512/3683/3683627.png" alt="" class="h-6 w-6 m-2">
            <span class="text-2xl font-semibold text-gray-800 ">
                Go back</span>
        </a>



        <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">

            <div class="flex flex-row">
                <p class="ml-3 mb-5 text-2xl font-semibold">
                Order #{{ $madeToOrder->id }}
            </p>
            
            
            @if (Auth::check() && Auth::user()->is_admin)
            <button id="manageButton"
            class="flex flex-wrap block ml-auto h-10 mr-2 ml-2 pr-2 pl-2 pt-1 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                <img src="https://icon-library.com/images/white-icon-png/white-icon-png-14.jpg" alt=""
                class="h-6 w-6 mr-2 mt-1">
                Manage
            </button>
            @endif
            </div>
            
            <hr class="mt-0 mb-4" style="border-color: #c4b7a6; border-width: 2px;">

            <div class="flex flex-row">
                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Customer Name:
                </p>

                <p class="ml-3 mb-5 text-2xl">
                    {{ $madeToOrder->user->name }}
                </p>
            </div>

            <div class="flex flex-row">
                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Date:
                </p>

                <p class="ml-3 mb-5 text-2xl">
                    {{ $madeToOrder->created_at }}
                </p>
            </div>

            <div class="flex flex-row">
                <p class="ml-3 mb-5 text-2xl font-semibold">
                    Pick-up Date:
                </p>

                <p class="ml-3 mb-5 text-2xl">
                    {{ $madeToOrder->pickup_date }}
                </p>
            </div>

            <div class="flex flex-row">
                <p class="ml-3 text-2xl font-semibold">
                    Status: 
                </p>

                <p class="ml-3 mb-5 text-2xl">
                    {{ $madeToOrder->status }}
                </p>
            </div>


            <div class="flex flex-row">
                <p class="ml-3 text-2xl font-semibold">
                    Description: 
                </p>

                <p class="ml-3 text-2xl">
                    {{ $madeToOrder->description }}
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
                            <th class="text-2xl text-left font-semibold pb-4 p-2 ml-3 w-[30%]">Product</th>
                            <th class="text-2xl text-cneter font-semibold pb-4 p-2 ml-3 w-[30%]">Unit Price (Baht)</th>
                            <th class="text-2xl text-center font-semibold pb-4 p-2 ml-3 w-[20%]">Quantity</th>
                            <th class="text-2xl text-center font-semibold pb-4 p-2 ml-3 w-[20%]">Amount (Baht)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($madeToOrder->made_to_order_details as $detail)
                            <tr>
                                <td class="text-left pl-3">{{ $detail->product->name }}</td>
                                <td class="text-center pl-3">{{ $detail->product->price * $discount }}</td>
                                <td class="text-center">{{ $detail->amount }}</td>
                                <td class="text-center pr-3">{{ $detail->product->price * $detail->amount * $discount }}</td>
                            </tr>
                            @php
                                $total += $detail->product->price * $discount * $detail->amount;
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

            if (source === 'history') {
                // Redirect to Page 1
                window.location.href = '/history';
            } else if (source === 'manage') {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }
    </script>
@endsection
