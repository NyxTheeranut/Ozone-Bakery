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

@extends ('layouts.main')

@section('content')
    <div class="max-w-screen-xl px-4 py-1 sm:px-2 lg:px-2 lg:py-1 mx-auto">

        <div class="flex flex-row mt-3">
            <h1 class="mr-auto mt-4 mb-4 text-3xl font-semibold text-gray-800 dark:text-black">
                Recipes
            </h1>

            <tr>
                <td colspan="3"></td>
                <td style="text-align: right;">
                    <button
                        class="flex flex-wrap block m-2 mt-4 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                        onclick="onAddIngredientButtonClicked()" id="addIngredientButton" style="display: none;">
                        Add Ingredient
                    </button>
                </td>
            </tr>
        </div>

        <div class="bg-stone-200 rounded-xl shadow-lg mt-7 p-4 sm:p-7" style="width: 100%;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width: 5%" class="text-2xl text-center font-semibold pb-4 p-2">No.</th>
                        <th style="width: 40%" class="text-2xl text-center font-semibold pb-4 p-2">Ingredient Name</th>
                        <th style="width: 30%" class="text-2xl text-center font-semibold pb-4 p-2">Quantity</th>
                        <th style="width: 15%" class="text-2xl text-left font-semibold pb-4 p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $recipe_details = $recipe->recipe_details;
                        $recipe_detail_count = 0;
                    @endphp
                    @foreach ($recipe_details as $recipe_detail)
                        <tr style="width: 100%">
                            <td style="width: 5%;" class="text-center text-xl">{{ ++$recipe_detail_count }}</td>
                            <td style="width: 35%;" class="text-center text-xl pl-3">{{ $recipe_detail->ingredient->name }}
                            </td>
                            <td style="width: 30%;" class="text-center">
                                <div class="flex items-center justify-center">
                                    <input
                                        class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                        type="number" onchange="onQuantityInputChange({{ $recipe_detail->id }})"
                                        id="quantityInput{{ $recipe_detail->id }}" value="{{ $recipe_detail->quantity }}"
                                        style="width: 50%;">
                                    <div class="text-xl" style="width: 50%;">{{ $recipe_detail->ingredient->quantity_unit }}
                                    </div>
                                </div>
                            </td>
                            <td style="width: 10%;">
                                <button id="saveButton{{ $recipe_detail->id }}"
                                    onclick="onSaveIngredientButtonClicked({{ $recipe_detail }})"
                                    class="flex flex-wrap block mt-4 py-2 px-3 rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                    style="display: none">
                                    Save
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr id="new-ingredient-row">
                        <td class="text-xl text-center">{{ ++$recipe_detail_count }}</td>
                        <td class="text-xl text-center">
                            <select style="width: 50%;"
                                class="text-left text-lg rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                id="new-ingredient" onchange="onIngredientSelected()">
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="width: 30%;" class="text-center">
                            <div class="flex items-center justify-center">
                                <input class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                type="number" id="new-ingredient-quantity" style="width: 50%; line-height: 100%;">
                            <span class="text-xl mr-auto pl-10 ml-8" id="new-quantity-unit" style="width: 20%;"></span>
                            </div>
                            
                        </td>
                        
                        
                        
                        <td class="justify-center">
                            <div class="flex flex-row">
                               <button
                               class="flex flex-wrap block m-2 mt-4 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                               onclick="onSaveNewIngredientButtonClicked()" id="saveIngredientButton">
                                Save</button>
                            <button
                            class="flex flex-wrap block m-2 mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                            onclick="onCancelNewIngredientButtonClicked()" id="cancelIngredientButton">
                                Cancel</button> 
                            </div>
                            
                        </td>
                        
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: right;">
                            <span id="errorMessage" style="color: red"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

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
