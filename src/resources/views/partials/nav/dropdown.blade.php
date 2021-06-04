<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @include('partials.nav.icontext', ['icon' => $icon, 'text' => $name, 'caret' => true])
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
        @foreach ($submenu as $name => $attributes)
            @include('partials.nav.item', ['name' => ucwords($name), 'icon' => $attributes["icon"], 'profileImage' =>  (isset($profileImage) ? $profileImage : ''), 'link' => $attributes["href"], 'dropdown' => true])
        @endforeach
    </ul>
</li>
