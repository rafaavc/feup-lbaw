@extends('layouts.app')

@section('title', 'Feed')

@push('css')
    <link href="{{ asset('css/category.css') }}" rel="stylesheet"/>

@endpush

@push('js')
{{--     <script src="{{ asset('js/membersFollowingBoxes.js') }}" defer></script>
 --}}
@endpush

@section('content')
    <div class="margin-from-nav content-general-margin">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h1 class="mb-5">Feed</h1>

        <div class="row">
            <div class="col-xxl-9 px-0">
                <a href="{{ url('/recipe') }}" role="button" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Create Recipe</a>

                @if($recipes->count() > 0)
                    @foreach($recipes as $recipe)
                        @include('partials.preview.recipe')
                    @endforeach
                @else
                    <p>There is no recipes available.</p>
                @endif
                <div class="row">
                    <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto"><i class="fas fa-plus me-2"></i> Load More</button>
                </div>
            </div>

            <div class="col-xxl-3 ps-0 ps-xxl-4 pe-0 trending-topics-recipes">
                @include('partials.trending.trending_topics')
                @include('partials.trending.trending_recipes')
            </div>

        </div>


    </div>
@endsection
