@extends('layouts.app')

@section('title', 'Password Recovery')

@push('css')
    <link href="{{ asset('css/signIn.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/inputIcon.css') }}" rel="stylesheet"/>
@endpush

@section('content')

    @include('partials.breadcrumb', ['pages' => ["Reset Password" => ""], 'withoutMargin' => false])

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
                <h1>Reset Password</h1>
                <h3>Please enter your new password.</h3>

                <form method="POST" action="{{ url('/reset_password/') }}">
                    {{ csrf_field() }}
                    <span class='d-block mt-4'>Username <span class='form-required'></span></span>
                    @include('partials.inputIcon', ['icon' => 'user', 'name' => 'username', 'required' => true])
                    <span class='d-block mt-4'>Email Address <span class='form-required'></span></span>
                    @include('partials.inputIcon', ['icon' => 'envelope', 'name' => 'email', 'required' => true, 'type' => 'email', 'value' => request()->get('username')])
                    <span class='d-block mt-4'>Password <span class='form-required'></span></span>
                    @include('partials.inputIcon', ['icon' => 'lock', 'name' => 'password', 'required' => true, 'type' => 'password'])
                    <span class='d-block mt-4'>Repeat Password <span class='form-required'></span></span>
                    @include('partials.inputIcon', ['icon' => 'lock', 'name' => 'repeat-password', 'required' => true, 'type' => 'password'])
                    <input hidden name="token" placeholder="token"
                           value="{{request()->segment(count(request()->segments()))}}">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary d-block">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
