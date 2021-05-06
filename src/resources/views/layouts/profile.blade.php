@extends('layouts.app')

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
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @include('partials.breadcrumb', ['pages' => ["Users", $user->name], 'withoutMargin' => true])
        <div>
            @include('partials.profile.cover', [
                                                    'name' => $user->name,
                                                    'image' => $user->profileImage(),
                                                    'text' => $user->biography,
                                                    'numbers' => [
                                                        'Recipes' => $user->number_of_recipes,
                                                        'Followers' => $user->number_of_followers,
                                                        'Following' => $user->number_of_following,
                                                    ],
                                                    'editLink' => url("/user/$user->username/edit"),
                                                    'actions' => [
                                                        'Follow' => ['#', 'user-plus'],
                                                        'Chat' => [url("/chat/$user->username"), 'comments'],
                                                    ],
                                                    'group' => false
                                                ])
            <div class="row group-body">
                <div class="col-md-4 p-0 pe-md-4 mt-5">
                    @include('partials.profile.personalInfo')
                    @include('partials.profile.peopleBox', ['name' => 'Following', 'people' => $user->following])
                    @include('partials.profile.peopleBox', ['name' => 'Followers', 'people' => $user->followers])
                    @include('partials.profile.groupBox', ['name'=> 'Groups', 'groups' => []])
                </div>

                <div class="col-md-8 posts-area ps-md-4 mt-5">
                    @yield('body')
                </div>
            </div>
        </div>
    </main>
@endsection
