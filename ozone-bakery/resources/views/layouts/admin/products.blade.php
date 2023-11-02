<style>
    th {
        text-align: left;
        /* Align the text to the left */
        border: 1px solid black;
    }

    td {
        text-align: left;
        /* Align the text to the left */
        border: 1px solid black;
    }

    tr {
        height: 110px;
    }
</style>

@extends('layouts.main')

@section('content')
<div style="display: flex; justify-content: center; align-items: center;">
    <div style="width: 90%;">
        <table style="width: 100%; border-collapse: collapse; margin: 0 auto;">
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 10%; text-align: center">Image</th>
                    <th style="width: 25%;">Name</th>
                    <th style="width: 35%;">Description</th>
                    <th style="width: 10%;">Recipe</th>
                    <th style="width: 5%;">Price</th>
                    <th style="width: 10%;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ $product->image_path }}" alt="{{ $product->name }}" width="100" height="100" style="display: block; margin: 0 auto;"></td>
                    <td>{{ $product->name }}</td>
                    <td style="text-align: left;">{{ $product->description }}</td>
                    <td style="text-align: center;">
                        <a href="/admin/recipe/{{ $product->id }}">{{ $product->recipe ? 'View' : 'Add' }}</a>
                    </td>
                    <td style="text-align: center;">{{ $product->price }}</td>
                    @php
                    $lastProductId = $product->id;
                    @endphp
                </tr>
                @endforeach
                <tr id="new-product-row" style="display: none;">
                    <td style="width: 5%;">{{ $lastProductId + 1 }}</td>
                    <td><input type="file" id="new-product-image" style="width: 100%;"></td>
                    <td><input type="text" id="new-product-name" style="width: 100%;"></td>
                    <td><input type="text" id="new-product-description" style="width: 100%;"></td>
                    <td> Null </td>
                    <td><input type="text" id="new-product-price" style="width: 100%;"></td>
                    <td>
                        <p><button onclick="onSaveProductButtonClicked()" id="saveProductButton">Save</button></p>
                        <p><button onclick="onCancelProductButtonClicked()" id="cancleProductButton">Cancel</button></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <button onclick="onAddProductButtonClicked()" id="addProductButton" style="display: none; margin-top: 20px; margin-bottom: 20px;">
            Add Product
        </button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addProductButton").style.display = "block";
    });

    function onAddProductButtonClicked() {
        productTable = document.getElementById("new-product-row").style.display = "table-row";
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
        fetch('{{ route("products.post") }}', {
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
@endsection