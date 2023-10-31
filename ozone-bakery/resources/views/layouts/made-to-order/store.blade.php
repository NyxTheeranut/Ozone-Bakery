<form action="{{ route('made-to-order.store') }}" method="POST">
    @csrf
    <input type="list" name="product" value="{{ $product['name'] }}">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>