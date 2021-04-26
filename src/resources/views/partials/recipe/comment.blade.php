<div class="card comment <?= $depth !== 0 ? "subcomment" : "" ?>">
    <div class="row g-0 p-3">
        <div class="col">
            <img class="d-inline-block rounded-circle" src="../images/people/{{ $comment["user"] }}.jpg" alt="...">
        </div>
        <div class="col-5 card-body">
            <h6 class="card-title"><a href="{{ url('/member/jamieoliver/recipes') }}">{{ $comment["user"] }}</a> {{ key_exists("rate", $comment) ? "reviewed" : "commented" }}:</h6>
            @if (key_exists("rate", $comment))
                <div class="rating mb-3">
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            @endif
            <p class="card-text mt-3">{{ $comment["comment"] }}</p>
            <p class="card-text mt-3">
                <small class="text-muted">
                    {{ key_exists("edit", $comment) ? "Edited " . $comment["edit"] : $comment["post"] }}
                </small>
            </p>
        </div>
        <div class="col-md text-end position-relative">
            <button class="btn btn-sm btn-outline-secondary p-1 m-1"><i class="fas fa-reply me-1"></i>Reply</button>
        </div>
    </div>
    @if (key_exists("replies", $comment))
        @foreach($comment['replies'] as $idx => $reply)
            @include('partials.recipe.comment', [ 'comment' => $reply, 'depth' => $depth + 1 ])
        @endforeach
    @endif
</div>
