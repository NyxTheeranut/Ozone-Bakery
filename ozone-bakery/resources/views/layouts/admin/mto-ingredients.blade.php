@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <a class="flex items-center mt-3 text-2xl" onclick="goBack()" style="cursor: pointer;">
            <img src="https://cdn-icons-png.flaticon.com/512/3683/3683627.png" alt="" class="h-6 w-6 m-2">
            <span class="text-2xl font-semibold text-gray-800 ">
                Go back</span>
        </a>

        <div class="bg-stone-200 rounded-xl shadow-lg mt-7 p-4 sm:p-7">
            <div class="flex flex-row">
                <p class="ml-3 mb-5 text-3xl font-semibold">
                    Product ingredients
                </p>
            </div>
            <hr class="mt-0 mb-6" style="border-color: #c4b7a6; border-width: 2px;">

                @foreach ($madeToOrderDetails as $madeToOrderDetail)
                    <p class="text-2xl font-semibold mb-3">
                        {{ $madeToOrderDetail->product->name }}
                    </p>
                    <hr class="mt-0 mb-4" style="border-color: #c4b7a6; border-width: 1px;">
                    <div class="text-xl mb-3">
                        @foreach ($madeToOrderDetail->product->recipe->recipe_details as $recipe_detail)
                            <p class="mb-2 ml-10">{{ $recipe_detail->ingredient->name }} : {{ $recipe_detail->quantity }}
                                {{ $recipe_detail->ingredient->quantity_unit }}</p>
                            
                        @endforeach
                            </div>
                            

                @endforeach
            </div>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        @endsection
