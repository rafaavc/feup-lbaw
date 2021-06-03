@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Favourites</h3>
        @php($no_items = true)
        @foreach($favourites as $recipe)
            @if(Gate::inspect('select', $recipe)->allowed())
                @include('partials.preview.recipe')
                @php($no_items = false)
            @endif
        @endforeach
        @if($no_items)
            <p>This user does not have favourite recipes.</p>
        @endif
    </div>
    <!--<div class="row">
        <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
    </div>-->
@endsection
