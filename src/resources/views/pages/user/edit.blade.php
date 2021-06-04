@extends('layouts.app')

@section('title', "Edit " . htmlentities($user->name))

@push('css')
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/edit_profile.js') }}" type="module"></script>
@endpush

<?php
$role = "member";
?>
@include('partials.breadcrumb', ['pages' => ["Users" => "/user/" . $user->username, $user->name => "/user/" . $user->username, "Edit Profile" => ""], 'withoutMargin' => false])
<div class="container content-general-margin margin-to-footer">
    <h1 class="mt-5">Edit Profile</h1>
    @if($errors->any())
        <div class="alert alert-danger" id="error-messages" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" id="edit-profile-form" class="card shadow-sm p-2 w-auto h-auto p-5 mt-4 edit-profile-card"
          method="post">
        @csrf
        <div class="row">
            <div class="col profile-photo-area">
                <div class="row row-with-image">
                    <h6 class="area-title d-inline-block">Profile Photo</h6>
                </div>
                <div id="user-profile-image-input">
                    @if ($img = $user->hasProfileImage())
                        <span data-url={{ $img }}></span>
                    @endif
                </div>
            </div>
            <div class="col cover-photo-area">
                <div class="row area-title-row row-with-image">
                    <h6 class="area-title">Cover Photo</h6>
                </div>
                <div id="user-cover-image-input">
                    @if ($img = $user->hasCoverImage())
                        <span data-url={{ $img }}></span>
                    @endif
                </div>
            </div>
        </div>

        <h6 class="area-title mt-4">Biography</h6>
        <div class="form-group">
            <textarea name="biography" class="form-control mb-4 p-3 edit-profile-text-input"
                      rows="3" maxlength="512">{{$user->biography}}</textarea>
        </div>

        <h6 class="area-title">Name <span class='form-required'></span></h6>
        <div class="form-group">
            <input type="text" required name="name" class="form-control mb-4 p-3 edit-profile-text-input" rows="1"
                      style="resize: none;" minlength="4" maxlength="60" value="{{$user->name}}"></input>
        </div>

        <h6 class="area-title">Country <span class='form-required'></span></h6>
        <div class="form-group">
            <select required name="country" id="country"
                    class="form-select form-control me-2 form-control mb-4 p-3 edit-profile-text-input">
                @foreach(App\Models\Country::all() as $country)
                    <option
                        value="{{$country->id}}" {{$country->id == $user->country->id ? "selected" : ""}}>{{$country->name}}</option>
                @endforeach
            </select>
        </div>

        <h6 class="area-title">City</h6>
        <div class="form-group">
            <input type="text" maxlength="60" name="city" class="form-control mb-4 p-3 edit-profile-text-input" rows="1"
                      style="resize: none;" value="{{$user->city}}"></input>
        </div>

        <h6 class="area-title">Email <span class='form-required'></span></h6>
        <div class="form-group">
            <input type="text" required maxlength="100" minlength="5" name="email" class="form-control mb-4 p-3 edit-profile-text-input" rows="1"
                      style="resize: none;" value="{{$user->email}}"></input>
        </div>

        <h6 class="area-title">Username <span class='form-required'></span></h6>
        <div class="form-group">
            <input type="text" name="username" class="form-control mb-5 p-3 edit-profile-text-input" rows="1"
                    minlength="4" maxlength="20"
                    pattern="^[a-zA-Z0-9]+((_|\.)[a-zA-Z0-9]+)*$"
                    title="Must contain only letters numbers, '_' and '.', but the last two can only appear surrounded by letters or numbers"
                    style="resize: none;" value="{{$user->username}}" required></input>
        </div>

        <h6 class="area-title">Change Password</h6>
        <div class="form-group">
            <input type="password" name="currentPassword" minlength="5" class="form-control mb-3 p-2 edit-profile-text-input" placeholder="Current Password" rows="1"
                      style="resize: none;"></textarea>
            <input type="password" name="newPassword" minlength="5" class="form-control mb-3 p-2 edit-profile-text-input" placeholder="New Password" rows="1"
                    style="resize: none;"></textarea>
            <input type="password" name="repeatNewPassword" minlength="5" class="form-control mb-5 p-2 edit-profile-text-input" placeholder="Repeat New Password"  rows="1"
                        style="resize: none;"></textarea>
        </div>

        <h6 class="area-title">Profile Visibility <span class='form-required'></span></h6>
        <div class="form-check">
            <input class="form-check-input" value="public" type="radio" name="visibility"
                   id="flexRadioDefault1" {{$user->visibility === true ? "checked" : ""}}>
            <label class="form-check-label has-tooltip" for="flexRadioDefault1" title="If you select this option, everyone will see your recipes">
                Public
            </label>
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" value="private" type="radio" name="visibility"
                   id="flexRadioDefault2" {{$user->visibility === false ? "checked" : ""}}>
            <label class="form-check-label has-tooltip" for="flexRadioDefault2" title="If you select this option, only your followers will see your recipes">
                Private
            </label>
        </div>
        <div class="row d-flex justify-content-around justify-content-md-between my-5">

            <input type="submit" class="btn btn-primary submit-button my-2" value="Submit">

            <button data-bs-toggle="modal" data-bs-target="#profileDeleteConfirmationModal" class="btn btn-danger submit-button my-2 deleteProfile has-tooltip" title="Delete your profile and all of your recipes, comments and groups">
                <i class="fas fa-trash me-3"></i>
                Delete Profile
            </button>
        </div>
    </form>

</div>
@include('partials.confirmation', [
    'modalId' => 'profileDeleteConfirmationModal',
    'modalTitle' => 'Delete your account',
    'modalMessage' => 'Do you really want to delete your profile? This action is irreversible!<br/><br/>We\'re sad to see you go.',
    'modalYesId' => 'confirmAccountDeletion',
    'modalYesText' => 'Yes',
    'modalNoText' => 'No'
])
