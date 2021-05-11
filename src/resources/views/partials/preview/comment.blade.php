@push('css')
    <link href="{{ asset('css/components/post.css') }}" rel="stylesheet"/>
@endpush

<div class="card shadow-sm recipe-post mt-5">
    <div class="col-sm post-options">
        <div class="dropdown">
            <button type="button" class="btn edit-photo-button float-end me-2 mt-2 btn-no-shadow"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                @if(Gate::inspect('update', $comment)->allowed())
                    <li><a class="dropdown-item" href="#">Edit Review</a></li>
                @endif
                @if(Gate::inspect('delete', $comment)->allowed())
                    <li><a class="dropdown-item" href="#">Delete Review</a></li>
                @else
                    <li><a class="dropdown-item" href="#">Report Review</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="card-body">
        <div class="row user-info">
            <div class="col avatar-image mb-2">
                <img class="rounded-circle z-depth-2"
                     src="{{$comment->owner->profileImage()}}">
            </div>
            <div class="col col-sm name-and-date ms-4">
                <div>
                    <a href="{{url('user/' . $comment->owner->username)}}"
                       style="text-decoration: none">
                        <strong>{{$comment->owner->name}}</strong>
                    </a>
                    <span class="review-text">wrote a review</span>
                </div>
                <div class="publication-date">{{$comment->post_time}}</div>
            </div>
        </div>
        <div class="mt-4">
            @if($comment->rating !== null)
                <div><strong>Rating:</strong>
                    @include('partials.stars', ["rating" => $comment->rating])
                </div>
            @endif
            <p>{{$comment->text}}</p>
        </div>
        <a type="button" href="{{url('recipe/' . $comment->recipe->id)}}"
           class="btn card mb-2 mt-4 shadow-sm p-2 recipe-post-review">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('storage/images/recipes/' . $comment->recipe->id . '/1.jpg')}}"
                         class="bd-placeholder-img recipe-image" width="100%">
                </div>
                <div class="col-md-8 p-3">
                    <h4 class="m-0 p-0 card-title">{{$comment->recipe->name}}</h4>
                    <p class="m-0 p-0"><small class="text-muted">
                            {{$comment->recipe->score}}
                            @include('partials.stars', ["rating" => $comment->recipe->score])
                            | {{$comment->recipe->reviews()->count()}} reviews</small>
                    </p>
                </div>
            </div>
        </a>
    </div>
    <div class="btn-group col-sm d-flex justify-content-center text-center">
        <a type="button" href="{{url('recipe/' . $comment->recipe->id)}}" class="btn post-button">
            <i class="fas fa-eye me-2"></i>
            <span class="button-caption">View Recipe</span>
        </a>
        <button type="button" class="btn post-button">
            <i class="fas fa-share-alt me-2"></i>
            <span class="button-caption">Share</span>
        </button>
    </div>
</div>
