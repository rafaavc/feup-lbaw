@extends('layouts.app')

@section('title', isset($group) ? "Edit Group" : "Create Group")

@push('css')
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/upsert_group.js') }}" type="module"></script>
@endpush

@section('content')

@php
    $hasErrors = $errors->any();
    if(isset($group))
        $breadcrumbPages = ["Groups" => "/group/" . $group->id, $group->name => "/group/" . $group->id, "Edit Group" => ""];
    else
        $breadcrumbPages = ["Groups" => "", "Create Group" => ""];
@endphp

@include('partials.breadcrumb', ['pages' => $breadcrumbPages, 'withoutMargin' => false])

<div class="container content-general-margin margin-to-footer">
    <h1 class="mt-5">{{ isset($group) ? "Edit Group" : "Create Group" }}</h1>
    @if($errors->any())
        <div class="alert alert-danger" id="error-messages">
            @foreach($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="card shadow-sm p-2 w-auto h-auto p-5 mt-4 edit-profile-card"
          method="post" action="{{ url('/group/' . (isset($group) ? ($group->id . '/edit') : '')) }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col profile-photo-area">
                <div class="row row-with-image">
                    <h6 class="area-title d-inline-block">Group Photo</h6>
                </div>
                <div id="group-profile-image-input">
                    @if (isset($group) && $img = $group->hasProfileImage())
                        <span data-url={{ $img }}></span>
                    @endif
                </div>
            </div>
            <div class="col cover-photo-area">
                <div class="row area-title-row row-with-image">
                    <h6 class="area-title">Cover Photo</h6>
                </div>
                <div id="group-cover-image-input">
                    @if (isset($group) && $img = $group->hasCoverPhoto())
                        <span data-url={{ $img }}></span>
                    @endif
                </div>
            </div>
        </div>

        <h6 class="area-title mt-4">Group Name <span class='form-required'></span></h6>
        <div class="form-group">
            <textarea name="name" class="form-control mb-4 p-3 edit-profile-text-input" rows="1" required
                      style="resize: none;">{{ isset($group) ? $group->name : "" }}</textarea>
        </div>

        <h6 class="area-title">Group Description <span class='form-required'></span></h6>
        <div class="form-group">
            <textarea name="description" class="form-control mb-4 p-3 edit-profile-text-input" required
                      rows="3">{{ isset($group) ? $group->description : "" }}</textarea>
        </div>

        <h6 class="area-title" data-toggle="tooltip" data-placement="top" title="Do you want everyone to see your group recipes, or only its members?">Group Visibility <span class='form-required'></span></h6>
        <div class="form-check">
            <input class="form-check-input" value="1" type="radio" name="visibility" required
                   id="flexRadioDefault1" {{ isset($group) && $group->visibility ? "checked" : "" }}>
            <label class="form-check-label" for="flexRadioDefault1">
                Public
            </label>
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" value="0" type="radio" name="visibility" required
                   id="flexRadioDefault2" {{ isset($group) && !$group->visibility ? "checked" : "" }}>
            <label class="form-check-label" for="flexRadioDefault2">
                Private
            </label>
        </div>

        <div class="row d-flex justify-content-around justify-content-md-between my-5">

            <input type="submit" class="btn btn-primary submit-button mt-5" value='{{ isset($group) ? "Edit Group" : "Create Group" }}'>

            @if (isset($group))
                <button class="btn btn-danger submit-button delete-group-button mt-5" data-bs-toggle="modal" data-bs-target="#groupDeleteConfirmationModal" data-toggle="tooltip" data-placement="top" title="Delete group and all its information">
                    <i class="fas fa-trash me-3"></i> Delete Group
                </button>
            @endif

        </div>



    </form>

</div>
<form id="deleteGroupForm" method="GET"
        action="{{ url('group/' . $group->id . '/delete') }}">
    {{ csrf_field() }}
</form>

@include('partials.confirmation', [
    'modalId' => 'groupDeleteConfirmationModal',
    'modalTitle' => 'Delete group "'.$group->name.'"',
    'modalMessage' => 'Do you really want to delete this group? This action is irreversible!',
    'modalYesFunction' => 'document.querySelector("#deleteGroupForm").submit()',
    'modalYesText' => 'Yes',
    'modalNoText' => 'No'
])
@endsection
