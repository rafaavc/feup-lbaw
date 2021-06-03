@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Reviews</h3>
        @php($no_items = true)
        @foreach($reviews as $comment)
            @if(Gate::inspect('select', $comment->recipe()->get())->allowed())
                @include('partials.preview.comment')
                @php($no_items = false)
            @endif
        @endforeach
        @if($no_items)
            <p>This user has not made any reviews.</p>
        @endif
    </div>
    <!--<div class="row">
       <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
   </div>-->
@endsection
