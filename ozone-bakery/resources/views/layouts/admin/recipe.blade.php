<table style="width: 50%">
    <thead>
        <tr style="width: 100%">
            <th style="width: 5%">No.</th>
            <th style="width: 55%">Ingredient Name</th>
            <th style="width: 35%">Quantity</th>
            <th style="width: 10%"></th>
        </tr>
    </thead>
    <tbody>
        @php
        $recipe_details = $recipe->recipe_details;
        $recipe_detail_count = 0;
        @endphp
        @foreach($recipe_details as $recipe_detail)
        <tr style="width: 100%">
            <td style="width: 5%">{{ ++$recipe_detail_count }}</td>
            <td style="width: 55%">{{ $recipe_detail->ingredient->name }}</td>
            <td style="width: 35%; display: flex;">
                <input type="number" onchange="onQuantityInputChange({{$recipe_detail->id}})" id="quantityInput{{ $recipe_detail->id }}" value="{{ $recipe_detail->quantity }}" style="width: 50%; flex: 1;">
                <div style="width: 50%; flex: 1;">{{ $recipe_detail->ingredient->quantity_unit }}</div>
            </td>

            <td style="width: 10%;">
                <button id="saveButton{{ $recipe_detail->id }}" onclick="onSaveIngredientButtonClicked({{ $recipe_detail }})" style="display: none">
                    Save
                </button>
            </td>
        </tr>
        @endforeach
        <tr id="new-ingredient-row">
            <td>{{ ++$recipe_detail_count }}</td>
            <td>
                <select id="new-ingredient" onchange="onIngredientSelected()">
                    @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </td>
            <td style="width: 35%; display: flex;">
                <input type="number" id="new-ingredient-quantity" style="width: 50%">
                <span id="new-quantity-unit" style="width: 50%"></span>
            </td>
            <td>
                <button onclick="onSaveNewIngredientButtonClicked()" id="saveIngredientButton">Save</button>
                <button onclick="onCancelNewIngredientButtonClicked()" id="cancelIngredientButton">Cancel</button>
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
        <tr>
            <td colspan="3" style="text-align: right;">
                <span id="errorMessage" style="color: red"><span> 
            </td>
        </tr>
    </tbody>
</table>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addIngredientButton").style.display = "block";
        document.getElementById("new-ingredient-row").style.display = "none";
        onIngredientSelected();
    });

    function onAddIngredientButtonClicked() {
        document.getElementById("new-ingredient-row").style.display = "table-row";
        document.getElementById("addIngredientButton").style.display = "none";
    }

    function onSaveNewIngredientButtonClicked() {
        const recipeId = {{ $recipe->id }};
        const ingredientId = document.getElementById('new-ingredient').value;
        const quantity = document.getElementById('new-ingredient-quantity').value;

        fetch('/api/recipe-details', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    recipe_id: recipeId,
                    ingredient_id: ingredientId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById("errorMessage").textContent = data.error;
                    return;
                }
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        setTimeout(function() {
            location.reload();
        }, 500); // 1000 milliseconds = 1 second
    }

    function onSaveIngredientButtonClicked(recipeDetail) {
        const quantity = document.getElementById('quantityInput' + recipeDetail.id).value;

        fetch('/api/recipe-details/' + recipeDetail.id, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById("errorMessage").textContent = data.error;
                    return;
                }
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        setTimeout(function() {
            location.reload();
        }, 500); // 1000 milliseconds = 1 second
    }

    function onQuantityInputChange(id) {
        document.getElementById("saveButton" + id).style.display = "block";
    }

    function onCancelNewIngredientButtonClicked() {
        document.getElementById("new-ingredient-row").style.display = "none";
        document.getElementById("addIngredientButton").style.display = "block";
        document.getElementById("errorMessage").textContent = "";
    }

    function onIngredientSelected() {
        const id = getNewIngredientSelectedValue();
        var ingredients = @json($ingredients);

        const ingredient = ingredients.find(i => i.id == id);
        document.getElementById("new-quantity-unit").textContent = ingredient.quantity_unit;

        //document.getElementById("new-quantity-unit").textContent = ingredient[2];

    }

    function getNewIngredientSelectedValue() {
        var selectElement = document.getElementById('new-ingredient');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedValue = selectedOption.value;
        return selectedValue;
    }
</script>