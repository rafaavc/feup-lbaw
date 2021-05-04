@extends('layouts.app')

@section('title', $user->name)

@push('css')
    <link href="{{ asset('css/navPopups.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/profile_cover.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/post.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/membersFollowingBoxes.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/breadcrumb.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/group.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/membersFollowingBoxes.js') }}" defer></script>
    <script src="{{ asset('js/navPopups.js') }}" defer></script>
    <script src="{{ asset('js/addToFavourites.js') }}" defer></script>
@endpush

@section('content')
    <main class="content-general-padding margin-to-footer">
        @include('partials.breadcrumb', ['pages' => ["Users", $user->name], 'withoutMargin' => true])
        <div>
            <div class="cover">
                @include('partials.profile.cover')
            </div>
            <div class="row group-body">
                <div class="col-md-4 p-0 pe-md-4 mt-5">
                    <div class="card m-0 mb-4 shadow-sm text-center p-3 personal-info">
                        <h4>Personal Info</h4>
                        <div class="text-start m-auto d-inline">
                            <span><i class="fas fa-map-marker-alt"></i>Ruílhe, Portugal</span>
                            <br>
                            <span><i class="fas fa-birthday-cake"></i>Joined in Jul 2020</span>
                        </div>
                        <a class="btn btn-primary mt-2" href="{{url('/recipe')}}">Create
                            Recipe</a>
                        <a class="btn btn-primary mt-2" href="{{url('/group')}}">Create
                            Group</a>
                    </div>
                    @include('partials.profile.peopleBox')
                    <div class="card shadow-sm people-box mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Groups</h5>
                            <div class="g-5 mb-5">
                                @foreach($groups as $group)
                                    <div class="mt-4">
                                        <button onClick="window.location.href = '{{$group->id}}"
                                                style="background-image: url({{asset('storage/images/people/'.$group->id.'.jpeg')}})"
                                                class="btn small-profile-photo small-group-photo d-inline"></button>
                                        <span class="name">{{$group->name}}</span>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-secondary">
                                <small><i class="fas fa-plus me-2"></i> See all groups</small>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 posts-area ps-md-4 mt-5">
                    <div class="row first-recipe-mt">
                        <h3>Recipes</h3>
                        @foreach($recipes as $recipe)
                            @include('partials.preview.recipe', ['recipe' => $recipe])
                        @endforeach
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
