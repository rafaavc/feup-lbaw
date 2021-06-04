<li class="nav-item">
    <button class="btn btn-primary btn-sm mt-2 nav-popover position-relative d-none d-lg-block"
            onclick="window.location='{{ url('/chat') }}'">
        <i class="fas fa-envelope"></i>
    </button>
    <a class="nav-link d-inline-block d-lg-none" href="{{ url('/chat') }}">
        @include('partials.nav.icontext', ['icon' => 'envelope', 'text' => 'Messages'])
    </a>
</li>
