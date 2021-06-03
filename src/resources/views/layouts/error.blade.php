@extends('layouts.app')

<div class="mt-3 text-center"
     style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -100%)">
    @yield('header')

    <ul class="d-flex mt-3 ps-0" style="list-style-type: none;">
        <li class="col-6"><a class="btn btn-primary" href="{{ url()->previous() }}">Go back</a></li>
        <li class="col-6"><a class="btn btn-secondary" href="/">Homepage</a></li>
    </ul>
</div>
