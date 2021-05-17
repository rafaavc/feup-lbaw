@extends('layouts.app')

@section('title', isset($group) ? "Edit Group" : "Create Group")

@push('css')
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/upsert_group.js') }}" defer></script>
@endpush

@section('content')

@php
    $hasErrors = $errors->any();
    $old = ($hasErrors) ? \Illuminate\Support\Facades\Request::old() : '';
    $breadcrumbPages = ["Groups", isset($group) ? $group->name : "Create Group"];
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
        @csrf
        <div class="row">
            <div class="col profile-photo-area mx-2">
                <div class="row row-with-image">
                    <div class="col area-title-col">
                        <h6 class="area-title d-inline-block">Profile Photo</h6> <span class='form-required'></span>
                    </div>
                    <div class="col text-end profile-photo-button-col p-0">
                        <div class="dropdown w-20 ms-auto">
                            <button type="button" class="btn edit-photo-button btn-no-shadow" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu w-100">
                                <li>
                                    <a class="dropdown-item file-input">
                                        <i class="fas fa-upload me-2"></i>
                                        Upload Image
                                    </a>
                                    <input type="file" class="d-none myFile" name="profileImage"/>
                                </li>
                                <li>
                                    <a class="dropdown-item file-delete">
                                        <i class="fas fa-eraser me-2"></i>
                                        Clear Image
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <img class="rounded-circle z-depth-2 profile-image"
                     src='{{isset($group) ? $group->profileImage() : asset('storage/images/people/no_image.png')}}'>
            </div>
            <div class="col cover-photo-area mx-2">
                <div class="row area-title-row row-with-image">
                    <div class="col area-title-col">
                        <h6 class="area-title">Cover Photo</h6>
                    </div>
                    <div class="col text-end p-0">
                        <div class="dropdown w-20 ms-auto">
                            <button type="button" class="btn edit-photo-button btn-no-shadow" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu w-100">
                                <li>
                                    <a class="dropdown-item file-input"><i class="fas fa-upload me-2"></i>Upload
                                        Image</a>
                                    <input type="file" class="d-none myFile" name="coverImage"/>
                                </li>
                                <li>
                                    <a class="dropdown-item file-delete"><i class="fas fa-eraser me-2"></i>Clear
                                        Image</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <img
                    src='{{ isset($group) ? $group->coverPhoto() : asset('storage/images/people/no_image.png') }}'
                    class="bd-placeholder-img">
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

        <h6 class="area-title">Group Visibility <span class='form-required'></span></h6>
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

        <input type="submit" class="btn btn-primary submit-button mt-5" value='{{ isset($group) ? "Edit Group" : "Create Group" }}'>

    </form>

</div>

@endsection
