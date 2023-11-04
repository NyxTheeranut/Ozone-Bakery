@extends('layouts.main')

@section('content')
Pickup Date :
<form method="post" action="{{ route('pickupDate.set') }}">
    <input type="date" value="{{$pickupDate}}" id="pickupDate" name="pickupDate" onchange="onPickupDateChange()">

    @include('layouts.subviews.products', [
    'title' => 'Available Products',
    'products' => $availableProducts,
    'pickupDate' => $pickupDate
    ])
    @include('layouts.subviews.products', [
    'title' => 'All Products',
    'products' => $allProducts,
    'pickupDate' => $pickupDate
    ])

    <script>

        document.addEventListener('DOMContentLoaded', function () {
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