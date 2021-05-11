@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Favourites</h3>
        @if($favourites->count() > 0)
            @foreach($favourites as $recipe)
                @include('partials.preview.recipe')
            @endforeach
        @else
            <p>This user does not have favourite recipes.</p>
        @endif
    </div>
    <!--<div class="row">
        <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
    </div>-->
@endsection
