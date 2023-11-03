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
            <td><input type="text" onchange="onIngredientDetailChange({{$ingredient->id}})" id="ingredientNameInput{{ $ingredient->id }}" value="{{ $ingredient->name }}"></td>
            <td><input type="text" onchange="onIngredientDetailChange({{$ingredient->id}})" id="ingredientQuantityUnitInput{{ $ingredient->id }}" value="{{ $ingredient->quantity_unit }}"></td>
            <td style="width: 25%;">
                <button onclick="onSaveIngredientButtonClicked({{$ingredient->id}})" id="saveIngredientButton{{$ingredient->id}}" style="display: none">Save</button>
                <button onclick="onDeleteIngredientButtonClicked({{$ingredient->id}})" id="deleteIngredientButton{{$ingredient->id}}">Delete</button>
            </td>
            @php
            $lastIngredientId = $ingredient->id;
            @endphp
        </tr>
        @endforeach
        <tr id="new-ingredient-row" style="display: none;">
            <td style="width: 5%;">{{ $lastIngredientId + 1 }}</td>
            <td style="width: 50%;"><input type="text" id="new-ingredient-name" style="width: 100%;"></td>
            <td style="width: 20%;"><input type="text" id="new-ingredient-quantity-unit" style="width: 100%;"></td>
            <td>
                <button onclick="onSaveNewIngredientButtonClicked()" id="saveNewIngredientButton">Save</button>
                <button onclick="onCancelNewIngredientButtonClicked()" id="cancleNewIngredientButton">Cancel</button>
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
    function onSaveIngredientButtonClicked(ingredientId) {
        const name = document.getElementById("ingredientNameInput" + ingredientId).value;
        const quantityUnit = document.getElementById("ingredientQuantityUnitInput" + ingredientId).value;
        fetch('api/ingredients/' + ingredientId, {
                method: 'PUT',
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
        }, 500); // 1000 milliseconds =
    }

    function onDeleteIngredientButtonClicked(ingredientId) {
        fetch('api/ingredients/' + ingredientId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
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

    function onSaveNewIngredientButtonClicked() {
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

    function onAddIngredientButtonClicked() {
        ingredientTable = document.getElementById("new-ingredient-row").style.display = "table-row";
        document.getElementById("addIngredientButton").style.display = "none";
    }

    function onIngredientDetailChange(ingredientId) {
        document.getElementById("saveIngredientButton" + ingredientId).style.display = "block";
        document.getElementById("deleteIngredientButton" + ingredientId).style.display = "none";
    }

    function onCancelNewIngredientButtonClicked() {
        document.getElementById("new-ingredient-row").style.display = "none";
        document.getElementById("addIngredientButton").style.display = "block";
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addIngredientButton").style.display = "block";
    });
</script>