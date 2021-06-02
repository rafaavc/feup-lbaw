@extends('layouts.app')

@push('css')
    <link href="{{ asset('css/privateMessages.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
@endpush

@section('content')

    @include('partials.breadcrumb', ['pages' => ["Private Messages"], 'withoutMargin' => false])


    <div class="card content-general-margin margin-to-footer mt-2" id="privateMessages">
        <div class="row g-0">
            <div class="col p-3">
                <strong class="d-inline-block mt-1">{{ Auth::user()->name }}'s Chat</strong>
                <a role="button" href="{{ url('/user/' . Auth::user()->username ) }}" class="btn btn-outline-secondary float-end py-1">
                    <small><i class="fas fa-user me-2"></i>
                    My Profile</small>
                </a>
            </div>
        </div>
        <div class="row g-0">

            <div class="col p-3 position-relative conversation-area h-100">
                <div class="row-6 g-0 message-container position-relative overflow-auto">
                    {{-- <div class="date-time-display">
                        <small>19 Feb 2021, 16:19</small>
                    </div> --}}
                    <chat-messages :messages="messages" :user="{{ Auth::user()->id }}" :rootpath="'{{ url(asset('storage/images/')) }}'"></chat-messages>
                </div>
                <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user()->id }}"
                ></chat-form>
            </div>
        </div>
    </div>

@endsection

