@extends('layouts.app')

@section('title', $recipe->name)

@push('css')
    <link href="{{ asset('css/recipe.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/search_results_cards.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/profile_cover.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/textareaWithButton.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/rating.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/recipeYields.js') }}" defer></script>
    <script src={{ asset('js/rating.js') }} defer></script>
@endpush

@section('content')

@include('partials.breadcrumb', ['pages' => ["Recipes", "Desserts", "Classic Tiramisu"], 'withoutMargin' => false])

<main class="row content-general-margin margin-to-footer">
    <article id="recipe" class="col-xl-8 p-0 pe-xl-4">
        <header class="row text-left pt-3 pb-3 mb-md-3 shadow-sm mt-5 mt-xl-0">
            <h1 class="col-11">{{ $recipe->name }}</h1>
            <div class="col-9">
                <div class="rating">
                    <span class="small me-2">
                        @if($recipe->score == 0)
                            No ratings
                        @else
                            {{ $recipe->score }} ({{ $recipe->num_rating }} ratings)
                        @endif
                    </span>
                    @php
                        $rounded = round($recipe->score);
                    @endphp
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star{{ $i < $rounded ? " active" : "" }}"></i>
                    @endfor
                </div>
                <div class="row g-0 py-2 text-center text-md-start">
                    <table>
                        <tbody>
                            <tr>
                                <td class="col-2 col-md-1 image-container">
                                    <img class="rounded-circle" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" alt="...">
                                </td>
                                <td class="align-middle">
                                    <div class="col-md-5 card-body p-0 m-0 ms-2 text-start">
                                        by <a href="{{ url('/member/'.$author->username.'/recipes') }}">{{ $author->name }}</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>{{ $recipe->description }}</p>


                <span class="d-block mb-3"><small>Difficulty: {{ $recipe->difficulty }}</small></span>
                <span class="d-inline-block me-3">Tags: </span>
                @foreach($tags as $idx => $tag)
                    <a role="button" class="btn btn-sm btn-secondary d-inline-block me-2 mb-2" href="/category/{{ $tag->id }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
            <ul class="col-3 text-end">
                <li class="list-group-item bg-light" style="border-radius: .5rem">
                    <a href="{{ url('/recipe/'.$recipe->id.'/edit') }}">
                        <span class="legend">Edit Recipe</span><i class="fas fa-edit ms-2"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <span class="legend">Print</span><i class="fas fa-print"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <span class="legend">Share</span><i class="fas fa-share-alt"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    {{-- TODO add permissions --}}
                    <a href="#">
                        <span class="legend">Edit</span><i class="fas fa-edit"></i>
                    </a>
                    <a href="#">
                        <span class="legend">Favourite</span><i class="fas fa-heart"></i>
                    </a>
                </li>
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
                @foreach($suggested as $idx => $recipe)
                    <div class="col">
                        @include('partials.recipe.card', $recipe)
                    </div>
                @endforeach
            </div>
        </div>
    </aside>
</main>

@endsection
