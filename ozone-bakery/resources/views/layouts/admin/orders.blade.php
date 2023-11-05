<style>
    th {
        /* Align the text to the left */
        border-bottom: 4px solid #c4b7a6;
    }

    tr {
        height: 130px;
        border-bottom: 1px solid #c4b7a6;
    }
</style>

@extends('layouts.main')

@section('content')

    <head>
        @php
            $category = request()->query('category', 'order');
        @endphp
    </head>

    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">
        <!-- Card -->
        <div class="flex flex-row mt-3">
            <h1 class="mt-5 text-3xl font-semibold">
                Orders
            </h1>
            <p class="ml-5 mt-7 text-xl ">
                type:
            </p>
            <button
                class="flex flex-wrap block m-2 mt-6 py-1 px-3 mr-auto rounded-3xl border border-transparent font-semibold bg-stone-400 text-white text-xl hover:bg-stone-500 transition-all"
                onclick="onToggleOrderTypeButtonClicked()" id="toggleOrderTypeButton" data-status=0>
                Retail Order</button>
        </div>
        <div class="bg-stone-200 rounded-xl shadow-lg w-full mt-7 p-4 sm:p-10">
            <div style="text-align: center; justify-content: center; align-items: center; display: flex; width: 100%">
                <div id="orderTable" style="width: 100%">
                    <div
                        style="text-align: center; justify-content: center; align-items: center; display: flex; width: 100%">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Order ID</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Order Status</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Created At</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Detail</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5"><strong class="text-lg text-center pb-4 p-2">Active Order</strong>
                                    </td>
                                </tr>
                                    @foreach ($activeOrders as $order)
                                <tr>
                                    <td class="text-lg font-semibold text-center">{{ $order->id }}</td>
                                    <td class="text-lg font-semibold text-center">{{ $order->status }}</td>
                                    <td class="text-lg font-semibold text-center">{{ $order->created_at }}</td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; justify-content: center;">
                                            <button
                                                class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                onclick="onShowOrderDetailButtonClicked('{{ $order->id }}')"
                                                id="showOrderDetailButton{{ $order->id }}">Show Detail</button>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                            @if ($order->status === 'Pending')
                                                <div>
                                                    <button
                                                        class="py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                        onclick="onOrderActionButtonClicked('{{ $order->id }}', 'Waiting')"
                                                        id="confirmOrderButton{{ $order->id }}">Confirm Payment</button>
                                                </div>
                                                <div>
                                                    <button
                                                        class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-black text-white text-lg hover:bg-red-700 transition-all"
                                                        onclick="onOrderActionButtonClicked('{{ $order->id }}', 'Failed')"
                                                        id="rejectOrderButton{{ $order->id }}">Reject Order</button>
                                                </div>
                                            @elseif ($order->status === 'Waiting')
                                                <button
                                                    class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                    onclick="onOrderActionButtonClicked('{{ $order->id }}', 'Completed')"
                                                    id="completeOrderButton{{ $order->id }}">Complete Order</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>



                                <tr id="orderDetail{{ $order->id }}" style="display: none">
                                    <td colspan="5">
                                        <table style="width: 100%">
                                            <thead>
                                                <tr class="bg-stone-300">
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Product ID</th>
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Product Name</th>
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Quantity</th>
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->order_details as $orderDetail)
                                                    <tr class="bg-stone-300">
                                                        <td class="text-lg font-semibold text-center">
                                                            {{ $orderDetail->product_id }}</td>
                                                        <td class="text-lg text-center">{{ $orderDetail->product->name }}
                                                        </td>
                                                        <td class="text-lg text-center">{{ $orderDetail->amount }}</td>
                                                        <td class="text-lg font-semibold text-center">
                                                            {{ $orderDetail->price() }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"><strong class="text-lg text-center pb-4 p-2">Inactive Order</strong>
                                    </td>
                                </tr>
                                    @foreach ($inactiveOrders as $order)
                                <tr>
                                    <td class="text-lg font-semibold text-center">{{ $order->id }}</td>
                                    <td class="text-lg font-semibold text-center">{{ $order->status }}</td>
                                    <td class="text-lg font-semibold text-center">{{ $order->created_at }}</td>
                                    <td>
                                        <div style="display: flex; justify-content: center;">
                                            <button
                                                class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                onclick="onShowOrderDetailButtonClicked('{{ $order->id }}')"
                                                id="showOrderDetailButton{{ $order->id }}">Show Detail</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="orderDetail{{ $order->id }}" style="display: none">
                                    <td colspan="5">
                                        <table style="width: 100%">
                                            <thead>
                                                <tr class="bg-stone-300">
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Product ID</th>
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Product Name</th>
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Quantity</th>
                                                    <th class="text-xl text-center font-semibold pb-4 p-2">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->order_details as $orderDetail)
                                                    <tr class="bg-stone-300">
                                                        <td class="text-lg font-semibold text-center">
                                                            {{ $orderDetail->product_id }}</td>
                                                        <td class="text-lg font-semibold text-center">
                                                            {{ $orderDetail->product->name }}
                                                        </td>
                                                        <td class="text-lg font-semibold text-center">
                                                            {{ $orderDetail->amount }}</td>
                                                        <td class="text-lg font-semibold text-center">
                                                            {{ $orderDetail->price() }}</td>
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
                    <div
                        style="text-align: center; justify-content: center; align-items: center; display: flex; width: 100%">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">MTO ID</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Status</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Pickup Date</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Description</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Detail</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Ingredient</th>
                                    <th class="text-2xl text-center font-semibold pb-4 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7"><strong>Active Made to Order</strong></td>
                                </tr>
                                @foreach ($activeMadeToOrders as $made_to_order)
                                    <tr>
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->id }}</td>
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->status }}</td>
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->pickup_date }}
                                        </td>
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->description }}
                                        </td>
                                        <td>
                                            <div style="display: flex; justify-content: center;">
                                                <button
                                                    class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                    onclick="onShowMadeToOrderDetailButtonClicked('{{ $made_to_order->id }}')"
                                                    id="showMadeToOrderDetailButton{{ $made_to_order->id }}">Show
                                                    Detail</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; justify-content: center;">
                                                <a class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                    href="/admin/made-to-orders/{{ $made_to_order->id }}/ingredients">Show
                                                    Ingredient</a>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($made_to_order->status === 'Pending Confirmation')
                                                <div style="display: flex; justify-content: center;">
                                                    <button
                                                        class="py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                        onclick="onMadeToOrderButtonActionClicked('{{ $made_to_order->id }}', 'In Progress')"
                                                        id="confirmMadeToOrderButton{{ $made_to_order->id }}">Confirm
                                                        Payment</button>
                                                </div>
                                                <div style="display: flex; justify-content: center;">
                                                    <button
                                                        class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold  bg-black text-white text-lg hover:bg-red-700 transition-all"
                                                        onclick="onMadeToOrderButtonActionClicked('{{ $made_to_order->id }}', 'Rejected')"
                                                        id="rejectMadeToOrderButton{{ $made_to_order->id }}">Reject
                                                        Order</button>
                                                </div>
                                            @elseif ($made_to_order->status === 'In Progress')
                                                <div style="display: flex; justify-content: center;">
                                                    <button
                                                        class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                        onclick="onMadeToOrderButtonActionClicked('{{ $made_to_order->id }}', 'Ready for pickup')"
                                                        id="completeMadeToOrderButton{{ $made_to_order->id }}">Ready for
                                                        pickup</button>
                                                </div>
                                            @elseif ($made_to_order->status === 'Ready for pickup')
                                                <div style="display: flex; justify-content: center;">
                                                    <button
                                                        class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                        onclick="onMadeToOrderButtonActionClicked('{{ $made_to_order->id }}', 'Complete')"
                                                        id="completeMadeToOrderButton{{ $made_to_order->id }}">Complete
                                                        Order</button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr id="madeToOrderDetail{{ $made_to_order->id }}" style="display: none">
                                        <td colspan="7">
                                            <table style="width: 100%">
                                                <thead>
                                                    <tr class="bg-stone-300">>
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Product ID
                                                        </th>
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Product Name
                                                        </th>
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Quantity
                                                        </th>
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($made_to_order->made_to_order_details as $made_to_order_detail)
                                                        <tr class="bg-stone-300">
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->product_id }}</td>
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->product->name }}</td>
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->amount }}</td>
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->price() }}</td>
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
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->id }}</td>
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->status }}</td>
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->pickup_date }}
                                        </td>
                                        <td class="text-lg font-semibold text-center">{{ $made_to_order->description }}
                                        </td>
                                        <td><button
                                                class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                onclick="onShowMadeToOrderDetailButtonClicked('{{ $made_to_order->id }}')"
                                                id="showMadeToOrderDetailButton{{ $made_to_order->id }}">Show
                                                Detail</button></td>
                                        <td>
                                            <div style="display: flex; justify-content: center;">
                                                <a class="mt-2 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-lg hover:bg-stone-600 transition-all"
                                                    href="/admin/made-to-orders/{{ $made_to_order->id }}/ingredients">Show
                                                    Ingredient</a>
                                        </td>

                                    </tr>
                                    <tr id="madeToOrderDetail{{ $made_to_order->id }}" style="display: none">
                                        <td colspan="7">
                                            <table style="width: 100%">
                                                <thead>
                                                    <tr class="bg-stone-300">
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Product ID
                                                        </th>
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Product Name
                                                        </th>
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Quantity
                                                        </th>
                                                        <th class="text-xl text-center font-semibold pb-4 p-2">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($made_to_order->made_to_order_details as $made_to_order_detail)
                                                        <tr class="bg-stone-300">
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->product_id }}</td>
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->product->name }}</td>
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->amount }}</td>
                                                            <td class="text-lg font-semibold text-center">
                                                                {{ $made_to_order_detail->price() }}</td>
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
        </div>

        <script>
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

            function onMadeToOrderButtonActionClicked(madeToOrderId, status) {
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
                if ("{{ $category }}" === 'order') {
                    toggle(true);
                } else {
                    toggle(false);
                }
            });
        </script>
    @endsection
