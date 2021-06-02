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

    <div id="messagesMobile" class="mt-2">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#conversationsCollapse" aria-expanded="false" aria-controls="conversationsCollapse">
            <i class="fas fa-comments me-2"></i> Conversations
        </button>
        <button type="button" class="btn btn-primary square-button float-end">
            <i class="fas fa-pencil-alt"></i>
        </button>
        <div class="collapse" id="conversationsCollapse">
            <div class="card card-body p-0">
                <div active class="p-3 conversation-card m-0" active>
                    @include('partials.chat.conversationCard', ['message' => 'Sarah1: Hello World!', 'name' => 'Sarah1'])
                </div>
                <hr class="dropdown-divider m-0">
                <div class="p-3 conversation-card m-0">
                    @include('partials.chat.conversationCard', ['message' => 'Sarah2: Hello World!', 'name' => 'Sarah2'])
                </div>
                <hr class="dropdown-divider m-0">
                <div class="p-3 conversation-card m-0">
                    @include('partials.chat.conversationCard', ['message' => 'Sarah3: Hello World!', 'name' => 'Sarah3'])
                </div>
            </div>
        </div>

    </div>
    <div class="card content-general-margin margin-to-footer mt-2" id="privateMessages">
        <div class="row g-0">
            <div class="col col-lg-4 p-3 disappear">
                <h5 class="m-0 d-inline-block mt-1">Conversations</h5>
                <button type="button" class="btn btn-primary square-button float-end">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="col p-3">
                <strong class="d-inline-block mt-1">Sarah Colbert</strong>
                <a role="button" href="{{ url('/') }}" class="btn btn-outline-secondary float-end py-1">
                    <small><i class="fas fa-user me-2"></i>
                    View Profile</small>
                </a>
            </div>
        </div>
        <div class="row g-0">
            <div class="col col-lg-4 disappear">
                <div class="container p-3 conversation-card" active>
                    @include('partials.chat.conversationCard', ['message' => 'Sarah1: Hello World!', 'name' => 'Sarah1'])
                </div>
                <hr class="dropdown-divider m-0">
                <div class="container p-3 conversation-card">
                    @include('partials.chat.conversationCard', ['message' => 'Sarah2: Hello World!', 'name' => 'Sarah2'])
                </div>
                <hr class="dropdown-divider m-0">
                <div class="container p-3 conversation-card">
                    @include('partials.chat.conversationCard', ['message' => 'Sarah3: Hello World!', 'name' => 'Sarah3'])
                </div>
                <hr class="dropdown-divider m-0">
            </div>
            <div class="col p-3 position-relative conversation-area h-100">
                <div class="row-6 g-0 message-container position-relative overflow-auto">
                    <div class="date-time-display">
                        <small>19 Feb 2021, 16:19</small>
                    </div>
                    <chat-messages :messages="messages"></chat-messages>
                    {{-- @include('partials.chat.messageLine', ['message' => 'Hello World!'])
                    @include('partials.chat.messageLine', ['message' => 'Hello World!'])
                    @include('partials.chat.messageLine', ['message' => 'Hello World!'])
                    @include('partials.chat.messageLine', ['message' => 'Hello World!'])
                    @include('partials.chat.messageLine', ['message' => 'Hello World!'])
                    @include('partials.chat.messageLine', ['message' => 'Hello World!'])
                    @include('partials.chat.messageLine', ['message' => 'Hello World!'])
                    @include('partials.chat.messageLine', ['message' => 'Hello World!']) --}}

                </div>
                <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                ></chat-form>
            </div>
        </div>
    </div>

@endsection

