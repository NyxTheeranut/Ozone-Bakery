@extends('layouts.main')

@section('content')

<head>
    @php
    $category = request()->query('category', 'order');
    @endphp
</head>

<div>Order</div>

<button onclick="onToggleOrderTypeButtonClicked()" id="toggleOrderTypeButton" data-status=0>Retail Order</button>

<div style="text-align: center; justify-content: center; align-items: center; display: flex; width: 100%">
    <div id="orderTable" style="width: 100%">
        <div style="text-align: center; justify-content: center; align-items: center; display: flex; width: 100%">
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Create At</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5"><strong>Active Order</strong></td>
                    <tr>
                        @foreach ($activeOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td><button onclick="onShowOrderDetailButtonClicked('{{ $order->id }}')" id="showOrderDetailButton{{$order->id}}">Show Detail</button></td>
                        <td>
                            @if ($order->status === 'Pending')
                            <p><button onclick="onOrderActionButtonClicked('{{ $order->id }}', 'Waiting')" id="confirmOrderButton{{$order->id}}">Confirm Payment</button></p>
                            <p><button onclick="onOrderRejectButtonClicked('{{ $order->id }}')" id="rejectOrderButton{{$order->id}}">Reject Order</button></p>
                            @elseif ($order->status === 'Waiting')
                            <button onclick="onOrderActionButtonClicked('{{ $order->id }}', 'Completed')" id="completeOrderButton{{$order->id}}">Complete Order</button>
                            @endif
                        </td>
                    </tr>
                    <tr id="orderDetail{{$order->id}}" style="display: none">
                        <td colspan="5">
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->order_details as $orderDetail)
                                    <tr>
                                        <td>{{ $orderDetail->product_id }}</td>
                                        <td>{{ $orderDetail->product->name }}</td>
                                        <td>{{ $orderDetail->amount }}</td>
                                        <td>{{ $orderDetail->price() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"><strong>Inactive Order</strong></td>
                    <tr>
                        @foreach ($inactiveOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td><button onclick="onShowOrderDetailButtonClicked('{{ $order->id }}')" id="showOrderDetailButton{{$order->id}}">Show Detail</button></td>
                    </tr>
                    <tr id="orderDetail{{$order->id}}" style="display: none">
                        <td colspan="5">
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->order_details as $orderDetail)
                                    <tr>
                                        <td>{{ $orderDetail->product_id }}</td>
                                        <td>{{ $orderDetail->product->name }}</td>
                                        <td>{{ $orderDetail->amount }}</td>
                                        <td>{{ $orderDetail->price() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="madeToOrderTable" style="width: 100%">
        <div style="text-align: center; justify-content: center; align-items: center; display: flex; width: 100%">
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th>Made to Order ID</th>
                        <th>Status</th>
                        <th>Pickup Date</th>
                        <th>Description</th>
                        <th>Detail</th>
                        <th>Ingredient</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7"><strong>Active Made to Order</strong></td>
                    </tr>
                    @foreach ($activeMadeToOrders as $made_to_order)
                    <tr>
                        <td>{{ $made_to_order->id }}</td>
                        <td>{{ $made_to_order->status }}</td>
                        <td>{{ $made_to_order->pickup_date }}</td>
                        <td>{{ $made_to_order->description }}</td>
                        <td><button onclick="onShowMadeToOrderDetailButtonClicked('{{ $made_to_order->id }}')" id="showMadeToOrderDetailButton{{$made_to_order->id}}">Show Detail</button></td>
                        <td><a href="/admin/made-to-orders/{{ $made_to_order->id }}/ingredients">Show Ingredient</a></td>
                        <td>
                            @if ($made_to_order->status === 'Pending Confirmation')
                            <button onclick="onMadeToOrderActionButtonClicked('{{ $made_to_order->id }}', 'In Progress')" id="confirmMadeToOrderButton{{$made_to_order->id}}">Confirm Payment</button>
                            <button onclick="onMadeToOrderActionButtonClicked('{{ $made_to_order->id }}', 'Rejected')" id="rejectMadeToOrderButton{{$made_to_order->id}}">Reject Order</button>
                            @elseif ($made_to_order->status === 'In Progress')
                            <button onclick="onMadeToOrderActionButtonClicked('{{ $made_to_order->id }}', 'Ready for pickup')" id="completeMadeToOrderButton{{$made_to_order->id}}">Ready for pickup</button>
                            @elseif ($made_to_order->status === 'Ready for pickup')
                            <button onclick="onMadeToOrderActionButtonClicked('{{ $made_to_order->id }}', 'Complete')" id="completeMadeToOrderButton{{$made_to_order->id}}">Complete Order</button>
                            @endif
                        </td>
                    </tr>
                    <tr id="madeToOrderDetail{{$made_to_order->id}}" style="display: none">
                        <td colspan="7">
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($made_to_order->made_to_order_details as $made_to_order_detail)
                                    <tr>
                                        <td>{{ $made_to_order_detail->product_id }}</td>
                                        <td>{{ $made_to_order_detail->product->name }}</td>
                                        <td>{{ $made_to_order_detail->amount }}</td>
                                        <td>{{ $made_to_order_detail->price() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7"><strong>Inactive Made to Order</strong></td>
                    </tr>
                    @foreach ($inactiveMadeToOrders as $made_to_order)
                    <tr>
                        <td>{{ $made_to_order->id }}</td>
                        <td>{{ $made_to_order->status }}</td>
                        <td>{{ $made_to_order->pickup_date }}</td>
                        <td>{{ $made_to_order->description }}</td>
                        <td><button onclick="onShowMadeToOrderDetailButtonClicked('{{ $made_to_order->id }}')" id="showMadeToOrderDetailButton{{$made_to_order->id}}">Show Detail</button></td>
                        <td><a href="/admin/made-to-orders/{{ $made_to_order->id }}/ingredients">Show Ingredient</a></td>
                    </tr>
                    <tr id="madeToOrderDetail{{$made_to_order->id}}" style="display: none">
                        <td colspan="7">
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($made_to_order->made_to_order_details as $made_to_order_detail)
                                    <tr>
                                        <td>{{ $made_to_order_detail->product_id }}</td>
                                        <td>{{ $made_to_order_detail->product->name }}</td>
                                        <td>{{ $made_to_order_detail->amount }}</td>
                                        <td>{{ $made_to_order_detail->price() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>

    function onOrderRejectButtonClicked(orderId) {
        if (confirm("Are you sure you want to change the status of this order to " + status + "?"))
            fetch('/api/orders/reject/' + orderId, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                reloadPageWithCategory('order');
            })
            .catch(error => {
                console.log(error);
            });
    }

    function onOrderActionButtonClicked(orderId, status) {
        if (confirm("Are you sure you want to change the status of this order to " + status + "?"))
            fetch('/api/orders/' + orderId, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                reloadPageWithCategory('order');
            })
            .catch(error => {
                console.log(error);
            });
    }

    function onMadeToOrderActionButtonClicked(madeToOrderId, status) {
        if (confirm("Are you sure you want to change the status of this made to order to " + status + "?"))
            fetch('/api/made-to-orders/' + madeToOrderId, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                reloadPageWithCategory('made-to-order');
            })
            .catch(error => {
                console.log(error);
            });
    }

    function onShowOrderDetailButtonClicked(orderId) {
        const orderDetail = document.getElementById("orderDetail" + orderId);
        const showOrderDetailButton = document.getElementById("showOrderDetailButton" + orderId);
        const display = orderDetail.style.display;

        if (display === "none") {
            orderDetail.style.display = "table-row";
            showOrderDetailButton.textContent = "Hide Detail";
        } else {
            orderDetail.style.display = "none";
            showOrderDetailButton.textContent = "Show Detail";
        }
    }

    function onShowMadeToOrderDetailButtonClicked(madeToOrderId) {
        const madeToOrderDetail = document.getElementById("madeToOrderDetail" + madeToOrderId);
        const showMadeToOrderDetailButton = document.getElementById("showMadeToOrderDetailButton" + madeToOrderId);
        const display = madeToOrderDetail.style.display;

        if (display === "none") {
            madeToOrderDetail.style.display = "table-row";
            showMadeToOrderDetailButton.textContent = "Hide Detail";
        } else {
            madeToOrderDetail.style.display = "none";
            showMadeToOrderDetailButton.textContent = "Show Detail";
        }
    }

    function onToggleOrderTypeButtonClicked() {
        let toggleOrderTypeButton = document.getElementById("toggleOrderTypeButton");

        if (toggleOrderTypeButton.getAttribute("data-status") === '0') {
            reloadPageWithCategory('order');
        } else {
            reloadPageWithCategory('made-to-order');
        }
    }

    function toggle(displayOrder) {
        let orderTable = document.getElementById("orderTable");
        let madeToOrderTable = document.getElementById("madeToOrderTable");
        let toggleOrderTypeButton = document.getElementById("toggleOrderTypeButton");

        if (displayOrder) {
            orderTable.style.display = 'table';
            madeToOrderTable.style.display = 'none';
            toggleOrderTypeButton.textContent = "Retail Order";
            toggleOrderTypeButton.setAttribute("data-status", 1);
        } else {
            orderTable.style.display = 'none';
            madeToOrderTable.style.display = 'table';
            toggleOrderTypeButton.textContent = "Made to Order";
            toggleOrderTypeButton.setAttribute("data-status", 0);
        }
    }


    function reloadPageWithCategory(category) {
        // Get the current URL
        const currentUrl = window.location.href;
        // Update the URL with the category query parameter
        const newUrl = updateQueryStringParameter(currentUrl, 'category', category);
        // Reload the page with the new URL
        window.location.href = newUrl;
    }

    function updateQueryStringParameter(uri, key, value) {
        const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        const separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        if ("{{$category}}" === 'order') {
            toggle(true);
        } else {
            toggle(false);
        }
    });
</script>

@endsection