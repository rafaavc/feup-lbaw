@push('css')
    <link href="{{ asset('css/components/profile_cover.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/profile.js') }}" type="module"></script>
@endpush

<header class="cover">
    <img
        src="https://images-prod.healthline.com/hlcmsresource/images/AN_images/vegetarian-diet-plan-1296x728-feature.jpg"
        class="cover-image" alt="...">
    <div class="card shadow-sm px-3">
        <div class="row g-0 p-3 text-center text-md-start" style="">
            <div class="col-md-2 image-container ">
                <img class="rounded-circle mx-auto"
                     src="{{ $user->profileImage() }}"
                     alt=" Profile image of {{$user->name}}" style="border: 0">
            </div>
            <div class="col-md-6 ms-md-4 card-body m-0">
                <h1 class="card-title">{{$user->name}}</h1>
                <p class="card-text">{{$user->biography}}</p>
                <table class="table table-borderless lh-1">
                    <tr>
                        <td>Recipes</td>
                        <td>Followers</td>
                        <td>Following</td>
                    </tr>
                    <tr>
                        <td>{{$user->number_of_recipes}}</td>
                        <td>{{$user->number_of_followers}}</td>
                        <td>{{$user->number_of_following}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3 card-body text-md-end m-0">
                <div class="btn-group" role="group" aria-label="">
                    @if($followState != 'External')
                        @if ($canEdit)
                            <a href="{{url("/user/$user->username/edit")}}" class="btn btn-no-shadow btn-outline-dark"><i
                                    class="fas fa-edit"></i>Edit</a>
                        @else
                            <button type="button" class="btn shadow-none btn-outline-dark user-follow">
                                <i class="fas fa-user-times {{ ($followState != 'accepted') ? 'd-none' : '' }}"></i>
                                <i class="fas fa-user-plus {{ ($followState == 'rejected' || $followState == 'Follow' || $followState == null) ? '' : 'd-none' }}"></i>
                                @if ($followState == 'pending')
                                    {{ "Pending Request" }}
                                @elseif ($followState == 'accepted')
                                    {{-- <i class="fas fa-user-times"></i> --}}
                                    {{ "Unfollow" }}
                                @else {{-- Rejected or no record found --}}
                                    {{-- <i class="fas fa-user-plus"></i> --}}
                                    {{ "Follow" }}
                                @endif
                            </button>
                            <a href="{{url("/chat/$user->username")}}" type="button" class="btn btn-outline-dark"><i
                                    class="fas fa-comments"></i>Chat</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="row" style="position: relative; bottom: -1px">
            <div class="rating-box col-md-3 order-md-2 text-center mb-3 mb-md-0">
                <span class="small d-block">Average rating</span>
                <div class="rating">
                    <span class="value me-1">{{$user->score}}</span>
                    @include('partials.stars', ['rating' => $user->score])
                </div>
            </div>
            <ul class="nav nav-tabs col-md-9 ps-md-3">
                <li class="nav-item">
                    <a class="nav-link {{$tab === "recipes" ? "active" : ""}}" aria-current="page"
                       href="{{url("/user/$user->username/recipes")}}">Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$tab === "reviews" ? "active" : ""}}"
                       href="{{url("/user/$user->username/reviews")}}">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$tab === "favourites" ? "active" : ""}}"
                       href="{{url("/user/$user->username/favourites")}}">Favourites</a>
                </li>
            </ul>
        </div>
    </div>
</header>
