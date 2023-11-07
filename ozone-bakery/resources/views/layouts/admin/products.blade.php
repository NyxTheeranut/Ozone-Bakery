<style>
    th {
        text-align: center;
        /* Align the text to the left */
        border-bottom: 4px solid #c4b7a6;
    }

    tr {
        text-align: center;
        height: 130px;
        border-bottom: 1px solid #c4b7a6;
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

            <button id="addProductButton"
                class="inline-block m-2 mt-4 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all">
                Add Product</button>

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
                        <th class="text-2xl font-semibold pr-4" style="width: 15%; text-align: center"></th>

                    </tr>
                </thead>
                <tbody id="productTable">
                </tbody>
                <tr id="new-product-row" style="display: none;">
                    <td class="pl-6 text-xl" style="width: 5%;"></td>
                    <td>
                        <img src="" alt="New Product Image" width="100" height="100"
                            style="display: block; margin: 0 auto;" class="rounded-3xl" id="new-product-image-preview">
                        <!-- Change id to something unique -->
                        <input type="file" class="hidden" id="new-product-image" style="display: none;" onchange="previewImage()">
                        <label style="cursor: pointer;" class="block m-1 py-1 px-1 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-sm hover:bg-stone-600 transition-all"
                            for="new-product-image">Select an Image</label>
                        
                    </td>
                    <td><input
                            class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                            type="text" id="new-product-name" placeholder="Product name" style="width: 80%;"></td>
                    <td><input
                            class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                            type="text" id="new-product-description" placeholder="Product description" style="width: 80%;"></td>
                    <td><input
                            class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                            type="text" id="new-product-price" placeholder="Price" style="width: 80%;"></td>
                    <td>
                        <div class="flex flex-row">
                            <p>
                                <button
                                    class="block mt-auto py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                    onclick="onSaveNewProductButtonClicked()" id="saveProductButton">
                                    Save
                                </button>
                            </p>
                            <p>
                                <button
                                    class="block m-2 mr-0 mt-auto py-2 px-3  rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                    onclick="onCancelNewProductButtonClicked()" id="cancelProductButton">
                                    Cancel
                                </button>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
<script>
    function previewImage() {
        const input = document.getElementById("new-product-image");
        const preview = document.getElementById("new-product-image-preview");

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        fetchProducts();

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

        // Attach the event listener to the button after the DOM is loaded
        const addProductButton = document.getElementById("addProductButton");
        addProductButton.addEventListener("click", onAddProductButtonClicked);
    });

    function fetchProducts() {
        fetch('/api/products')
            .then(response => response.json())
            .then(data => {
                const productTable = document.getElementById("productTable");
                productTable.innerHTML = ""; // Clear existing table data

                data.forEach(product => {
                    const row = document.createElement("tr");

                    row.innerHTML = `
                    <td class="pl-6 text-xl pr-5">${product.id}</td>
                    <td>
                        <img src="${product.image_path}" alt="${product.name}" width="100" height="100" style="display: block; margin: 0 auto;" class="rounded-3xl"
    id="productImage${product.id}"> <!-- Use a unique id based on productId -->
<input type="file" onchange="onProductImageUploaded(${product.id})" id="productImageInput${product.id}" style="display: none">
                        <label style="cursor: pointer;" class="block m-1 py-1 px-1 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-sm hover:bg-stone-600 transition-all" id="fileInputLabel" for="productImageInput${product.id}">Select an Image</label>
                    </td>
                    <td class="text-xl pl-2"><input id="name${product.id}" onchange="onProductDetailChange(${product.id})" type="text" value="${product.name}" class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"></td>
                    <td class="text-lg" style="text-align: left;"><textarea id="description${product.id}" onchange="onProductDetailChange(${product.id})" class="w-full text-left rounded-3xl border border-stone-300 bg-stone-100 hover-bg-white transition-all">${product.description}</textarea></td>
                    <td class="text-xl" style="text-align: center; width: 10%;">
                        <input class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover-bg-white transition-all" type="number" value="${product.price}" id="price${product.id}" onchange="onProductDetailChange(${product.id})" style="width: 50%;"> Baht
                    </td>
                    <td class="justify-content-center" style="text-align: center; width: 10%;">
                        <a class="block m-2 mt-auto py-2 px-3 ml-12 w-20 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all" href="/admin/recipe/${product.id}">${product.recipe ? 'View' : 'Add'}</a>
                    </td>
                    <td>
                        <button class="block m-2 mr-0 mt-auto py-2 px-3  rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all" id="deleteProductButton${product.id}" onclick="onDeleteProductButtonClicked(${product.id})">Delete</button>
                        <button class="block m-2 mr-0 mt-auto py-2 px-3  rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all" id="saveProductButton${product.id}" onclick="onSaveProductButtonClicked(${product.id})" style="display: none">Save</button>
                    </td>
                `;

                    productTable.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
    }


    function onSaveProductButtonClicked(productId) {
        const name = document.getElementById("name" + productId).value;
        const description = document.getElementById("description" + productId).value;
        const price = document.getElementById("price" + productId).value;
        const imageInput = document.getElementById("productImageInput" + productId);

        const image = imageInput.files[0];
        const requestBody = {
            name: name,
            description: description,
            price: price,
        };

        if (image) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageBase64 = e.target.result;
                requestBody.image = imageBase64;
                sendPutRequest(productId, requestBody);
            };
            reader.readAsDataURL(image); // Read the image file as Base64
        } else {
            sendPutRequest(productId, requestBody);
        }

        showDeleteButton(productId);
    }

    function onProductDetailChange(productId) {
        hideDeleteButton(productId);
    }

    function hideDeleteButton(productId) {
        document.getElementById("deleteProductButton" + productId).style.display = "none";
        document.getElementById("saveProductButton" + productId).style.display = "block";
    }

    function showDeleteButton(productId) {
        document.getElementById("deleteProductButton" + productId).style.display = "block";
        document.getElementById("saveProductButton" + productId).style.display = "none";
    }

    function onProductImageUploaded(productId) {
        onProductDetailChange(productId);
        const imageInput = document.getElementById("productImageInput" + productId);
        const productImage = document.getElementById("productImage" + productId);
        productImage.src = URL.createObjectURL(imageInput.files[0]);
    }

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

    function onSaveNewProductButtonClicked() {
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
            sendPostRequest(requestBody);
        };
        reader.readAsDataURL(image); // Read the image file as Base64

        setTimeout(function() {
            location.reload();
        }, 500); // 1000 milliseconds = 1 second
    }

    function onCancelNewProductButtonClicked() {
        document.getElementById("new-product-row").style.display = "none";
        document.getElementById("addProductButton").style.display = "block";
    }

    function sendPostRequest(requestBody) {
        fetch("/api/products", {
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

    function sendPutRequest(productId, requestBody) {
        fetch(`/api/products/${productId}`, {
                method: 'PUT',
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

    function onDeleteProductButtonClicked(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            fetch(`/api/products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
</script>
