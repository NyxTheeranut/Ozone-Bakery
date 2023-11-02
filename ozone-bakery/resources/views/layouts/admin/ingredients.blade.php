<style>
    th {
        text-align: left; /* Align the text to the left */
    }
    td {
        text-align: left; /* Align the text to the left */
    }

</style>

<table style="width: 75%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="width: 5%;" class="text-left">ID</th>
            <th style="width: 50%;" class="text-left">Name</th>
            <th style="width: 20%;" class="text-left">Quantity Unit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ingredients as $ingredient)
        <tr>
            <td>{{ $ingredient->id }}</td>
            <td>{{ $ingredient->name }}</td>
            <td>{{ $ingredient->quantity_unit }}</td>
            @php
            $lastIngredientId = $ingredient->id;
            @endphp
        </tr>
        @endforeach
        <tr id="new-ingredient-row" style="display: none;">
            <td style="width: 5%;">{{ $lastIngredientId + 1 }}</td>
            <td style="width: 50%;"><input type="text" id="new-ingredient-name" style="width: 100%;"></td>
            <td style="width: 20%;"><input type="text" id="new-ingredient-quantity-unit" style="width: 100%;"></td>
            <td >
                <button onclick="onSaveIngredientButtonClicked()" id="saveIngredientButton">Save</button>
                <button onclick="onCancelIngredientButtonClicked()" id="cancleIngredientButton">Cancel</button>
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td style="text-align: right;">
                <button onclick="onAddIngredientButtonClicked()" id="addIngredientButton" style="display: none;">
                    Add Ingredient
                </button>
            </td>
        </tr>
    </tbody>
</table>

<script>
    function onAddIngredientButtonClicked() {
        ingredientTable = document.getElementById("new-ingredient-row").style.display = "table-row";
        document.getElementById("addIngredientButton").style.display = "none";
    }

    function onSaveIngredientButtonClicked() {
        console.log("onSaveIngredientButtonClicked");
        const name = document.getElementById("new-ingredient-name").value;
        const quantityUnit = document.getElementById("new-ingredient-quantity-unit").value;
        fetch('/ingredients', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    quantity_unit: quantityUnit
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        setTimeout(function() {
            location.reload();
        }, 500); // 1000 milliseconds = 1 second
    }

    function onCancelIngredientButtonClicked() {
        document.getElementById("new-ingredient-row").style.display = "none";
        document.getElementById("addIngredientButton").style.display = "block";
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addIngredientButton").style.display = "block";
    });
</script>