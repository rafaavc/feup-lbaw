@php
    $visitor = [
        "visitor feed" => [
            "icon" => "comments",
            "href" => url("/feed")
        ],
        "sign in" => [
            "icon" => "sign-in-alt",
            "href" => url("/login")
        ],
        "sign up" => [
            "special" => true,
            "icon" => "user-plus",
            "href" => url("/register")
        ]
    ];

    $dropdown = [
        "my profile" => [
            "icon" => "address-card",
            "href" => url("/user/".(Auth::check() ? Auth::user()->username : 'error'))
        ],
        "sign out" => [
            "icon" => "sign-out-alt",
            "href" => url("/logout")
        ]
    ];

    $adminDropdown = [
        "sign out" => [
            "icon" => "sign-out-alt",
            "href" => url("/logout")
        ]
    ];

    $loggedInName = Auth::check() ? Auth::user()->name : "nonexistant";

    $member = [
        "notifications" => [
            "icon" => "bell",
            "popover" => "This is the content of the first popover"
        ],
        "messages" => [
            "icon" => "comments",
            "popover" => "This is the content of the second popover"
        ],
        $loggedInName => [
            "icon" => "user-circle",
            "drop" => $dropdown
        ]
    ];

    $admin = [
        "reports" => [
            "icon" => "exclamation-triangle",
            "href" => url("/admin/reports")
        ],
        "users" => [
            "icon" => "users",
            "href" => url("/admin/users")
        ],
        Auth::guard('admin')->user()->username => [
            "icon" => "user-circle",
            "drop" => $adminDropdown
        ]
    ];
@endphp

@if(Auth::guard('admin')->check())
    @php
        $menu = $admin;
    @endphp
@elseif(Auth::check())
    @php
        $menu = $member;
    @endphp
@else
    @php
        $menu = $visitor;
    @endphp
@endif

@foreach($menu as $name => $attributes)
    @if (key_exists("special", $attributes))
        <li class="nav-item">
            <a role="button" href="{{ $attributes['href'] }}" class="btn btn-primary btn-sm mt-1 ms-2"><i
                    class="fas me-2 fa-{{ $attributes['icon'] }}"></i> {{ ucwords($name) }}</a>
        </li>
    @elseif (key_exists("popover", $attributes))
        @if ($name == "notifications")
            @include('partials.nav.notificationspopover')
        @elseif ($name == "messages")
            @include('partials.nav.messagespopover')
        @endif
    @elseif (key_exists("drop", $attributes))
        @include('partials.nav.dropdown', ['name' => ucwords($name), 'icon' => $attributes["icon"], 'submenu' => $attributes["drop"]])
    @else
        @include('partials.nav.item', ['name' => ucwords($name), 'icon' => $attributes["icon"], 'link' => $attributes["href"], 'dropdown' => false])
    @endif
@endforeach
