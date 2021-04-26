<section class="icon-box mt-5 shadow-sm" id="comments">
    <i class="fas fa-comments"></i>
    @foreach ($comments as $i => $comment)
        @include('partials.recipe.comment', [ 'comment' => $comment, 'depth' => 0 ])
    @endforeach
    <div class="form-floating m-3 position-relative">
        <textarea class="form-control" placeholder="Leave a comment here" id="commentTextarea" style="height: 6rem"></textarea>
        <label for="floatingTextarea2">Your comment</label>
        <button type="button" class="btn btn-primary position-absolute py-1 send" onclick="result()">
            <small><i class="fas fa-paper-plane me-2"></i>
                Comment</small>
        </button>
        @include('partials.rating')
    </div>
</section>
