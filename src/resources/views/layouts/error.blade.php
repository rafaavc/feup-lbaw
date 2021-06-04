@extends('layouts.app')

@section('content')
    <div class="mt-5 text-center"
         style="position: absolute; left: 50%; transform: translate(-50%)">
        <img src="{{ asset('storage/images/broken-eggs.png') }}" style="width: 13em; height: 10em;" alt="image of broken eggs">

        @yield('header')

        <ul class="d-flex mt-3 ps-0" style="list-style-type: none;">
            <li class="col-6">
                <button class="btn btn-primary" onclick="window.history.back()">
                    Go back
                </button>
            </li>
            <li class="col-6">
                <a class="btn btn-secondary" href="{{ Auth::guard('admin')->check() ? '/admin/users' : '/feed' }}">
                    Homepage
                </a>
            </li>
        </ul>
    </div>
@endsection
