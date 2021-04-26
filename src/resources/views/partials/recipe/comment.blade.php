<div class="card comment <?= $depth !== 0 ? "subcomment" : "" ?>">
    <div class="row g-0 p-3">
        <div class="col">
            <img class="d-inline-block rounded-circle" src="{{ asset('images/people/1'. (true ? "" : "$comment->owner->id") .'.jpg') }}" alt="...">
        </div>
        <div class="col-5 card-body">
            <h6 class="card-title"><a href="{{ url('/member/'.$comment->owner->username.'/recipes') }}">{{ $comment->owner->name }}</a> {{ isset($comment->rating) ? "reviewed" : "commented" }}:</h6>
            @if (isset($comment->rating))
                <div class="rating mb-3">
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            @endif
            <p class="card-text mt-3">{{ $comment->text }}</p>
            <p class="card-text mt-3">
                <small class="text-muted">
                    {{ $comment->post_time }}
                </small>
            </p>
        </div>
        <div class="col-md text-end position-relative">
            <button class="btn btn-sm btn-outline-secondary p-1 m-1"><i class="fas fa-reply me-1"></i>Reply</button>
        </div>
    </div>
    @foreach($comment->replies as $idx => $reply)
        @include('partials.recipe.comment', [ 'comment' => $reply, 'depth' => $depth + 1 ])
    @endforeach
</div>
