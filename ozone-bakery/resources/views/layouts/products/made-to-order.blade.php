@extends('layouts.main')

@section('content')
<div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
    <!-- Card -->
    <div class="bg-stone-100 rounded-xl shadow-lg mt-7 p-4 sm:p-7 dark:bg-slate-900">
        <div class="mb-3 flex flex-wrap">
            <h1 class="ml-3 text-3xl font-bold">Made to Order</h1>
        </div>

        <p class="pl-7 pb-5">You can customize the type of bakery and the quantity you want. Feel free to leave notes for specific details you'd like us to know.</p>

        <div class="flex flex-row mt-4 pl-2 pb-3">
            <label for="product" class="font-semibold text-xl mr-2">
                Select Product:
            </label>
            <select id="selectedProduct" class="pl-2 pb-1 mr-20 border border-2 border-gray-400 h-8 w-40 rounded-xl">
                <option value="" disabled>Select a Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product['name'] }}" data-price="{{ $product['price'] }}">{{ $product['name'] }}</option>
                @endforeach
            </select>

            <div class="flex pl-2">
                <label for="quantity" class="font-semibold text-xl mr-2">
                    Quantity:
                </label>
                <div class="items-center">
                    <button class="mr-1 font-bold border border-2 border-gray-400 h-8 w-8 rounded-2xl hover:bg-stone-200" 
                    id="decreaseQuantity"
                    @click="decreaseQuantity"
                    :disabled="selectedQuantity <= minQuantity">
                        -
                    </button>
                    <input id="quantity" type="number" class="mr-1 pl-3 border border-2 border-gray-400 h-8 w-12 rounded-xl"
                    :value="selectedQuantity"
                    :min="minQuantity"
                    :disabled="!selectedProduct"
                    readonly>
                    <button class="font-bold border border-2 border-gray-400 h-8 w-8 rounded-2xl hover-bg-stone-200" 
                    id="increaseQuantity"
                    @click="increaseQuantity">
                        +
                    </button>
                </div>
            </div>

            <div class="flex ml-auto mr-auto text-2xl font-semibold">
                <p class="mr-2">
                    Price:
                </p>
                <span class="item-price" id="itemPrice">0</span>
                <p class="ml-2">
                    Baht
                </p>
            </div>
        </div>

        <p class="mr-auto pl-5 pb-3 text-red-900">* Some products may have a minimum order quantity requirement.</p>

        <div class="mt-4 pl-2">
            <label for="pickup_date" class="font-semibold text-xl mr-2">
                Pick-up Date:
            </label>
            <input type="date" class="pl-3 pb-1 border border-2 border-gray-400 h-8 w-40 rounded-xl" v-model="selectedPickUpDate" :min="minPickUpDate">
        </div>

        <p class="mt-3 pl-5 pb-3 text-red-900">
            * Each order may have its own production time. We'll notify you if any date adjustments are needed.
        </p>

        <div class="flex flex-row mt-4 pl-2">
            <label for "description" class="font-semibold text-xl mb-2 mr-2 block">
                Note:
            </label>
            <textarea class="pl-2 pt-2 border border-2 border-gray-400 h-40 w-80 rounded-xl" v-model="note"></textarea>

            <button class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl" @click="submitOrder">
                <img src="https://cdn.discordapp.com/attachments/1126214448139472999/1164191609949274203/Untitled_Artwork.png?ex=654250ed&is=652fdbed&hm=f063d65af471effaf530e9c680bfc5e71318cb64b51d69bda8d7803d40ec9f46&" class="mr-2 h-8 justify-center" />
                Submit Order
            </button>
        </div>
    </div>
</div>

<script>
    const selectedProduct = document.getElementById('selectedProduct');
    const selectedQuantity = document.getElementById('selectedQuantity');
    const itemPrice = document.getElementById('itemPrice');
    const quantityInput = document.getElementById('quantity');
    const decreaseButton = document.getElementById('decreaseQuantity');
    const increaseButton = document.getElementById('increaseQuantity');

    let productPrice = 0;
    let quantity = 10;

    selectedProduct.addEventListener('change', () => {
        productPrice = parseFloat(selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-price'));
        updateTotalPrice();
    });

    function updateTotalPrice() {
        itemPrice.textContent = (productPrice * quantity);
    }

    decreaseButton.addEventListener('click', () => {
        if (quantity > 10) {
            quantity--;
            quantityInput.value = quantity;
            updateTotalPrice();
        }
    });

    increaseButton.addEventListener('click', () => {
        quantity++;
        quantityInput.value = quantity;
        updateTotalPrice();
    });

    // Initialize the input field and total price
    quantityInput.value = quantity;
    updateTotalPrice();
</script>
@endsection
