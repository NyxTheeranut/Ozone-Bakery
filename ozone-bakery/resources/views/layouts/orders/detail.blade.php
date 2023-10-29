@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <a onclick="goBack()" style="cursor: pointer;" class="mr-auto mt-2 text-2xl font-semibold text-gray-800 dark:text-black">
            < Order History </a>

                <!-- Card -->
                <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7">

                    <div id="order-p">
                        <div class="text-3xl font-bold ml-3 mb-3">
                            Order #
                        </div>

                        <hr class="mt-0 mb-4" style="border-color:#c4b7a6; border-width: 2px;">

                        <p class="ml-3 mb-5 text-2xl font-semibold">
                            Product: (table ?)
                        </p>

                        <p class="ml-3 mb-5 text-2xl font-semibold">
                            Quantity:
                        </p>

                        <p class="ml-3 mb-5 text-2xl font-semibold">
                            Date:
                        </p>

                        <p class="ml-3 mb-5 text-2xl font-semibold">
                            Payment Status:
                        </p>

                        <p class="ml-3 text-2xl font-semibold">
                            Total: Baht
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
