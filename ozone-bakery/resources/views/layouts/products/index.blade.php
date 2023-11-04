@extends('layouts.main')

@section('content')
Pickup Date : 
<form method="get" action="/products">
    <input type="date" value="{{$pickUpDate}}" id="pickUpDate" name="pickUpDate">
    <button type="submit">Search</button>
<form>
@include('layouts.subviews.products', [
    'title' => 'Available Products',
    'products' => $availableProducts
])
@include('layouts.subviews.products', [
    'title' => 'All Products',
    'products' => $allProducts
])
@endsection