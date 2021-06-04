@extends('layouts.profile')

@section('title', $user->name)

@section('body')
    <div class="row first-recipe-mt">
        <h3>Reviews</h3>
        @php($no_items = true)
        @foreach($reviews as $comment)
            @if($comment->rating !== null && Gate::inspect('select', $comment->recipe)->allowed())
                <div>
                    @include('partials.preview.comment')
                </div>
                @php($no_items = false)
            @endif
        @endforeach
        @if($no_items)
            <p>This user has not made any reviews.</p>
        @endif
    </div>
@endsection
