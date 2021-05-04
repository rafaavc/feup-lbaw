@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Recipes</h3>
        @foreach($recipes as $recipe)
            @include('partials.preview.recipe')
        @endforeach
    </div>
    <!--<div class="row">
       <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
   </div>-->
@endsection
