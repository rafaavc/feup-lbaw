@php
    $private = true;
@endphp

@extends('layouts.profile')

@push('css')
    <link href="{{ asset('css/components/private_profile.css') }}" rel="stylesheet"/>
@endpush

@section('title', $user->name)

@section('body')
    <div class="private-profile">
        <i class="fas fa-lock fa-10x private-profile-icon"></i>
        <div class="private-profile-text-title">
            This account is private
        </div>
        <div class="private-profile-text">
            Follow this account to see their content
        </div>
    </div>
@endsection
