<section class="bg-neutral-100 flex flex-col text-4xl pt-8 pb-20">
    <div class="flex flex-col">
        <div class="flex justify-content-between">
            <div class="flex flex-col items-stretch w-6/12 max-md:w-full">
                <div id="scrollTarget" class="relative shrink-0 box-border h-auto text-3xl grow-0 w-auto ml-20 mt-5 mb-2.5 pl-20">
                    {{$title}}
                    @if ($title == 'Available Products')
                    <p class="text-lg ml-4 mt-2 text-stone-500">
                        * Feel free to choose from available products within the current in-stock limits.
                    </p>
                    @else
                    <p class="text-lg ml-4 mt-2 text-stone-500">
                        * This is all products in our shop, some items may currently be out of stock.
                    </p>
                    @endif
                </div>
            </div>

            <div class="flex flex-col items-stretch w-6/12 ml-5 max-md:w-full">
            </div>
        </div>

        <div class="flex flex-wrap max-md:flex-col max-md:items-stretch max-md:gap- ml-20 mr-20 pl-20 pr-20 mt-5 mx-auto">
            <hr class="mb-3 pl-20" style="border-color: #c4b7a6; border-width: 2px; width: 100%;">
            @foreach ($products as $product)
            <div class="flex flex-col items-stretch w-3/12 max-md:w-full mb-5">
                <a href="/products/{{ $product->id }}" class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300 transition-all hover:bg-stone-200">
                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }} " class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">

                    <h3 class="text-2xl font-semibold mx-auto">{{ $product->name }}</h3>
                    <p class="text-xl font-semibold mx-auto my-2.5">Price: {{ $product->price }} Baht</p>
                    <p class="flex-wrap bg-stone-200 rounded-2xl py-2 px-3 text-xl mx-auto my-2.5"
                        style="border: 2px solid #c7bcad;">
                        Stock: {{ $product->total_stock }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>