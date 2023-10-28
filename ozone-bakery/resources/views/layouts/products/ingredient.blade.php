@extends('layouts.main')

@section('content')

<section class="bg-neutral-100 flex flex-col text-4xl pt-8 pb-20">
    <div class="flex flex-col">
        <div class="flex justify-content-between">
            <div class="flex flex-col items-stretch w-6/12 max-md:w-full">
              <div id="scrollTarget" class="relative shrink-0 box-border h-auto text-3xl grow-0 w-auto ml-20 mt-5 mb-2.5 pl-10">
                All Ingredients
              </div>
            </div>
            <div class="flex flex-col items-stretch w-6/12 ml-5 max-md:w-full">
              <a href="#" class=" shrink-0 box-borderbg-stone-500 text-white no-underline text-base mx-auto px-5 py-2.5 rounded-3xl hover:bg-stone-600 ml-auto mr-20 mt-5 mr-20 pr-10 bg-stone-500">
                Add ingredient
              </a>
            </div>
          </div>
    </div>
    <div class="flex flex-wrap max-md:flex-col max-md:items-stretch max-md:gap- ml-20 mr-20 pl-20 pr-20 mt-5 mx-auto">
        @foreach ($ingredients as $ingredient)
        <div class="flex flex-col items-stretch w-3/12 max-md:w-full mb-5">
            <div class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300">
                <h3 class="text-2xl mx-auto mt-5">{{ $ingredient->name }}</h3>
                <p class="text-xl mx-auto my-2.5">Quantity: {{ $ingredient->quantity_unit }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection



