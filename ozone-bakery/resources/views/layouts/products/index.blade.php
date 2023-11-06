@extends('layouts.main')

@section('content')
<div class="flex flex-col justify-center items-center pt-10">
    <span class="text-lg mt-2 mb-2 flex-wrap text-stone-500">Please select pick-up date before browsing our products.</span>
    <div class="flex flex-wrap flex-row mt-2 py-2 px-3 rounded-xl bg-stone-300">
        <span class="text-xl font-semibold mt-2 mr-5">Pickup Date: </span>
        <form method="post" action="{{ route('pickupDate.set') }}">
            <input class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
            style="border-width: 4px;"
            type="date" min="{{date('Y-m-d')}}" value="{{ $pickupDate }}" id="pickupDate" name="pickupDate" onchange="onPickupDateChange()">
        </form>
    </div>
</div>
    @include('layouts.subviews.products', [
        'title' => 'Available Products',
        'products' => $availableProducts,
        'pickupDate' => $pickupDate,
    ])
    @include('layouts.subviews.products', [
        'title' => 'All Products',
        'products' => $allProducts,
        'pickupDate' => $pickupDate,
    ])

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date().toISOString().slice(0, 10);
            document.getElementById("pickupDate").setAttribute('min', now);
        });

        function onPickupDateChange() {
            console.log(document.getElementById('pickupDate').value);
            fetch('/pickupDate', {
                method: 'PUT',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    pickupDate: document.getElementById('pickupDate').value
                })
            }).then(response => {
                location.reload();
            })
        }
    </script>
@endsection
