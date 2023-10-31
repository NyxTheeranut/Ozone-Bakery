<p>
    Order ID: {{ $order->id }}
</p>
<p>
    Order Date: {{ $order->created_at }}
</p>
<p>
    The owner of the order: {{ $order->user->name }}
</p>
<p>
    Order Status: {{ $order->status }}
</p>
@php
    $total = 0;
@endphp
@foreach ($order->order_details as $order_detail)
<p>
    Product: {{ $order_detail->product->name }}
    Quantity: {{ $order_detail->amount }}
    Price: {{ $order_detail->product->price * $order_detail->amount }}
    @php
        $total += $order_detail->product->price * $order_detail->amount;
    @endphp
</p>
@endforeach
<p>
    Total Price: {{ $total }}
</p>