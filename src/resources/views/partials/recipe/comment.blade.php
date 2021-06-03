<div data-comment-id="{{ $comment->id }}" data-depth="{{ $depth }}" data-has-review="{{ isset($comment->rating) ? "true" : "false" }}" class="card comment {{$depth !== 0 ? "subcomment" : "" }}">

    <div class="row g-0 p-3">
        <div class="col">
            <img class="d-inline-block rounded-circle" src="{{ $comment->owner->profileImage() }}">
        </div>
        <div class="col-5 card-body">
            <h6 class="card-title"><a href="{{ url('/user/'.$comment->owner->username) }}">{{ $comment->owner->name }}</a> {{ isset($comment->rating) ? "reviewed" : "commented" }}:</h6>
            @if (isset($comment->rating))
                <div class="rating mb-3">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star{{ $i < $comment->rating ? " active" : "" }}"></i>
                    @endfor
                </div>
            @endif
            <p class="card-text mt-3">{{ $comment->text }}</p>
            <p class="card-text mt-3">
                <small class="text-muted">
                    {{ $comment->post_time }}
                </small>
            </p>
        </div>
        <div class="col">
        @if(Gate::inspect('create', $comment)->allowed())
            <div class="col-md text-end position-relative">
                <button role="a" class="btn btn-sm btn-outline-secondary p-1 m-1 recipe-comment-reply-button"><i class="fas fa-reply me-1"></i>Reply</button>
            </div>
        @endif
        @if(Gate::inspect('update', $comment)->allowed())
            <div class="col-md text-end position-relative">
                <button role="a" class="btn btn-sm btn-outline-secondary p-1 m-1 recipe-comment-edit-button"><i class="fas fa-edit me-1"></i>Edit</button>
            </div>
        @endif
        @if(Gate::inspect('delete', $comment)->allowed())
            <div class="col-md text-end position-relative">
                <button role="a" class="btn btn-sm btn-outline-secondary p-1 m-1 recipe-comment-delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
            </div>
        @endif
        </div>
    </div>
    @foreach($comment->replies as $idx => $reply)
        @include('partials.recipe.comment', [ 'comment' => $reply, 'depth' => $depth + 1 ])
    @endforeach
</div>
