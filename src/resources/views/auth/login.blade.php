@extends('layouts.app')

@section('title', 'Sign In')

@push('css')
    <link href="{{ asset('css/signIn.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/inputIcon.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="https://apis.google.com/js/platform.js" async defer></script>
@endpush


@section('content')

    @include('partials.breadcrumb', ['pages' => ["Sign In"], 'withoutMargin' => false])

    <div class="content-general-margin mt-2 margin-to-footer">
        <div class="row">
            <div class="col-xl-6 sign-img">
                <div class="d-grid gap-2 col-6 mx-auto mt-5 sign-left-text w-100 text-center">
                    <div class="welcome-msg">
                        <h1><strong>Welcome Back,</strong></h1>
                        <h3>Sign in to continue</h3>
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
                <h1>Sign In</h1>
                <h3>Please enter your account details.</h3>

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <span class='d-block mt-4'>Username</span>
                    <div class="d-flex mb-3">
                        <i class='fas fa-user fa-icon-left'></i>
                        <input id="username" type="text" name="username" required autofocus class="form-control icon-left me-2" aria-label="Member's username" aria-describedby="basic-addon2">
                    </div>
                    <span class='d-block mt-4'>Password</span>
                    <div class="d-flex mb-3">
                        <i class='fas fa-lock fa-icon-left'></i>
                        <input id="password" type="password" name="password" required
                               class="form-control icon-left me-2" aria-label="Member's password"
                               aria-describedby="basic-addon2">
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary d-block">
                            Sign In
                        </button>
                    </div>
                </form>

                <span class="d-block text-center mt-3">Don't have an account? &nbsp;<a href="{{ url('/register') }}"
                                                                                       class="signUp-a">Sign Up</a></span>
                <div class="separator mt-3">or</div>

                <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
                <div class="g-signin2" data-width="200"></div>
            </div>
        </div>
    </div>

@endsection
