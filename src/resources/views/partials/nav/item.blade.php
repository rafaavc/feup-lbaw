<li class="{{ (isset($dropdown) && $dropdown ? '' : 'nav-item') . (Auth::check() ? ' logged-in-icon' : '') }}">
    <a class="{{ isset($dropdown) && $dropdown ? 'dropdown-item' : 'nav-link' }}" href="{{ $link }}">
        @include('partials.nav.icontext', [ 'icon' => $icon, 'profileImage' =>  (isset($profileImage) ? $profileImage : ''), 'text' => $name ])
    </a>
</li>
