@extends('layouts.main')

@section('content')
    <div class="overflow-hidden overflow-x-hidden overflow-y-hidden">
        <title>Bakery Website</title>
        <div class="max-w-[1200px] mx-auto max-md:hidden max-md:p-5">
            <section class="bg-neutral-100"></section>
        </div>
    </div>
    <div class="overflow-hidden overflow-x-hidden overflow-y-hidden">
        <section
            class="bg-[url(https://cdn.builder.io/api/v1/image/assets%2F77d863c720664375bca8264055c66bc2%2Fb8f8ffa6577244b4affdb5583b314cc1)] bg-cover text-white text-center bg-no-repeat bg-center py-32">
            <h1 class="text-5xl text-white">Welcome to Ozone Bakery</h1>
            <p class="text-2xl my-5">Delicious pastries baked fresh every day</p>
            <a href="/products" class="bg-stone-500 text-white no-underline px-5 py-2.5 rounded-3xl">All Products</a>
            <p class="text-xl font-bold mt-5">59/63 Moo 6, Semafahram road, Khukhot, Lamlukka, Phathumthanee, 12130</p>
            <p class="text-xl font-bold">Tel. 098-248-5817</p>

            
        </section>
        <section class="bg-neutral-100 flex flex-col text-4xl pt-10 pb-5">
            <div class="flex flex-col">
                <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                    <div class="flex flex-col items-stretch w-6/12 max-md:w-full">
                        <h3 class="relative shrink-0 box-border h-auto text-3xl grow-0 w-auto ml-20 mt-5 mb-2.5">
                            Recommended
                        </h3>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap max-md:flex-col max-md:items-stretch max-md:gap- ml-20 mr-20 pl-20 pr-20 mt-5 mx-auto"
                id="best-sellers">
                <!-- This will be populated with product data fetched from the API -->
            </div>
        </section>
        <section class="bg-neutral-100 flex flex-col text-4xl pt-8 pb-20">
            <div class="flex flex-col">
                <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                    <div class="flex flex-col items-stretch w-6/12 max-md:w-full">
                        <div id="scrollTarget"
                            class="relative shrink-0 box-border h-auto text-3xl grow-0 w-auto ml-20 mt-5 mb-2.5 pl-10">
                            All Products
                        </div>
                    </div>
                    <div class="flex flex-col items-stretch w-6/12 ml-5 max-md:w-full">
                        <a href="/products"
                            class="relative shrink-0 box-border h-auto grow-0 w-auto self-center text-2xl underline ml-auto mr-5 mt-5 mr-20 pr-10">
                            see more
                        </a>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-wrap max-md:flex-col max-md:items-stretch max-md:gap- ml-20 mr-20 pl-20 pr-20 mt-5 mx-auto"
                id="all-products">
                <!-- This will be populated with product data fetched from the API -->
            </div>
        </section>
    </div>
</div>
@endsection

<script>
    // Fetch product data from the API
    fetch('/api/products')
        .then(response => response.json())
        .then(products => {
            // Randomly shuffle 8 products
            const shuffledProducts = shuffleArray(products.slice(4, 20));

            // Render the "Best Sellers" section with the first 4 products
            products.slice(0, 4).forEach(product => {
                const productHTML = `
                <a href="/products/${product.id}" class="flex flex-col items-stretch w-3/12 max-md:w-full mb-5">
                    <div class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300">
                        <div class="product-card">
                            <img src="${product.image_path}" alt="${product.name}" class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">
                            <h3 class="text-2xl mx-auto text-center">${product.name}</h3>
                            <p class="text-xl mx-auto my-2.5 text-center">Price: ${product.price} Baht</p>
                        </div>
                    </div>
                </a>
                `;
                document.getElementById('best-sellers').insertAdjacentHTML('beforeend', productHTML);
            });

            // Render the "All Products" section with the shuffled 8 products
            shuffledProducts.forEach(product => {
                const productHTML = `
                <a href="/products/${product.id}" class="flex flex-col items-stretch w-3/12 max-md:w-full mb-5">
                    <div class="flex flex-col relative shrink-0 box-border h-auto shadow-[3px_-2px_26px_-20px_rgba(0,0,0,1)] w-[300px] self-center mt-5 pb-8 rounded-3xl border-[3px] border-solid border-stone-300">
                        <div class="product-card">
                            <img src="${product.image_path}" alt="${product.name}" class="aspect-[1.46] object-cover object-center w-[250px] h-[250px] mx-auto my-5 rounded-2xl border-0 border-solid">
                            <h3 class="text-2xl mx-auto text-center">${product.name}</h3>
                            <p class="text-xl mx-auto my-2.5 text-center">Price: ${product.price} Baht</p>
                        </div>
                    </div>
                </a>
                `;
                document.getElementById('all-products').insertAdjacentHTML('beforeend', productHTML);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    // Function to shuffle an array randomly
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }
</script>
