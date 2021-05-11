@extends('layouts.app')

@section('title', "About")

@push('css')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet"/>
@endpush

@include('partials.breadcrumb', ['pages' => ["About Us"], 'withoutMargin' => false])

<h1 class="content-general-margin mt-3">About Us</h1>
<div class="card shadow p-4 my-4 bg-body rounded content-general-margin edit-content-text overflow-auto">
    TasteBuds is a new concept of a social network that enables people to share cooking recipes with the world, gain visibility, and possibly attracting new people to their business or any other ventures. Technology is always evolving to improve and facilitate people's lives. Cooking is one of the things we do every day, and TasteBuds is the best tool to ease the task of remembering all the cooking recipes while helping people diversify and improve their eating habits. Created by four young FEUP entrepreneurs, TasteBuds' main goal is to build a community where people can help each other create even better recipes every day!
</div>

<div class="card text-center user-profiles content-general-margin shadow-lg user-images-settings mb-3">
    <p class="fs-4 text-start ps-4 pt-4">Our Team</p>
    <div class="row d-flex justify-content-around">
        @include('partials.temUser', ['name' => 'Alexandre Abreu', 'photo' => 'storage/images/a3brx.jpeg'])
        @include('partials.temUser', ['name' => 'Rafael Cristino', 'photo' => 'storage/images/rafaavc.jpeg'])
        @include('partials.temUser', ['name' => 'Rui Pinto', 'photo' => 'storage/images/2dukes.jpeg'])
        @include('partials.temUser', ['name' => 'Tiago Gomes', 'photo' => 'storage/images/tiagoogomess.jpeg'])
    </div>
</div>
