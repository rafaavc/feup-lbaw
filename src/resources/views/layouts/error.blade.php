@extends('layouts.app')

<div class="mt-5 text-center"
     style="position: absolute; left: 50%; transform: translate(-50%)">
    <img src="{{ asset('storage/images/broken-eggs.png') }}" style="width: 13em; height: 10em;">

    @yield('header')

    <ul class="d-flex mt-3 ps-0" style="list-style-type: none;">
        <li class="col-6"><a class="btn btn-primary" href="{{ url()->previous() }}">Go back</a></li>
        <li class="col-6"><a class="btn btn-secondary" href="/">Homepage</a></li>
    </ul>
</div>
