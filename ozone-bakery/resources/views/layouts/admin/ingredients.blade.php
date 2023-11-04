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
            <h1 class="mr-auto mt-4 text-3xl font-semibold text-gray-800 dark:text-black">
                Ingredients
            </h1>

            <button
                class="inline-block m-2 mt-4 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                onclick="onAddIngredientButtonClicked()" id="addIngredientButton" style="display: none;">
                Add Ingredient
            </button>
        </div>


        <div class="bg-stone-200 rounded-xl shadow-lg mt-7 p-4 sm:p-7">

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width: 10%;" class="text-2xl text-left font-semibold pb-4 p-2">ID</th>
                        <th style="width: 40%;" class="text-2xl text-left font-semibold pb-4 pl-10 p-2">Ingredient</th>
                        <th style="width: 30%;" class="text-2xl text-left font-semibold pb-4 pl-6 p-2">Quantity Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr>
                            <td class="text-xl pl-4">{{ $ingredient->id }}</td>
                            <td><input
                                    class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                    type="text" onchange="onIngredientDetailChange({{ $ingredient->id }})"
                                    id="ingredientNameInput{{ $ingredient->id }}" value="{{ $ingredient->name }}"></td>
                            <td><input
                                    class="text-center rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                    type="text" onchange="onIngredientDetailChange({{ $ingredient->id }})"
                                    id="ingredientQuantityUnitInput{{ $ingredient->id }}"
                                    value="{{ $ingredient->quantity_unit }}"></td>
                            <td style="width: 10%;">
                                <button
                                    class="flex flex-wrap block m-2 mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                    onclick="onSaveIngredientButtonClicked({{ $ingredient->id }})"
                                    id="saveIngredientButton{{ $ingredient->id }}" style="display: none">Save</button>
                                <button
                                    class="flex flex-wrap block m-2 mt-auto py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                    onclick="onDeleteIngredientButtonClicked({{ $ingredient->id }})"
                                    id="deleteIngredientButton{{ $ingredient->id }}">Delete</button>
                            </td>
                            @php
                                $lastIngredientId = $ingredient->id;
                            @endphp
                        </tr>
                    @endforeach
                    <tr id="new-ingredient-row" style="display: none;">
                        <td style="width: 5%;" class="text-xl pl-4">
                            {{ $lastIngredientId + 1 }}</td>
                        <td style="width: 40%;">
                            <input
                                class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                type="text" id="new-ingredient-name">
                        </td>
                        <td style="width: 30%;">
                            <input
                                class="text-left rounded-3xl border border-stone-300 bg-stone-100 hover:bg-white transition-all"
                                type="text" id="new-ingredient-quantity-unit">
                        </td>
                        <td class="flex flex-row">
                            <button
                                class="flex flex-wrap block m-2 mt-10 py-2 px-3 ml-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                onclick="onSaveNewIngredientButtonClicked()" id="saveNewIngredientButton">Save</button>
                            <button
                                class="block m-2 py-2 px-3 mt-auto rounded-md border border-transparent font-semibold bg-stone-500 text-white text-xl hover:bg-stone-600 transition-all"
                                onclick="onCancelNewIngredientButtonClicked()"
                                id="cancleNewIngredientButton">Cancel</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection

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
        // Show the new-ingredient-row
        const ingredientRow = document.getElementById("new-ingredient-row");
        ingredientRow.style.display = "table-row";

        // Scroll to the new-ingredient-row
        ingredientRow.scrollIntoView({
            behavior: "smooth",
            block: "end"
        });

        // Hide the "Add Ingredient" button
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
