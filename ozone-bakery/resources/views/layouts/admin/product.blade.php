@extends('layouts.main')

@section('content')
<!-- Card Section -->
<div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

    <!-- Card -->
    <div class="bg-white rounded-xl shadow-lg mt-7 p-4 sm:p-7 ">
        <div class="mb-3 flex flex-wrap">
            <section class="flex flex-col items-stretch w-[30%] max-md:w-full">
                <a onclick="goBack()" class="mr-auto mb-3 text-xl text-gray-800 dark:text-black">
                    < Product Detail </a>

                        <div class="flex flex-wrap items-start">
                            <img src="{{  asset($product->image_path)  }}" class="h-90 w-90 rounded-3xl">
                        </div>
                        <input type="file" name="image" id="imageInputField" class="mt-5">
            </section>

            <section class="flex flex-col items-stretch w-[47%] ml-5 max-md:w-full">
                <input type="hidden" name="id" value="{{ $product->id }}" id="idInputField">
                <input type="text" name="name" value="{{ $product->name }}" id="nameInputField" class="mt-8 text-3xl font-bold text-gray-800 text-black">
                <textarea name="description" class="pl-4 mt-2 flex flex-wrap" id="descriptionInputField">{{ $product->description }} </textarea>
                <input type="number" name="price" value="{{ $product->price }}" id="priceInputField" class="text-2xl font-semibold mt-auto mb-3">

                <button id="submitButton" onclick="onSubmitButtonClicked()">Submit</button>

            </section>
        </div>
        <div class="pl-5">
        </div>
    </div>

</div>
<!-- End Card -->
</div>
<!-- End Card Section -->
<script>
    function onSubmitButtonClicked() {
        const name = document.getElementById('nameInputField').value;
        const description = document.getElementById('descriptionInputField').value;
        const price = document.getElementById('priceInputField').value;
        const imageInput = document.getElementById('imageInputField');

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
                sendRequest(requestBody);
            };
            reader.readAsDataURL(image); // Read the image file as Base64
        } else {
            sendRequest(requestBody);
        }
    }

    function sendRequest(requestBody) {
        fetch('{{ route("products.update", ["product" => $product->id]) }}', {
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
</script>
@endsection