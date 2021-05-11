@extends('layouts.app')

@push('css')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" />
@endpush

@section('content')

<main class="margin-to-footer">
    <section>
        <div id="carouselExampleDark" class="carousel carousel-light slide carousel-fade"  data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item home-slide content-general-padding active" style="background-image: url({{ asset('storage/images/image22.jpg') }})" data-bs-interval="2500">
                    <h2 class="display-4 mb-3 shadow"><strong>TasteBuds helps people build a community of</strong></h2>
                    <h2><div class="display-2 shadow-lg my-1"><strong>healthy</strong></div><div class="display-4 shadow"><strong>eating habits</strong></div></h2>
                    <a role="button" class="btn btn-light shadow" href="{{ url('/about') }}">About Us</a>
                    <a role="button" class="btn btn-light me-4 shadow" href="{{ url('/faq') }}">FAQ</a>
                </div>
                <div class="carousel-item home-slide content-general-padding" style="background-image: url({{ asset('storage/images/image21.jpg') }})" data-bs-interval="2500">
                    <h2 class="display-4 mb-3 shadow"><strong>TasteBuds helps people build a community of</strong></h2>
                    <h2><div class="display-2 shadow-lg my-1"><strong>diverse</strong></div><div class="display-4 shadow"><strong>eating habits</strong></div></h2>
                    <a role="button" class="btn btn-light shadow" href="{{ url('/about') }}">About Us</a>
                    <a role="button" class="btn btn-light me-4 shadow" href="{{ url('/faq') }}">FAQ</a>
                </div>
                <div class="carousel-item home-slide content-general-padding" style="background-image: url({{ asset('storage/images/image20.jpg') }}); background-position: 100% 70%" data-bs-interval="2500">
                    <h2 class="display-4 mb-3 shadow"><strong>TasteBuds helps people build a community of</strong></h2>
                    <h2><div class="display-2 shadow-lg my-1"><strong>tasty</strong></div><div class="display-4 shadow"><strong>eating habits</strong></div></h2>
                    <a role="button" class="btn btn-light shadow" href="{{ url('/about') }}">About Us</a>
                    <a role="button" class="btn btn-light me-4 shadow" href="{{ url('/faq') }}">FAQ</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="content-general-margin">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="d-flex flex-column bd-highlight align-items-lg-end content-align">
                        <h2><strong>Find awesome new recipes</strong></h2>
                        <div class="bd-highlight">Impress your peers with your</div>
                        <div class="bd-highlight">awesome new dishes!</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('storage/images/findRecipes.jpg') }}" class="d-block w-75 h-100" alt="Picture of girl giving a piece of cake to her mom">
                </div>
            </div>
            <hr class="mt-5 w-100">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <img src="{{ asset('storage/images/shareRecipes.jpg') }}" class="d-block float-end w-75 h-100" alt="Image with internet references representing how we can use the internet to share content">
                </div>
                <div class="col-lg-6">
                    <div class="d-flex flex-column bd-highlight content-align">
                        <h2><strong>Share your recipes</strong></h2>
                        <div class="bd-highlight">Share your favourite</div>
                        <div class="bd-highlight">recipes with the world!</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content-red sign-up-call-to-action">
            <div class="col-lg-6">
                <div class="d-flex flex-column bd-highlight align-items-lg-end p-4 text-white">
                        <strong class="fs-1">Sign Up</strong>
                        <div class="bd-highlight fs-4">Start connecting now</div>
                </div>
            </div>
            <div class="col-lg-6 content-align p-5">
                <a href="{{ url('/signup') }}" role="button" class="btn btn-light btn-lg btn-large d-inline-block">Let's do it!</a>
            </div>
        </div>
        <div class="row cards-homepage content-general-margin">
            <div class="row mt-5 text-center">
                <h1><strong>Find New Friends</strong></h1>
                <p>Connect with new people!</p>
            </div>
            <div class="card-group g-5 text-center p-0">
                <div class="col-md my-3">
                    <div class="card h-100 me-md-3">
                        <img src="{{ asset('storage/images/follow.jpg') }}" class="card-img-top" alt="Image depicting two people representing user following one another">
                        <div class="card-body">
                            <h5 class="card-title">Follow</h5>
                            <p class="card-text">Follow people to get updates about them and the new recipes they publish!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md my-3">
                    <div class="card h-100 me-md-3">
                        <img src="{{ asset('storage/images/group.jpg') }}" class="card-img-top" alt="Image with a lot of people talking at the same time">
                        <div class="card-body">
                            <h5 class="card-title">Group</h5>
                            <p class="card-text">Create or join private or public groups!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md my-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/images/chat.jpg') }}" class="card-img-top" alt="Image with people sending messages to others using the internet">
                        <div class="card-body">
                            <h5 class="card-title">Chat</h5>
                            <p class="card-text">Need more information? Want to know the person behind the recipe? Send them a message!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
