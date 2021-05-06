@extends('layouts.app')

@section('title', $group->name)

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
        @include('partials.breadcrumb', ['pages' => ["Groups", $group->name], 'withoutMargin' => true])
        <div>
            @include('partials.profile.cover', [
                                                    'name' => $group->name,
                                                    'image' => $group->profileImage(),
                                                    'text' => $group->description,
                                                    'numbers' => [
                                                        'Recipes' => $group->number_of_recipes,
                                                        'Members' => $group->number_of_members,
                                                    ],
                                                    'editLink' => url("/group/$group->id/edit"),
                                                    'actions' => [
                                                        'Join' => ['#', 'user-plus'],
                                                    ],
                                                    'group' => true,
                                                    'groupModerator' => $canEdit
                                                ])
            <div class="row group-body">
                <div class="col-md-4 p-0 pe-md-4 mt-5">
                    @include('partials.profile.peopleBox', ['name' => 'Members', 'people' => $group->members])
                </div>

                <div class="col-md-8 posts-area ps-md-4 mt-5">
                    @yield('body')
                </div>
            </div>
        </div>
    </main>
@endsection
