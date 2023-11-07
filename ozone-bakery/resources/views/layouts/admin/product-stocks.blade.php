<style>
    th {
        /* Align the text to the left */
        border-bottom: 4px solid #c4b7a6;
    }

    tr {
        height: 70px;
        border-bottom: 1px solid #c4b7a6;
    }
</style>

@extends ('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <div class="flex flex-row mt-3">
            <h1 class="mr-auto mt-4 text-3xl font-semibold text-gray-800 dark:text-black">
                Product Stocks
            </h1>

            <button
                class="flex flex-wrap block m-2 mt-4 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                onclick="onAddStockButtonClicked()" id="addStockButton" style="display: block;">
                Add Stock
            </button>
        </div>

        <div class="bg-stone-200 rounded-xl shadow-lg mt-7 p-4 sm:p-7">

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width: 10%;" class="text-2xl text-left font-semibold pb-4 p-2">ID</th>
                        <th style="width: 30%;" class="text-2xl text-left font-semibold pb-4 p-2">Product</th>
                        <th style="width: 20%;" class="text-2xl text-left font-semibold pb-4 pl-12 p-2"> Amount</th>
                        <th style="width: 20%;" class="text-2xl text-left font-semibold pb-4 pl-8 p-2">Exp. date</th>
                    </tr>
                </thead>

                <tbody id="stockTable">

                </tbody>
                <tbody>
                    <tr id="new-stock-row" style="display: none;">
                        <td class="text-xl pl-4"></td>
                        <td>
                            <select id="newStockProduct"
                                class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all">
                            </select>
                        </td>
                        <td>
                            <input data-input-type="amount"
                                class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover-bg-white transition-all"
                                type="number" placeholder="Amount" id="newStockAmount"> <!-- Unique ID for amount input -->
                        </td>
                        <td>
                            <input data-input-type="exp-date"
                                class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover-bg-white transition-all"
                                type="date" id="newStockExpDate"> <!-- Unique ID for expDate input -->
                        </td>
                        <td class="flex flex-row">
                            <button
                                class="flex flex-wrap block m-2 mt-10 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all"
                                onclick="onSaveNewStockClicked()">Save</button>
                            <button
                                class="flex flex-wrap block m-2 mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all"
                                onclick="onCancelNewStockButtonClicked()">Cancel</button>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
@endsection

<script>
    // Fetch products from the API and populate the select element
    fetch('/api/products')
        .then(response => response.json())
        .then(data => {
            const newStockProductSelect = document.getElementById('newStockProduct');

            data.forEach(product => {
                const option = document.createElement('option');
                option.value = product.id;
                option.textContent = product.name;
                newStockProductSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));

    document.addEventListener("DOMContentLoaded", function() {
        const stockTable = document.getElementById('stockTable');
        fetch('/api/product-stocks')
            .then(response => response.json())
            .then(data => {
                // Clear existing table data
                stockTable.innerHTML = '';
                data.forEach(stock => {
                    // Create a new row
                    const row = document.createElement('tr');
                    row.setAttribute('data-stock-id', stock.id);
                    row.innerHTML = `
                    <td class="pl-4 text-xl">${stock.id}</td>
                    <td class="text-xl" data-product-name="${stock.product.name}">${stock.product.name}</td>
                    <td><input class="pr-2 text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all" min="0" type="number" onchange="onStockDetailChange(${stock.id})" id="stockAmountInput${stock.id}" value="${stock.amount}"></td>
                    <td><input class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all" min="{{ now()->format('Y-m-d') }}" type="date" onchange="onStockDetailChange(${stock.id})" id="stockExpDateInput${stock.id}" value="${stock.exp_date}"></td>                    
                    <td style="width: 15%">
    <button class="flex flex-wrap block m-2 mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all" id="saveStockButton${stock.id}" onclick="onSaveStockButtonClicked(${stock.id})" style="display: none">Save</button>
    <button class="flex flex-wrap block m-2 mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover-bg-stone-600 transition-all" id="deleteStockButton${stock.id}" onclick="onDeleteStockButtonClicked(${stock.id})">Delete</button>
</td>
                `;
                    stockTable.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
    });

    // Rest of your JavaScript code

    function onAddStockButtonClicked() {
        document.getElementById("new-stock-row").style.display = "table-row";
        document.getElementById("addStockButton").style.display = "none";
    }

    function onSaveNewStockClicked() {
        const productId = document.getElementById("newStockProduct").value;
        const amount = document.getElementById("newStockAmount").value; // Use the unique ID
        const expDate = document.getElementById("newStockExpDate").value; // Use the unique ID

        // Check the values
        console.log(productId, amount, expDate);
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
                document.getElementById(`saveStockButton${stockId}`).style.display = "none";
                document.getElementById(`deleteStockButton${stockId}`).style.display = "block";
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>
