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
@foreach ($order->order_details as $order_detail)
<p>
    Product: {{ $order_detail->product->name }}
    Quantity: {{ $order_detail->amount }}
    Price: {{ $order_detail->product->price * $order_detail->amount}}
</p>
@endforeach
<p>
    Total Price: {{ $order->amount }}
</p>