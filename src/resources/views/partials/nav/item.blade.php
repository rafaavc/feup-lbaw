<li class="{{ isset($dropdown) && $dropdown ? "" : "nav-item" }}">
    <a class="{{ isset($dropdown) && $dropdown ? "dropdown-item" : "nav-link" }}" href="{{ $link }}">
        @include('partials.nav.icontext', [ 'icon' => $icon, 'text' => $name ])
    </a>
</li>
