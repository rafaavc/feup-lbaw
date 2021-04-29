@extends('layouts.app')

@section('title', isset($recipe) ? "Edit Recipe" : "Create Recipe")

@push('css')
    <link href="{{ asset('css/createRecipe.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/progressBar.js') }}" defer></script>
    <script src="{{ asset('js/createRecipe.js') }}" defer></script>
@endpush

@section('content')

@php
    $breadcrumbPages = ["Recipes", isset($recipe) ? $recipe->category->name : "Create Recipe"];
    if (isset($recipe))
        array_push($breadcrumbPages, $recipe->name);
@endphp

@include('partials.breadcrumb', ['pages' => $breadcrumbPages, 'withoutMargin' => false])

<h1 id="pageTitle" class="content-general-margin mt-3">{{ isset($recipe) ? "Edit Recipe" : "Create Recipe" }}</h1>
<div id="create-recipe-stepper" class="content-general-margin mt-4 margin-to-footer card p-4">
    <div class="card-body">
        @include('partials.progressBar')
        <form class="recipe-form" method="POST" action="{{ url('/recipe/' . (isset($recipe) ? ($recipe->id . '/edit') : '')) }}">
            {{ csrf_field() }}
            <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <h3 class="mb-4">Recipe Information</h3>
                        <div class="row g-3 mb-3">
                            <div class="col-lg">
                                <div class="form-floating">
                                    <input name="name" type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="{{ isset($recipe) ? $recipe->name : ""}}">
                                    <label for="floatingInput">Recipe title <span class='form-required'></span></label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select name="category" class="form-select" id="floatingSelectGrid" aria-label="Main category">
                                        @foreach ($categories as $category)
                                            @if(isset($recipe) && $recipe->category->id === $category->id)
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
                            <textarea name="description" class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 7rem">{{ isset($recipe) ? $recipe->description : "" }}</textarea>
                            <label for="floatingTextarea2"> Description <span class='form-required'></span></label>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-sm">
                                <div class="form-floating">
                                    <select name="difficulty" class="form-select" id="floatingSelectGrid" aria-label="Difficulty">
                                        <option name="difficulty" value="easy" {{ (isset($recipe) && $recipe->difficulty === "easy") ? "selected" : "" }}>Easy</option>
                                        <option name="difficulty" value="medium" {{ (isset($recipe) && $recipe->difficulty === "medium") ? "selected" : "" }}>Medium</option>
                                        <option name="difficulty" value="hard" {{ (isset($recipe) && $recipe->difficulty === "hard") ? "selected" : "" }}>Hard</option>
                                        <option name="difficulty" value="very hard" {{ (isset($recipe) && $recipe->difficulty === "very hard") ? "selected" : "" }}>Very Hard</option>
                                    </select>
                                    <label for="floatingSelectGrid">Difficulty <span class='form-required'></span></label>
                                </div>
                            </div>

                            <div class="col-lg">
                                <div class="form-floating">
                                    <input name="servings" type="number" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="{{isset($recipe) ? $recipe->servings : 0 }}">
                                    <label for="floatingInput">Number of servings <span class='form-required'></span></label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-floating">
                                    <select class="form-select" id="tagSelect" aria-label="Quantity unit">
                                        <option value="3">Tags</option>
                                    </select>

                                    <label for="floatingInput">Tags<span class='form-required'></span></label>
                                </div>
                            </div>
                            <div class="search-div collapse navbar-collapse justify-content-center flex-grow-1 normalize mt-0" id="navbarSearch" data-bs-parent="#navbarContainer">
                                <div class="d-flex">
                                    <input type="text" class="searchBox-text form-control rounded-0" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                                <div class="searchBox-tag">
                                    @foreach ($totalTags as $tTag)
                                        <a class="list-group-item list-group-item-action tag" value="{{ $tTag->id }}">{{ $tTag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg tags-collection mb-3">
                            <ul class="tag-list mt-2 mb-4">
                                @if (isset($recipe))
                                    @foreach ($recipe->tags as $tag)
                                        <li value="{{ $tag->id }}">{{ $tag->name }}<span class="close">&times;</span></li>
                                        <input name="tags[]" value="{{ $tag->id }}" class="d-none">
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <h6 class="mb-3 d-inline-block">End Product Photos</h6> <span class='form-required'></span>
                        <input name="images" type="file" class="form-control mb-3">

                        <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h3 class="mb-4">Ingredients</h3>

                        @if(isset($recipe))
                            @foreach ($ingredients as $ingredient)
                                @include('partials.recipe.recipeIngredientRow', ['ingredient' => $ingredient, 'units' => $units, 'totalIngredients' => $totalIngredients, 'index' => $loop->index])
                            @endforeach
                        @else
                            @include('partials.recipe.recipeIngredientRow', ['units' => $units, 'totalIngredients' => $totalIngredients])
                        @endif

                        <button type="button" class="btn btn-secondary" id="addIngredientButton"><i class="fas fa-plus"></i> Add Ingredient</button>
                        <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
                    </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="mb-4">Method</h3>

                <span class="d-block mb-3"><h5 class="d-inline">Duration</h6> <small>(in minutes)</small></span>
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="form-floating">
                            <input name="preparation_time" type="number" class="form-control" id="preparationTime" placeholder="Preparation Time" value="{{ isset($recipe) ? $recipe->preparation_time : 0}}">
                            <label for="preparationTime">Preparation <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input name="cooking_time" type="number" class="form-control" id="cookingTime" placeholder="Cooking Time" value="{{ isset($recipe) ?  $recipe->cooking_time : 0 }}">
                            <label for="cookingTime">Cooking <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input name="additional_time" type="number" class="form-control" id="additionalTime" placeholder="Additional Time" value="{{ isset($recipe) ? $recipe->additional_time : 0 }}">
                            <label for="additionalTime">Additional</label>
                        </div>
                    </div>
                </div>

                <h4 class="mt-5 mb-4">Steps</h4>

                @if(isset($recipe))
                    @foreach ($steps as $step)
                        @include('partials.recipe.step', ['step' => $step, 'index' => $loop->index + 1])
                    @endforeach
                @else
                    @include('partials.recipe.step', ['index' => 1])
                @endif

                <button type="button" class="btn btn-secondary" id="addStepButton"><i class="fas fa-plus"></i> Add Step</button>
                <a type="submit" role="button" class="submit-recipe-form btn btn-primary next-step" style="float: right;">{{ isset($recipe) ? "Edit Recipe" : "Create Recipe" }}</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
