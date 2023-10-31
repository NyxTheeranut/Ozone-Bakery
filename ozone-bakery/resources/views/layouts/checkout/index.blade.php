@foreach ($cartItems as $cartItem)
    <div>
        <p>Product: {{ $cartItem['product'] }}</p>
        <p>Quantity: {{ $cartItem['quantity'] }}</p>
    </div>
@endforeach

<!-- Add any additional checkout information and styling as needed -->
