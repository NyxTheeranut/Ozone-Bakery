<style>
    th {
        text-align: left;
        /* Align the text to the left */
    }

    td {
        text-align: left;
        /* Align the text to the left */
    }
</style>

<table style="width: 50%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="width: 5%;" class="text-left">ID</th>
            <th style="width: 50%;" class="text-left">Product</th>
            <th style="width: 20%;" class="text-left">Amount</th>
            <th style="width: 10%;" class="text-left">Exp. date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productStocks as $stock)
        <tr>
            <td>{{ $stock->id }}</td>
            <td>{{ $stock->product->name }}</td>
            <td><input type="number" onchange="onStockDetailChange({{$stock->id}})" id="stockAmountInput{{ $stock->id }}" value="{{ $stock->amount }}"></td>
            <td><input type="date" onchange="onStockDetailChange({{$stock->id}})" id="stockExpDateInput{{ $stock->id }}" value="{{ $stock->exp_date }}"></td>
            <td style="width: 25%;">
                <button onclick="onSaveStockButtonClicked({{$stock->id}})" id="saveStockButton{{$stock->id}}" style="display: none">Save</button>
                <button onclick="onDeleteStockButtonClicked({{$stock->id}})" id="deleteStockButton{{$stock->id}}">Delete</button>
            </td>
            @php
            $lastStockId = $stock->id;
            @endphp
        </tr>
        @endforeach
        <tr id="new-stock-row" style="display: none;">
            <td>{{ $lastStockId + 1 }}</td>
            <td>
                <select id="newStockProduct">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" id="newStockAmount"></td>
            <td><input type="date" id="newStockExpDate"></td>
            <td>
                <button onclick="onSaveNewStockClicked()" id="saveNewStockButton">Save</button>
                <button onclick="onCancelNewStockButtonClicked()" id="cancleNewStockButton">Cancel</button>
            </td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td style="text-align: right;">
                <button onclick="onAddStockButtonClicked()" id="addStockButton" style="display: block;">
                    Add Stock
                </button>
            </td>
        </tr>
    </tbody>
</table>

<script>
    function onAddStockButtonClicked() {
        document.getElementById("new-stock-row").style.display = "table-row";
        document.getElementById("addStockButton").style.display = "none";
    }

    function onSaveNewStockClicked() {
        const productId = document.getElementById("newStockProduct").value;
        const amount = document.getElementById("newStockAmount").value;
        const expDate = document.getElementById("newStockExpDate").value;
        console.log(productId + " " + amount + " " + expDate);
        fetch('api/product-stocks', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    amount: amount,
                    exp_date: expDate
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        // setTimeout(function() {
        //     location.reload();
        // }, 500); // 1000 milliseconds = 1 second
    }

    function onCancelNewStockButtonClicked() {
        document.getElementById("new-stock-row").style.display = "none";
        document.getElementById("addStockButton").style.display = "block";
    }

    function onDeleteStockButtonClicked(stockId) {
        fetch(`api/product-stocks/${stockId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    function onStockDetailChange(stockId) {
        document.getElementById(`saveStockButton${stockId}`).style.display = "block";
        document.getElementById(`deleteStockButton${stockId}`).style.display = "none";
    }

    function onSaveStockButtonClicked(stockId) {
        const amount = document.getElementById(`stockAmountInput${stockId}`).value;
        const expDate = document.getElementById(`stockExpDateInput${stockId}`).value;
        fetch(`api/product-stocks/${stockId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    amount: amount,
                    exp_date: expDate
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>