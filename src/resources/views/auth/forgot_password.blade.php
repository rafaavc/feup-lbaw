@extends('layouts.app')

@section('title', 'Forgot Password')

@push('css')
    <link href="{{ asset('css/signIn.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/inputIcon.css') }}" rel="stylesheet"/>
@endpush

@section('content')

    @include('partials.breadcrumb', ['pages' => ["Forgot Password"], 'withoutMargin' => false])

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
                <h1>Password Recovery</h1>
                <p>Please provide your details. We'll send you an email to recover your account.</p>

                <form method="POST" action="{{ url('/forgot_password/') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ isset($token) ? $token : "" }}">
                    <span class='d-block mt-4'>Username <span class='form-required'></span></span>
                    @include('partials.inputIcon', ['icon' => 'user', 'name' => 'username', 'required' => true, 'value' => request()->get('username')])
                    <span class='d-block mt-4'>Email Address <span class='form-required'></span></span>
                    @include('partials.inputIcon', ['icon' => 'envelope', 'name' => 'email', 'required' => true, 'type' => 'text'])
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary d-block">
                            Recover Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
