@extends('layouts.app')

@section('title', 'Feed')

@push('css')
    <link href="{{ asset('css/components/membersFollowingBoxes.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/membersFollowingBoxes.js') }}" defer></script>
@endpush

@section('content')
    <main class="margin-from-nav content-general-margin">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div>
            <h1>Feed</h1>
            @if($recipes->count() > 0)
                @foreach($recipes as $recipe)
                    @include('partials.preview.recipe')
                @endforeach
            @else
                <p>There is no recipes available.</p>
            @endif
        </div>
    </main>
@endsection
