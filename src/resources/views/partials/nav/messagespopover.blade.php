<li class="nav-item">
    <button data-popover-content="#messagesPopupContent" class="btn btn-primary btn-sm mt-2 nav-popover position-relative d-none d-lg-block" role="button" data-bs-placement="bottom" data-bs-toggle="popover">
        <i class="fas fa-envelope"></i>
        <div class="notif-quantity-indicator"><small>1</small></div>
    </button>
    <a class="nav-link d-inline-block d-lg-none" href="{{ url('/chat') }}">
        @include('partials.nav.icontext', ['icon' => 'envelope', 'text' => 'Messages'])
    </a>
    <div class="notif-quantity-indicator-inline d-inline-block d-lg-none"><small>1</small></div>
    <div id="messagesPopupContent" class="d-none">
        No messages in prototype.
        <a href="{{url('/chat')}}" role="button" class="btn btn-outline-secondary mt-2 btn-sm">
            <i class="fas fa-plus me-2"></i> View all messages
        </a>
    </div>
</li>
