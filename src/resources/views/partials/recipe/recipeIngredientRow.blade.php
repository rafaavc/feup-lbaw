<div class="row g-3 mb-3">
    <div class="col-lg">
        <div class="row g-3">
            <div class="col-sm">
                <div class="form-floating">
                    <input type="number" class="form-control" placeholder="0" aria-label="Quantity" id="quantityInput" value="{{ isset($ingredient->pivot->quantity) ? $ingredient->pivot->quantity : "" }}">
                    <label for="quantityInput">Quantity <span class='form-required'></span></label>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-floating">
                    <select class="form-select" id="quantityUnitSelect" aria-label="Quantity unit">
                        <option {{ !isset($ingredient->pivot->id_unit) ? "selected" : "" }}>-</option>
                        <option value="1" {{ isset($ingredient->pivot->id_unit) && $ingredient->pivot->id_unit == 1 ? "selected" : "" }}>teaspoon(s)</option>
                        <option value="2" {{ isset($ingredient->pivot->id_unit) && $ingredient->pivot->id_unit == 2 ? "selected" : "" }}>cup(s)</option>
                        <option value="3" {{ isset($ingredient->pivot->id_unit) && $ingredient->pivot->id_unit == 3 ? "selected" : "" }}>ounce(s)</option>
                        <option value="4" {{ isset($ingredient->pivot->id_unit) && $ingredient->pivot->id_unit == 4 ? "selected" : "" }}>gram(s)</option>
                        <option value="5" {{ isset($ingredient->pivot->id_unit) && $ingredient->pivot->id_unit == 5 ? "selected" : "" }}>kilo(s)</option>
                    </select>
                    <label for="quantityUnitSelect">Unit</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Tomato" value="{{ isset($ingredient->name) ? $ingredient->name : "" }}">
            <label for="floatingInput">Name <span class='form-required'></span></label>
        </div>
    </div>
</div>
