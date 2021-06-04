<li class="nav-item">
    <a href="{{ url('/chat') }}">
        <button class="btn btn-primary btn-sm mt-2 nav-popover position-relative d-none d-lg-block">
            <i class="fas fa-envelope"></i>
        </button>
    </a>
    <a class="nav-link d-inline-block d-lg-none" href="{{ url('/chat') }}">
        @include('partials.nav.icontext', ['icon' => 'envelope', 'text' => 'Messages'])
    </a>
</li>
