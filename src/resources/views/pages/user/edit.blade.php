@extends('layouts.app')

@section('title', "Edit " . $user->name)

@push('css')
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/edit_profile.js') }}" defer></script>
@endpush

<?php
$role = "member";
?>
@include('partials.breadcrumb', ['pages' => ["Users", $user->name, "Edit Profile"], 'withoutMargin' => false])
<div class="container content-general-margin margin-to-footer">
    <h1 class="mt-5">Edit Profile</h1>
    @if($errors->any())
        <div class="alert alert-danger" id="error-messages" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif
    <form class="card shadow-sm p-2 w-auto h-auto p-5 mt-4 edit-profile-card" method="post">
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
                                    <input type="file" name="profileImage"/>
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
                     src="{{asset('storage/images/people/' . $user->id . '.jpeg')}}">
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
                                    <input type="file" name="coverImage"/>
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
                    src="https://res.cloudinary.com/sanitarium/image/fetch/q_auto/https://www.sanitarium.com.au/getmedia%2Fae51f174-984f-4a70-ad3d-3f6b517b6da1%2Ffruits-vegetables-healthy-fats.jpg%3Fwidth%3D1180%26height%3D524%26ext%3D.jpg"
                    class="bd-placeholder-img">
            </div>
        </div>

        <h6 class="area-title mt-4">Biography <span class='form-required'></span></h6>
        <div class="form-group">
            <textarea name="biography" class="form-control mb-4 p-3 edit-profile-text-input" rows="3">{{$user->biography}}</textarea>
        </div>

        <h6 class="area-title">Name <span class='form-required'></span></h6>
        <div class="form-group">
            <textarea name="name" class="form-control mb-4 p-3 edit-profile-text-input" rows="1" style="resize: none;">{{$user->name}}</textarea>
        </div>

        <h6 class="area-title">Country <span class='form-required'></span></h6>
        <div class="form-group">
            <select name="country" id="country" class="form-select form-control me-2 form-control mb-4 p-3 edit-profile-text-input">
                @foreach(App\Models\Country::all() as $country)
                    <option
                        value="{{$country->id}}" {{$country->id == $user->country->id ? "selected" : ""}}>{{$country->name}}</option>
                @endforeach
            </select>
        </div>

        <h6 class="area-title">City</h6>
        <div class="form-group">
            <textarea name="city" class="form-control mb-4 p-3 edit-profile-text-input" rows="1" style="resize: none;">{{$user->city}}</textarea>
        </div>

        <h6 class="area-title">Email</h6>
        <div class="form-group">
            <textarea name="email" class="form-control mb-4 p-3 edit-profile-text-input" rows="1" style="resize: none;">{{$user->email}}</textarea>
        </div>

        <h6 class="area-title">Username</h6>
        <div class="form-group">
            <textarea name="username" class="form-control mb-5 p-3 edit-profile-text-input" rows="1" style="resize: none;">{{$user->username}}</textarea>
        </div>

        <h6 class="area-title">Profile Visibility <span class='form-required'></span></h6>
        <div class="form-check">
            <input class="form-check-input" value="public" type="radio" name="visibility" id="flexRadioDefault1" {{$user->visibility === true ? "checked" : ""}}>
            <label class="form-check-label" for="flexRadioDefault1">
                Public
            </label>
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" value="private" type="radio" name="visibility" id="flexRadioDefault2" {{$user->visibility === false ? "checked" : ""}}>
            <label class="form-check-label" for="flexRadioDefault2">
                Private
            </label>
        </div>
        <div class="row d-flex justify-content-around justify-content-md-between my-5">

            <input type="submit" class="btn btn-primary submit-button my-2" value="Submit">

            <button class="btn btn-secondary submit-button my-2">
                <i class="far fa-edit"></i>
                &nbsp; Change Password
            </button>


            <a href="{{url('user/' . $user->username . '/delete')}}" class="btn btn-danger submit-button my-2">
                <i class="fas fa-trash me-3"></i>
                Delete Profile
            </a>

        </div>
    </form>

</div>
