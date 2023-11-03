<style>
    th {
        text-align: left;
        /* Align the text to the left */
        border-bottom: 4px solid #c4b7a6;
    }

    tr {
        height: 70px;
    }
</style>

@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto"
        style="justify-content: center; align-items: center;">
        <div class="flex flex-row mb-6 mt-2">
            <h1 class="mr-auto mt-6 text-3xl font-semibold text-gray-800 dark:text-black">
                Product List
            </h1>

            <button onclick="onAddProductButtonClicked()" id="addProductButton"
                class="block  mt-6 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                style="display: none;">
                + | Add Product
            </button>
        </div>

        <div class="bg-stone-200 rounded-xl shadow-lg mt-0 p-4 sm:p-7" style="width: 100%;">
            <table style="width: 100%; border-collapse: collapse; margin: 0 auto;">
                <thead>
                    <tr>
                        <th class="text-2xl font-semibold" style="width: 5%; text-align: center">ID</th>
                        <th class="text-2xl font-semibold" style="width: 10%; text-align: center;">Image</th>
                        <th class="text-2xl font-semibold pl-2" style="width: 20%;">Name</th>
                        <th class="text-2xl font-semibold" style="width: 30%;">Description</th>
                        <th class="text-2xl font-semibold" style="width: 15%; text-align: center">Price</th>
                        <th class="text-2xl font-semibold pr-4" style="width: 15%; text-align: center">Recipe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="pl-6 text-xl">{{ $product->id }}</td>
                            <td><img src="{{ $product->image_path }}" alt="{{ $product->name }}" width="100"
                                    height="100" style="display: block; margin: 0 auto;" class="rounded-3xl "></td>
                            <td class="text-xl pl-2">{{ $product->name }}</td>
                            <td class="text-lg" style="text-align: left;">{{ $product->description }}</td>
                            <td class="text-xl" style="text-align: center; width: 10%;">{{ $product->price }} Baht</td>
                            <td class="justify-content-center" style="text-align: center; width: 10%;">
                                <a class="block m-2 mt-auto py-2 px-3 ml-12 w-20 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                    href="/admin/recipe/{{ $product->id }}">{{ $product->recipe ? 'View' : 'Add' }}</a>
                            </td>
                            @php
                                $lastProductId = $product->id;
                            @endphp
                        </tr>
                    @endforeach
                    <tr id="new-product-row" style="display: none;">
                        <td class="pl-6 text-xl" style="width: 5%;">{{ $lastProductId + 1 }}</td>
                        <td><input
                                class="block m-2 mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                type="file" id="new-product-image" style="width: 80%;"></td>
                        <td><input
                                class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                type="text" id="new-product-name" style="width: 80%;"></td>
                        <td><input
                                class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                type="text" id="new-product-description" style="width: 80%;"></td>
                        <td><input
                                class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                type="text" id="new-product-price" style="width: 80%;"></td>
                        <td>
                            <div class="flex flex-row">
                                <p>
                                    <button
                                        class="block mt-auto py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all"
                                        onclick="onSaveProductButtonClicked()" id="saveProductButton">Save</button>
                                </p>
                                <p>
                                    <button
                                        class="block m-2 mr-0 mt-auto py-2 px-3  rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all"
                                        onclick="onCancelProductButtonClicked()" id="cancelProductButton">Cancel</button>
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addProductButton").style.display = "block";
    });

    function onAddProductButtonClicked() {
        // Show the new product row
        const newProductRow = document.getElementById("new-product-row");
        newProductRow.style.display = "table-row";

        // Scroll to the new product row
        newProductRow.scrollIntoView({
            behavior: "smooth"
        });

        // Hide the "Add Product" button
        document.getElementById("addProductButton").style.display = "none";
    }

    function onSaveProductButtonClicked() {
        // Get the values of the new product from the input fields
        const name = document.getElementById("new-product-name").value;
        const description = document.getElementById("new-product-description").value;
        const price = document.getElementById("new-product-price").value;
        const imageInput = document.getElementById("new-product-image");

        const image = imageInput.files[0];
        const requestBody = {
            name: name,
            description: description,
            price: price,
        };

        const reader = new FileReader();
        reader.onload = function(e) {
            const imageBase64 = e.target.result;
            requestBody.image = imageBase64;
            sendRequest(requestBody);
        };
        reader.readAsDataURL(image); // Read the image file as Base64

        setTimeout(function() {
            location.reload();
        }, 500); // 1000 milliseconds = 1 second
    }

    function onCancelProductButtonClicked() {
        document.getElementById("new-product-row").style.display = "none";
        document.getElementById("addProductButton").style.display = "block";
    }

    function sendRequest(requestBody) {
        fetch('{{ route('products.post') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify(requestBody),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
