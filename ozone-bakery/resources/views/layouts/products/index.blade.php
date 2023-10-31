@extends('layouts.main')

@section('content')

<section class="bg-neutral-100 flex flex-col text-4xl pt-8 pb-20">
  <div class="flex flex-col">
    <div class="flex justify-content-between">
        <div class="flex flex-col items-stretch w-6/12 max-md:w-full">
          <div id="scrollTarget" class="relative shrink-0 box-border h-auto text-3xl grow-0 w-auto ml-20 mt-5 mb-2.5 pl-10">
            All Product
          </div>
        </div>
        <div class="flex flex-col items-stretch w-6/12 ml-5 max-md:w-full">
          @auth
              @if(auth()->user()->is_admin == 1)
                  <a href="#" class="shrink-0 box-border bg-stone-500 text-white no-underline text-base mx-auto px-5 py-2.5 rounded-3xl hover:bg-stone-600 ml-auto mt-5 mr-20 bg-stone-500">
                      Add product
                  </a>
              @endif
          @endauth
      </div>
</div>
    <div class="flex flex-wrap max-md:flex-col max-md:items-stretch max-md:gap- ml-20 mr-20 pl-20 pr-20 mt-5 mx-auto">
        @foreach ($products as $product)
      <div class="flex flex-col items-stretch w-3/12 max-md:w-full mb-5">
          <a href="/products/{{  $product->id  }}" class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300">
              <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }} " class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">

              <h3 class="text-2xl mx-auto">{{  $product->name  }}</h3>
              <p class="text-xl mx-auto my-2.5">Price: {{  $product->price  }} Baht</p>
          </a>
      </div>
      @endforeach
    </div>
  </section>

@endsection

