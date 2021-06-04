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
                @if(Gate::inspect('update', $recipe)->allowed())
                    <li><a class="dropdown-item" href="#">Edit Post</a></li>
                @endif
                @if(Gate::inspect('delete', $recipe)->allowed())
                    <li><a class="dropdown-item" href="#">Delete Post</a></li>
                @else
                    <li><a class="dropdown-item" href="#">Report Post</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="card-body">

        <div class="row user-info">
            <div class="col avatar-image">
                <img class="rounded-circle z-depth-2"
                     src="{{$recipe->author->profileImage()}}">
            </div>
            <div class="col name-and-date ms-4">
                <div>
                    <a href="{{url('user/' . $recipe->author->username)}}" style="text-decoration: none">
                        <strong>{{$recipe->author->name}}</strong>
                    </a>
                </div>
                <div class="publication-date">@include('partials.date', ['date' => $recipe->creation_time])</div>
            </div>
        </div>

        <a type="button" href="{{url("recipe/$recipe->id")}}" class="btn card p-2 shadow-sm recipe-preview mt-4">
            <div class="row px-3">
                <div class="col-md post-image"
                     style="background-image: url('{{ $recipe->getProfileImage() }}')">
                </div>
                <div class="col-md w-50 text-recipe pt-4 pt-md-2 px-0 ps-md-4">
                    <div class="text-recipe">
                        <h4 class="card-title">{{$recipe->name}}</h4>
                        <p class="card-text post-description">{{$recipe->description}}</p>
                        <p>
                            <small class="text-muted">{{$recipe->score}}
                                @include('partials.stars', ['rating' => $recipe->score])
                                | {{$recipe->reviews()->count()}} reviews
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </a>

        <div class="container mt-4 p-0 ">
            <a role="button"
               class="btn btn-sm btn-secondary d-inline-block me-3 mb-2"
               href='{{url("category/" . $recipe->category->id)}}'>
                {{$recipe->category->name}}
            </a>
            @foreach ($recipe->tags as $tag)
                <a role="button"
                   class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2"
                   href="{{url("search/tag=" . $tag->id)}}">
                    {{$tag->name}}
                </a>
            @endforeach
        </div>
    </div>
    <div class="btn-group col-sm d-flex justify-content-center text-center">
        @if(Auth::user() != null)
            <button type="button" class="btn post-button add-to-favourites-recipe-button"
            data-favourite-state="{{ $recipe->isFavourited() ? "true" : "false" }}"
            data-recipe-id="{{ $recipe->id }}" data-complete-text="1">
                <i class="fas fa-heart me-2"></i>
                <span class="button-caption">{{ $recipe->isFavourited() ? "Remove from Favourites" : "Add to Favourites" }}</span>
            </button>
        @endif
        <a type="button" href="{{url("recipe/$recipe->id")}}" class="btn post-button">
            <i class="fas fa-eye me-2"></i>
            <span class="button-caption">View Recipe</span>
        </a>
        <button type="button" class="btn post-button">
            <i class="fas fa-share-alt me-2"></i>
            <span class="button-caption">Share</span>
        </button>
    </div>
</div>
