@extends('layouts.main')

@section('content')

@foreach ($madeToOrderDetails as $madeToOrderDetail)
<p>
    {{ $madeToOrderDetail->product->name}}
</p>
<p>
    @foreach ($madeToOrderDetail->product->recipe->recipe_details as $recipe_detail)
        <p>{{ $recipe_detail->ingredient->name }} : {{ $recipe_detail->quantity }} {{ $recipe_detail->ingredient->quantity_unit }}</p>
    @endforeach
</p>
@endforeach

@endsection