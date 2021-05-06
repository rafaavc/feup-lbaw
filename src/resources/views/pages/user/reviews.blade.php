@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Reviews</h3>
        @if(sizeof($reviews) > 0)
            @foreach($reviews as $comment)
                @include('partials.preview.comment')
            @endforeach
        @else
            <p>This user has not made any reviews.</p>
        @endif
    </div>
    <!--<div class="row">
       <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
   </div>-->
@endsection
