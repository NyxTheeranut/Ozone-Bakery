@extends('layouts.main')

@section('content')
Add product
<input type="text" name="name" id="name" placeholder="name">
<input type="text" name="price" id="price" placeholder="price">
<input type="text" name="description" id="description" placeholder="description">
<input type="file" name="image" id="image" placeholder="image">
@endsection