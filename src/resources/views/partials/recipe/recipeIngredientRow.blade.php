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
                        @foreach ($units as $unit)
                            @if($ingredient->pivot->id_unit === $unit->id)
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
            <select class="form-select" id="ingredientSelect" aria-label="Quantity unit">
                <option value="3">Tags</option>
            </select>

            {{-- <input type="text" class="form-control" id="floatingInput" placeholder="Tomato" value="{{ isset($ingredient->name) ? $ingredient->name : "" }}"> --}}
            <label for="floatingInput">Name <span class='form-required'></span></label>
        </div>
    </div>
    <div class="search-div collapse navbar-collapse justify-content-center flex-grow-1 normalize mt-0" id="navbarSearch" data-bs-parent="#navbarContainer">
        <div class="d-flex">
            <input type="text" class="searchBox-text form-control rounded-0" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>
        <div class="searchBox-ingredient">
            <a class="list-group-item list-group-item-action ingredient">About</a>
            <a class="list-group-item list-group-item-action ingredient">Base</a>
            <a class="list-group-item list-group-item-action ingredient">Blog</a>
            <a class="list-group-item list-group-item-action ingredient">Contact</a>
            <a class="list-group-item list-group-item-action ingredient">Custom</a>
            <a class="list-group-item list-group-item-action ingredient">Support</a>
            <a class="list-group-item list-group-item-action ingredient">Tools</a>
        </div>
    </div>
</div>
