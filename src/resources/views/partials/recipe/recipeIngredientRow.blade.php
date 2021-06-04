<div class="row g-3 mb-3">
    <div class="col-lg">
        <div class="row g-3">
            <div class="col-sm">
                <div class="form-floating" data-toggle="tooltip" data-placement="top" title="Ingredient quantity">
                    @if($hasErrors)
                        <input name="ingredients[{{ $index }}][quantity]" type="number" class="form-control" placeholder="0" aria-label="Quantity" id="quantityInput" step="0.1"
                        value="{{ $ingredient['quantity'] }}">
                    @else
                        <input name="ingredients[{{ $index }}][quantity]" type="number" class="form-control" placeholder="0" aria-label="Quantity" id="quantityInput" step="0.1"
                            value="{{ (isset($ingredient->pivot->quantity)) ? $ingredient->pivot->quantity : "" }}">
                    @endif
                    <label for="quantityInput">Quantity <span class='form-required'></span></label>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-floating" data-toggle="tooltip" data-placement="top" title="Choose the unit of measure of the ingredient">
                    <select name="ingredients[{{ $index }}][id_unit]" class="form-select" id="quantityUnitSelect" aria-label="Quantity unit">
                        @foreach ($units as $unit)
                            @if((!$hasErrors && isset($ingredient) && $ingredient->pivot->id_unit === $unit->id) || ($hasErrors && $ingredient['id_unit'] == $unit->id))
                                <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                            @else
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="quantityUnitSelect">Unit</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="form-floating" data-toggle="tooltip" data-placement="top" title="Choose an ingredient from our database">
            <select name="ingredients[{{ $index }}][id]" class="form-select ingredientSelect" aria-label="Quantity unit" required>
                @if($hasErrors && \App\Models\Ingredient::where('id', $ingredient['id'])->exists())
                    <option value="{{ $ingredient['id'] }}">{{ \App\Models\Ingredient::find($ingredient['id'])->name }}</option>
                @else
                    <option value="{{ (isset($ingredient) && !$hasErrors) ? $ingredient->id : ""}}">{{ (isset($ingredient) && !$hasErrors) ? $ingredient->name : "" }}</option>
                @endif
            </select>

            {{-- <input type="text" class="form-control" id="floatingInput" placeholder="Tomato" value="{{ isset($ingredient->name) ? $ingredient->name : "" }}"> --}}
            <label for="floatingInput">Ingredient Name<span class='form-required'></span></label>
        </div>
    </div>
    <div class="search-div collapse navbar-collapse justify-content-center flex-grow-1 normalize mt-0" id="navbarSearch" data-bs-parent="#navbarContainer">
        <div class="d-flex">
            <input type="text" class="searchBox-text form-control rounded-0" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>
        <div class="searchBox-ingredient">
            @foreach ($totalIngredients as $tIngredient)
                <a class="list-group-item list-group-item-action ingredient" data-value="{{ $tIngredient->id }}">{{ $tIngredient->name }}</a>
            @endforeach
        </div>
    </div>
</div>
