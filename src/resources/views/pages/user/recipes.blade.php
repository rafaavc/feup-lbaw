@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Recipes</h3>
        @php($no_items = true)
        @foreach($recipes as $recipe)
            @if(Gate::inspect('select', $recipe)->allowed())
                @include('partials.preview.recipe')
                @php($no_items = false)
            @endif
        @endforeach
        @if($no_items)
            <p>This user did not post any recipes.</p>
        @endif
    </div>
    <!--<div class="row">
       <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
   </div>-->
@endsection
