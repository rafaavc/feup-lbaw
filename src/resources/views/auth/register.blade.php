@extends('layouts.app')

@section('title', 'Sign Up')

@push('css')
    <link href="{{ asset('css/signIn.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/signUp.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/inputIcon.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/signUp.js') }}" type="module"></script>
    <script src="{{ asset('js/progressBar.js') }}" defer></script>
@endpush

@section('content')

    @include('partials.breadcrumb', ['pages' => ["Sign Up" => ""], 'withoutMargin' => false])

    <div class="container content-general-margin mt-2 margin-to-footer">
        <div class="row">
            <div class="col-xl-6 sign-img">
                <div class="d-grid gap-2 col-6 mx-auto mt-5 sign-left-text w-100 text-center">
                    <div class="welcome-msg text-start">
                        <h1><strong>You're </strong>about to</h1>
                        <h1 class="text-center">be part of this</h1>
                        <h1 class="fw-bolder text-center">COMMUNITY</h1>
                        <a href="{{ url('/') }}" role="button" class="btn btn-dark w-100 mx-auto mt-4">Go Home</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 sign-form">
                @if($errors->any())
                    <div class="alert alert-danger" id="error-messages" role="alert">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif
                <div class="position-relative d-none sign-up-stepper">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item position-absolute top-0 start-0 translate-middle" role="presentation">
                            <button class="btn btn-primary active rounded-pill" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">1
                            </button>
                        </li>
                        <li class="nav-item position-absolute top-0 start-50 translate-middle" role="presentation">
                            <button disabled class="btn btn-primary rounded-pill" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">2
                            </button>
                        </li>
                        <li class="nav-item position-absolute top-0 start-100 translate-middle" role="presentation">
                            <button disabled class="btn btn-primary rounded-pill" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">3
                            </button>
                        </li>
                    </ul>
                    <ul class="nav nav-pills position-relative" id="pills-tab" role="tablist">
                        <li class="position-absolute start-0 translate-middle d-none next-step">
                            <p class="progress-caption text-center">Account Info</p>
                        </li>
                        <li class="position-absolute start-50 translate-middle d-none next-step">
                            <p class="progress-caption text-center">Personal Info</p>
                        </li>
                        <li class="position-absolute start-100 translate-middle d-none next-step">
                            <p class="progress-caption text-center">Finish!</p>
                        </li>
                    </ul>
                </div>
                <form class="tab-content register-tb" id="pills-tabContent" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <h1>Sign Up</h1>
                        <h3>Please enter your account details.</h3>

                        <span class='d-block mt-4'>Username <span class='form-required'></span></span>
                        @include('partials.inputIcon', ['pattern' => '^[a-zA-Z0-9]+((_|\.)[a-zA-Z0-9]+)*$', 'minlength' => "4", 'maxlength' => "20", 'title' => "Must contain only letters numbers, '_' and '.', but the last two can only appear surrounded by letters or numbers", 'icon' => 'user', 'name' => 'username', 'required' => true])
                        <span class='d-block mt-4'>Email Address <span class='form-required'></span></span>
                        @include('partials.inputIcon', ['icon' => 'envelope', 'name' => 'email', 'minlength' => "5", 'maxlength' => "100", 'required' => true, 'type' => 'email'])
                        <span class='d-block mt-4'>Password <span class='form-required'></span></span>
                        @include('partials.inputIcon', ['icon' => 'lock', 'name' => 'password', 'minlength' => "5", 'required' => true, 'type' => 'password'])
                        <span class='d-block mt-4'>Repeat Password <span class='form-required'></span></span>
                        @include('partials.inputIcon', ['icon' => 'lock', 'name' => 'repeat-password', 'required' => true, 'type' => 'password'])

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="button" class="btn btn-primary d-block next-step" id="first-step">Sign Up
                            </button>
                        </div>
                        <span class="d-block text-center mt-3">Already have an account?&nbsp;
                            <a href="{{ url('login') }}" class="signUp-a">Sign In</a>
                        </span>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h1>Sign Up</h1>
                        <h3>Please enter your personal details.</h3>
                        <span class='d-block mt-4'>Name <span class='form-required'></span></span>
                        @include('partials.inputIcon', ['icon' => 'user', 'minlength' => "4", 'maxlength' => "60", 'name' => 'name', 'required' => true])
                        <span class='d-block mt-4'>Country <span class='form-required'></span></span>
                        <!--include('partials.inputIcon', ['icon' => 'flag', 'name' => 'country', 'required' => true])-->
                        <div class="d-flex mb-3">
                            <select name="countryId" id="country" required class="form-select form-control me-2">
                                @foreach(App\Models\Country::all() as $country)
                                    <option
                                        value="{{$country->id}}" {{$country->name == "Portugal" ? "selected" : ""}}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class='d-block mt-4'>City</span>
                        @include('partials.inputIcon', ['icon' => 'map-marker-alt', 'maxlength' => 60, 'name' => 'city'])
                        <span class='d-block mt-4'>Profile Photo</span>
                        <div id="profile-photo-input"></div>
                        <div class="d-grid gap-2 col-6 mx-auto my-2">
                            <button type="button" id="second-step" class="btn btn-primary d-block mt-3 next-step">Next</button>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-5" id="pills-contact" role="tabpanel"
                         aria-labelledby="pills-contact-tab">
                        <div class="text-center">
                            <p class="mb-5"><strong class="finish-msg">YOU'RE IN!</strong></p>
                            <img src="https://thumbs.gfycat.com/ShyCautiousAfricanpiedkingfisher-max-1mb.gif"
                                 alt="image representing that the registration was successful">
                            <div class="d-grid gap-2 col-6 mx-auto mt-5">
                                <input type="submit" class="btn btn-primary d-block" name="Finish"></input>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
