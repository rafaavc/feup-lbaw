@extends('layouts.app')

@section('title', 'Edit Recipe')

@push('css')
    <link href="{{ asset('css/createRecipe.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/progressBar.js') }}" defer></script>
    <script src="{{ asset('js/createRecipe.js') }}" defer></script>
@endpush

@section('content')

@include('partials.breadcrumb', ['pages' => ["Recipes", $recipe->category->name, $recipe->name], 'withoutMargin' => false])

<h1 id="pageTitle" class="content-general-margin mt-3">Edit Recipe</h1>
<div id="create-recipe-stepper" class="content-general-margin mt-4 margin-to-footer card p-4">
    <div class="card-body">
        @include('partials.progressBar')
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <h3 class="mb-4">Recipe Information</h3>
                <div class="row g-3 mb-3">
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="{{ $recipe->name }}">
                            <label for="floatingInput">Recipe title <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelectGrid" aria-label="Main category">
                                @foreach ($categories as $category)
                                    @if($recipe->category->id === $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">Main category <span class='form-required'></span></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 7rem">Classic Italian dessert made with ladyfingers and mascarpone cheese. It can be made in a trifle bowl or a springform pan.</textarea>
                    <label for="floatingTextarea2"> {{ $recipe->description }} <span class='form-required'></span></label>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-lg">
                        <div class="form-floating">
                            {{-- Get Tags --}}
                            <input type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="Low carb, Vegetarian">
                            <label for="floatingInput">Tags <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelectGrid" aria-label="Difficulty">
                                <option value="1" {{ ($recipe->difficulty === "Easy") ? "selected" : "" }}>Easy</option>
                                <option value="2" {{ ($recipe->difficulty === "Medium") ? "selected" : "" }}>Medium</option>
                                <option value="3" {{ ($recipe->difficulty === "Hard") ? "selected" : "" }}>Hard</option>
                            </select>
                            <label for="floatingSelectGrid">Difficulty <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="{{ $recipe->servings }}">
                            <label for="floatingInput">Number of servings <span class='form-required'></span></label>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 d-inline-block">End Product Photos</h6> <span class='form-required'></span>
                <input type="file" class="form-control mb-3">

                <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h3 class="mb-4">Ingredients</h3>

                @foreach ($ingredients as $ingredient)
                    @include('partials.recipe.recipeIngredientRow', ['ingredient' => $ingredient, 'units' => $units])
                @endforeach

                <button type="button" class="btn btn-secondary" id="addIngredientButton"><i class="fas fa-plus"></i> Add Ingredient</button>
                <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="mb-4">Method</h3>

                <span class="d-block mb-3"><h5 class="d-inline">Duration</h6> <small>(in minutes)</small></span>
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="preparationTime" placeholder="Preparation Time" value="{{ $recipe->preparation_time }}">
                            <label for="preparationTime">Preparation <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="cookingTime" placeholder="Cooking Time" value="{{ $recipe->cooking_time }}">
                            <label for="cookingTime">Cooking <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="additionalTime" placeholder="Additional Time" value="{{ $recipe->additional_time }}">
                            <label for="additionalTime">Additional</label>
                        </div>
                    </div>
                </div>

                <h4 class="mt-5 mb-4">Steps</h4>

                @foreach ($steps as $step)
                    @include('partials.recipe.step', ['step' => $step, 'index' => $loop->index + 1])
                @endforeach

                <button type="button" class="btn btn-secondary" id="addStepButton"><i class="fas fa-plus"></i> Add Step</button>
                <a role="button" href=" {{ url('/recipe/' . $recipe->id) }}" class="btn btn-primary next-step" style="float: right;">Edit Recipe</a>

            </div>
        </div>
    </div>
</div>

@endsection
