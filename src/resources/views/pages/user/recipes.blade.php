@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Recipes</h3>
        @php($no_items = true)
        @foreach($recipes as $recipe)
            @if(Gate::inspect('select', $recipe)->allowed())
                <div>
                @include('partials.preview.recipe')
                </div>
                @php($no_items = false)
            @endif
        @endforeach
        @if($no_items)
            <p>This user did not post any recipes.</p>
        @endif
    </div>
@endsection
