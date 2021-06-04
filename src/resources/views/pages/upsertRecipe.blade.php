@extends('layouts.app')

@section('title', isset($recipe) ? "Edit Recipe" : "Create Recipe")

@push('css')
    <link href="{{ asset('css/createRecipe.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/progressBar.js') }}" defer></script>
    <script src="{{ asset('js/createRecipe.js') }}" type="module"></script>
@endpush

@section('content')

@php
    $hasErrors = $errors->any();
    $old = ($hasErrors) ? \Illuminate\Support\Facades\Request::old() : '';

    if (isset($recipe))
        $breadcrumbPages = ["Recipes" => "/recipe/" . $recipe->id, $recipe->category->name => "/category/" . $recipe->category->id, $recipe->name => "/recipe/" . $recipe->id, "Edit Recipe" => ""];
    else
        $breadcrumbPages = ["Recipes" => "", "Create Recipe" => ""];
@endphp

@include('partials.breadcrumb', ['pages' => $breadcrumbPages, 'withoutMargin' => false])

<h1 id="pageTitle" class="content-general-margin mt-3">{{ isset($recipe) ? "Edit Recipe" : "Create Recipe" }}</h1>
<div id="create-recipe-stepper" class="content-general-margin mt-4 margin-to-footer card p-4">

    @if($hasErrors)
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif

    <div class="card-body">
        @include('partials.progressBar')
        <form class="recipe-form" enctype="multipart/form-data" method="POST" action="{{ url('/recipe/' . (isset($recipe) ? ($recipe->id . '/edit') : '')) }}">
            {{ csrf_field() }}
            <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <h3 class="mb-4">Recipe Information</h3>
                        <div class="row g-3 mb-3">
                            <div class="col-lg">
                                <div class="form-floating" title="Give your recipe a nice name">
                                    <input name="name" type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes"
                                        value="{{ (!$hasErrors) ? ((isset($recipe)) ? $recipe->name : "") : ((isset($old['name'])) ? old('name') : '') }}">
                                    <label for="floatingInputName">Recipe title <span class='form-required'></span></label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating" title="Choose the category of your recipe">
                                    <select name="category" class="form-select" id="floatingSelectGrid" aria-label="Main category">
                                        @foreach (\App\Models\Category::all() as $category)
                                            @if((!$hasErrors && isset($recipe) && $recipe->category->id == $category->id) ||
                                                ($hasErrors && isset($old['category']) && old('category') == $category->id))
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGridCategory">Main category <span class='form-required'></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3" title="Give a nice description to your recipe, so that people can have a better understanding of it">
                            <textarea name="description" class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 7rem">{{ (!$hasErrors) ? ((isset($recipe)) ? $recipe->description : "") : ((isset($old['description'])) ? old('description') : '') }}</textarea>
                            <label for="floatingTextarea2"> Description <span class='form-required'></span></label>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-sm">
                                <div class="form-floating" title="How difficult to prepare is your recipe?">
                                    <select name="difficulty" class="form-select" id="floatingSelectGrid" aria-label="Difficulty">
                                        <option name="difficulty" value="easy" {{ ((isset($recipe) && $recipe->difficulty === "easy") || ( $hasErrors && isset($old['difficulty']) && old('difficulty') === "easy")) ? "selected" : "" }}>Easy</option>
                                        <option name="difficulty" value="medium" {{ ((isset($recipe) && $recipe->difficulty === "medium") || ($hasErrors && isset($old['difficulty']) && old('difficulty') === "medium")) ? "selected" : "" }}>Medium</option>
                                        <option name="difficulty" value="hard" {{ ((isset($recipe) && $recipe->difficulty === "hard") || ($hasErrors && isset($old['difficulty']) && old('difficulty') === "hard")) ? "selected" : "" }}>Hard</option>
                                        <option name="difficulty" value="very hard" {{ ((isset($recipe) && $recipe->difficulty === "very hard") || ($hasErrors && isset($old['difficulty']) && old('difficulty') === "very hard")) ? "selected" : "" }}>Very Hard</option>
                                    </select>
                                    <label for="floatingSelectGridDifficulty">Difficulty <span class='form-required'></span></label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-floating" title="How many servings does your recipe have? It needs to be at least 1">
                                    <input name="servings" type="number" class="form-control" id="floatingInputServings" placeholder="Baked Potatoes" value="{{ (!$hasErrors) ? ((isset($recipe)) ? $recipe->servings : 0) : ((isset($old['servings'])) ? old('servings') : '') }}">
                                    <label for="floatingInputServings">Number of servings <span class='form-required'></span></label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-floating" title="Enter some subcategories so that people can find your recipe easily">
                                    <select class="form-select" id="tagSelect" aria-label="Quantity unit">
                                        <option></option>
                                    </select>
                                    <label>Tags<span class='form-required'></span></label>
                                </div>
                            </div>
                            <div class="search-div collapse navbar-collapse justify-content-center flex-grow-1 normalize mt-0" id="navbarSearch" data-bs-parent="#navbarContainer">
                                <div class="d-flex">
                                    <input type="text" class="searchBox-text form-control rounded-0" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                                <div class="searchBox-tag">
                                    @foreach (\App\Models\Tag::all() as $tTag)
                                        <a class="list-group-item list-group-item-action tag" data-value="{{ $tTag->id }}">{{ $tTag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg tags-collection mb-3">
                            <ul class="tag-list mt-2 mb-4">
                                @if($hasErrors && isset($old['tags']))
                                    @foreach (old('tags') as $tagId)
                                        @if(\App\Models\Tag::where('id', $tagId)->exists())
                                            <li value="{{ $tagId }}">{{ \App\Models\Tag::find($tagId)->name }}<span class="close">&times;</span></li>
                                            <input name="tags[]" value="{{ $tagId }}" class="d-none">
                                        @endif
                                    @endforeach
                                @elseif (isset($recipe) && !$errors->has('tags'))
                                    @foreach ($recipe->tags as $tag)
                                            <li value="{{ $tag->id }}">{{ $tag->name }}<span class="close">&times;</span></li>
                                            <input name="tags[]" value="{{ $tag->id }}" class="d-none">
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <h6 class="mb-3 d-inline-block">End Product Photos</h6> <span class='form-required'></span>
                        <div id="end-product-photos-input">
                            @if(isset($images))
                                @foreach($images as $img)
                                    <span data-url="{{ $img['url'] }}" data-name="{{ $img['name'] }}"></span>
                                @endforeach
                            @endif
                        </div>

                        <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h3 class="mb-4">Ingredients</h3>

                        @if($hasErrors && isset($old['ingredients']))
                            @foreach(old('ingredients') as $ingredient)
                                    @include('partials.recipe.recipeIngredientRow', ['ingredient' => $ingredient, 'units' => \App\Models\Unit::all(), 'totalIngredients' => \App\Models\Ingredient::all(), 'index' => $loop->index, 'hasErrors' => true])
                            @endforeach
                        @elseif(isset($recipe))
                            @foreach ($ingredients as $ingredient)
                                @include('partials.recipe.recipeIngredientRow', ['ingredient' => $ingredient, 'units' => \App\Models\Unit::all(), 'totalIngredients' => \App\Models\Ingredient::all(), 'index' => $loop->index, 'hasErrors' => false])
                            @endforeach
                        @else
                            @include('partials.recipe.recipeIngredientRow', ['units' => \App\Models\Unit::all(), 'totalIngredients' => \App\Models\Ingredient::all(), 'index' => 0, 'hasErrors' => false])
                        @endif

                        <button type="button" class="btn btn-secondary" id="addIngredientButton" title="Click here if you want to add another ingredient"><i class="fas fa-plus"></i> Add Ingredient</button>
                        <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
                    </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="mb-4">Method</h3>

                <span class="d-block mb-3"><h5 class="d-inline">Duration</h6> <small>(in minutes)</small></span>
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="form-floating" title="How many minutes does it take to prepare your recipe?">
                            <input name="preparation_time" type="number" class="form-control" id="preparationTime" placeholder="Preparation Time" value="{{ isset($recipe) ? $recipe->preparation_time : 0}}">
                            <label for="preparationTime">Preparation <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating" title="How many minutes does your recipe need to be in the oven?">
                            <input name="cooking_time" type="number" class="form-control" id="cookingTime" placeholder="Cooking Time" value="{{ isset($recipe) ?  $recipe->cooking_time : 0 }}">
                            <label for="cookingTime">Cooking <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating" title="How many minutes does it take to make the final adjustments in the recipe preparation?">
                            <input name="additional_time" type="number" class="form-control" id="additionalTime" placeholder="Additional Time" value="{{ isset($recipe) ? $recipe->additional_time : 0 }}">
                            <label for="additionalTime">Additional</label>
                        </div>
                    </div>
                </div>

                <h4 class="mt-5 mb-4">Steps</h4>

                @if(isset($recipe) && $recipe->group != null)
                    <input name="group" value="{{ $recipe->group }}" class="d-none">
                @else
                    <input name="group" value="{{ isset($groupId) ? $groupId : '' }}" class="d-none">
                @endif

                @if($hasErrors && isset($old['steps']))
                    @for($i = 0; $i < sizeof(old('steps')); $i++)
                        @include('partials.recipe.step', [ 'oldStep' => old('steps')[$i], 'step' => isset($steps) ? $steps[$i] : undefined, 'index' => $i + 1, 'hasErrors' => true ])
                    @endfor
                @elseif(isset($recipe))
                    @foreach ($steps as $step)
                        @include('partials.recipe.step', ['step' => $step, 'index' => $loop->index + 1, 'hasErrors' => false])
                    @endforeach
                @else
                    @include('partials.recipe.step', ['index' => 1, 'hasErrors' => false])
                @endif


                <button type="button" class="btn btn-secondary" id="addStepButton" title="Click here to add another step"><i class="fas fa-plus"></i> Add Step</button>
                <a type="submit" role="button" class="submit-recipe-form btn btn-primary next-step" style="float: right;">{{ isset($recipe) ? "Edit Recipe" : "Create Recipe" }}</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
