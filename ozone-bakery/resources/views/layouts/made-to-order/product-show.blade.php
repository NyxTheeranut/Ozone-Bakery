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
            </section>

            <section class="flex flex-col items-stretch w-[47%] ml-5 max-md:w-full">
                <h2 class="mt-8 text-3xl font-bold text-gray-800 text-black">
                    {{ $product->name  }}
                </h2>

                <p class="pl-4 mt-2 flex flex-wrap">
                    {{ $product->description  }}
                </p>

                <h1 class="text-2xl font-semibold mt-auto mb-3">
                    Price: {{ $product->price * $discount }} Baht
                </h1>
            </section>

            <section class="flex flex-col items-stretch w-[20%] ml-auto max-md:w-full">
                <form id="add-to-cart-form" method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="amount" value="1" min="1" max="100" class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all text-sm rounded-3xl">
                    <button type="submit" class="flex flex-wrap block mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover.bg-stone-600 transition-all text-sm rounded-3xl">
                        + | Add to Cart
                    </button>
                </form>
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
    function goBack() {
        window.history.back();
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#add-to-cart-form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = $(this).serialize(); // Serialize form data

            // Send an AJAX POST request to the route
            $.ajax({
                type: 'POST',
                url: "{{ route('cart.add') }}",
                data: formData,
                success: function(response) {
                    // Handle the response as needed, e.g., update the UI
                    console.log('Success: ' + response);
                },
                error: function(xhr) {
                    // Handle errors if any
                    console.error('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection