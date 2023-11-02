@extends('layouts.main')

@section('content')

<form method='PUT' action="{{ route('products.update') }}">
    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="text" name="name" value="{{ $product->name }}">
    <input type="integer" name="price" value="{{ $product->price }}">

    <button type="submit">Submit</button>
</form>