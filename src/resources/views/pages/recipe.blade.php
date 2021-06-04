@extends('layouts.app')

@section('title', $recipe->name)
@section('description', $recipe->description)

@push('css')
    <link href="{{ asset('css/recipe.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/search_results_cards.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/profile_cover.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/textareaWithButton.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/clipboard.js') }}" type="module"></script>
    <script src="{{ asset('js/progressBar.js') }}" defer></script>
    <script src="{{ asset('js/recipe.js') }}" type="module"></script>
@endpush

@section('content')

    @include('partials.breadcrumb', ['pages' => ["Recipes" => "", $recipe->category->name => "/category/" . $category->id, $recipe->name => ""], 'withoutMargin' => false])

    <main class="row content-general-margin margin-to-footer">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <article id="recipe" class="col-xl-8 p-0 pe-xl-4">
            <header class="row text-left pt-3 pb-3 mb-md-3 shadow-sm mt-5 mt-xl-0">
                <h1 class="col-11">{{ $recipe->name }}</h1>
                <div class="col-9">
                    <div class="rating">
                        @include('partials.rating', [ 'score' => $recipe->score, 'num_rating' => $recipe->num_rating ])
                    </div>
                    <div class="row g-0 py-2 text-center text-md-start">
                        <table>
                            <tbody>
                            <tr>
                                <td class="col-2 col-md-1 image-container" id="author-image">
                                    <img class="rounded-circle"
                                         src="{{ $author->profileImage() }}">
                                </td>
                                <td class="align-middle">
                                    <div class="card-body p-0 m-0 ms-2 text-start">
                                        by <a
                                            href="{{ url('/user/'.$author->username) }}">{{ $author->name }}</a>
                                        <br>
                                        <small>
                                        @include('partials.date', ['date' => $recipe->creation_time])
                                        </small>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <p>{{ $recipe->description }}</p>


                    <span class="d-block mb-3"><small>Difficulty: {{ $recipe->difficulty }}</small></span>
                    <span class="d-inline-block me-3">Tags: </span>

                    <a role="button" class="btn btn-sm btn-primary d-inline-block me-2 mb-2"
                       href="/search?searchQuery={{ $category->name }}">
                        {{ $category->name }}
                    </a>
                    @foreach($tags as $idx => $tag)
                        <a role="button" class="btn btn-sm btn-secondary d-inline-block me-2 mb-2"
                           href="/search?searchQuery={{ $tag->name }}">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
                <ul class="col-3 text-end">
                    @if(Gate::inspect('update', $recipe)->allowed())
                        <li class="list-group-item bg-light" style="border-radius: .5rem">
                            <a href="{{ url('/recipe/'.$recipe->id.'/edit') }}">
                                <span class="legend">Edit Recipe</span><i class="fas fa-edit ms-2"></i>
                            </a>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <a href="#" onclick="window.print();return false;" class="has-tooltip" title="Generate a PDF of the recipe page or print it direcly if you have a printer">
                            <span class="legend">Print</span><i class="fas fa-print"></i>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="copy-link-button has-tooltip" href="javascript:void(null)" title="Copy the link of this recipe">
                            <span class="legend">Share</span><i class="fas fa-share-alt"></i>
                        </a>
                    </li>
                    @if(Auth::check())
                        <li class="list-group-item">
                            <button data-role="a" class="add-to-favourites-recipe-button has-tooltip"
                                    data-favourite-state="{{ $isFavourited ? "true" : "false" }}"
                                    data-recipe-id="{{ $recipe->id }}"
                                    title="Add this recipe to your favourites">
                                <span class="legend">Favourite</span><i class="fas fa-heart"></i>
                                </a>
                        </li>
                    @endif
                    @if(Gate::inspect('delete', $recipe)->allowed())
                        <li class="list-group-item">
                            <form id="deleteRecipeForm" method="POST"
                                  action="{{ url("/recipe/".$recipe->id."/delete") }}">
                                {{ csrf_field() }}
                            </form>
                            <button data-role="a" data-bs-toggle="modal" data-bs-target="#recipeDeleteConfirmationModal">
                                <span class="legend">Delete</span><i class="fas fa-trash"></i>
                            </button>
                        </li>
                    @endif
                </ul>
            </header>
            @include('partials.recipe.boxes', ['mobile' => true])
            @include('partials.recipe.ingredients', ['ingredients' => $ingredients])
            @include('partials.recipe.method', ['steps' => $steps])
            @include('partials.recipe.comments', ['comments' => $comments])
        </article>
        <aside class="col-xl-4 p-0 ps-xl-4 mt-5 mt-xl-0">
            <div class="d-none d-xl-block">
                @include('partials.recipe.boxes', ['mobile' => false])
            </div>
            <div class="suggested mt-5">
                <h4 class="text-center">Suggested</h4>
                <div class="row">
                    @foreach($suggested as $idx => $r)
                        <div class="col">
                            @include('partials.recipe.card', $r)
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </main>
    @include('partials.confirmation', [
        'modalId' => 'recipeDeleteConfirmationModal',
        'modalTitle' => 'Delete recipe "'.$recipe->name.'"',
        'modalMessage' => 'Do you really want to delete this recipe? This action is irreversible!',
        'modalYesFunction' => 'document.querySelector("#deleteRecipeForm").submit()',
        'modalYesText' => 'Yes',
        'modalNoText' => 'No'
    ])

@endsection
