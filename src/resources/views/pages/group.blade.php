@extends('layouts.app')

@section('title', $group->name)
@section('description', $group->description)
@section('thumbnail', $group->profileImage())

@push('css')
    <link href="{{ asset('css/components/membersFollowingBoxes.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/group.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/membersFollowingBoxes.js') }}" defer></script>
    <script src="{{ asset('js/navPopups.js') }}" type="module"></script>
    <script src="{{ asset('js/addToFavourites.js') }}" defer></script>
    <script src="{{ asset('js/group.js') }}" type="module"></script>
@endpush

@section('content')
    <main class="content-general-padding margin-to-footer">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @include('partials.breadcrumb', ['pages' => ["Groups" => "", $group->name => ""], 'withoutMargin' => true])
        <div>
            @include('partials.profile.cover', [
                                                    'name' => $group->name,
                                                    'image' => $group->profileImage(),
                                                    'coverPhoto' => $group->coverPhoto(),
                                                    'text' => $group->description,
                                                    'numbers' => [
                                                        'Recipes' => $group->number_of_recipes,
                                                        'Members' => $group->number_of_members,
                                                    ],
                                                    'canEdit' => Gate::inspect('update', $group)->allowed(),
                                                    'editLink' => url("/group/$group->id/edit"),
                                                    'actions' => [
                                                        'Join' => ['#', 'user-plus'],
                                                    ],
                                                ])
            <div class="row group-body">
                @if(Gate::inspect('view', $group)->allowed())
                    <div class="col-md-4 p-0 pe-md-4 mt-5">
                        @if(Gate::inspect('post', $group)->allowed())
                            <div class="card m-0 mb-4 shadow-sm text-center p-3 personal-info">
                                <a class="btn btn-primary mt-2" href="{{url("/group/$group->id/recipe")}}">Create
                                    Recipe</a>
                            </div>
                        @endif
                        @include('partials.profile.peopleBox', [
                                                'name' => 'Members (<span class="group-member-amount">' . $group->members()->count() . '</span>)',
                                                'people' => $group->members()->limit(6)->get(),
                                                'actions' => '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seeAllGroupMembersModal">
                                                                    <i class="fas fa-plus me-2"></i>
                                                                    View all
                                                                </button>'
                                            ])
                        @if(Gate::inspect('update', $group)->allowed() && sizeof($requests) > 0)
                            @include('partials.profile.requestBox', ['name' => 'Member Requests',
                                                                     'new' => true])
                        @endif
                    </div>

                    <div class="col-md-8 posts-area ps-md-4 mt-5">
                        <div class="row first-recipe-mt">
                            <h3>Recipes</h3>
                            @if(sizeof($group->recipes) == 0)
                                <p>This group has no recipes yet.
                                    @if(Gate::inspect('post', $group)->allowed())
                                        Create your own!
                                    @endif
                                </p>
                            @else
                                @foreach($group->recipes as $recipe)
                                    @include('partials.preview.recipe')
                                @endforeach
                            @endif
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-center mt-4">
                        <div class="text-center">
                            <i class="fas fa-lock fa-10x private-profile-icon mb-4"></i>
                            <div class="private-profile-text-title">
                                This group is private
                            </div>
                            <div class="private-profile-text">
                                Join this group to see its content
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
    @include('partials.confirmation', [
        'modalId' => 'seeAllGroupMembersModal',
        'modalTitle' => 'Members of ' . htmlentities($group->name) . ' (<span class="group-member-amount">' . $group->members()->count() . '</span>)',
        'modalMessage' => view('partials.profile.groupMembersList', ['group' => $group, 'offset' => 0]),
        'modalNoText' => 'Close'
    ])
@endsection
