<div class="row g-3 mb-3">
    <div class="col-lg">
        <div class="row g-3">
            <div class="col-sm">
                <div class="form-floating">
                    <input name="ingredients[{{ $index }}][quantity]" type="number" class="form-control" placeholder="0" aria-label="Quantity" id="quantityInput" step="0.1" value="{{ isset($ingredient->pivot->quantity) ? $ingredient->pivot->quantity : "" }}">
                    <label for="quantityInput">Quantity <span class='form-required'></span></label>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-floating">
                    <select name="ingredients[{{ $index }}][unit]" class="form-select" id="quantityUnitSelect" aria-label="Quantity unit">
                        @foreach ($units as $unit)
                            @if(isset($ingredient) && $ingredient->pivot->id_unit === $unit->id)
                                <option value="{{ $ingredient->pivot->id_unit }}" selected>{{ $unit->name }}</option>
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
        <div class="form-floating">
            <select name="ingredients[{{ $index }}][id]" class="form-select" id="ingredientSelect" aria-label="Quantity unit">
                <option value="{{ isset($ingredient) ?$ingredient->id : 0}}">{{ isset($ingredient) ? $ingredient->name : "" }}</option>
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
                <a class="list-group-item list-group-item-action ingredient" value="{{ $tIngredient->id }}">{{ $tIngredient->name }}</a>
            @endforeach
        </div>
    </div>
</div>
