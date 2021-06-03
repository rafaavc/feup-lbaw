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
@endphp

@if(Auth::guard('admin')->check())
    @php
        $menu = [
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
                "drop" => $adminDropdown,
                "profileImage" => ""
            ]
        ];
    @endphp
@elseif(Auth::check())
    @php
        $followRequests = array();
        $userRequests = Illuminate\Support\Facades\DB::table('tb_following')->where('id_followed', Auth::user()->id)->where('state', '!=', 'rejected')->orderByDesc('timestamp')->get();
        foreach ($userRequests as $request) {
            $userFollowing = App\Models\Member::find($request->id_following);
            array_push($followRequests, ['username' => $userFollowing->username, 'id' => $userFollowing->id, 'state' => $request->state]);
        }
        $menu = [
            "notifications" => [
                "icon" => "bell",
                "popover" => $followRequests
            ],
            "messages" => [
                "icon" => "comments",
                "popover" => "This is the content of the second popover"
            ],
            Auth::user()->name => [
                "icon" => "user-circle",
                "drop" => $dropdown,
                "profileImage" => Auth::user()->profileImage()
            ]
        ];
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
            @include('partials.nav.notificationspopover', ['followRequests' => $followRequests])
        @elseif ($name == "messages")
            @include('partials.nav.messagespopover')
        @endif
    @elseif (key_exists("drop", $attributes))
        @include('partials.nav.dropdown', ['name' => ucwords($name), 'icon' => $attributes["icon"], 'profileImage' => $attributes["profileImage"], 'submenu' => $attributes["drop"]])
    @else
        @include('partials.nav.item', ['name' => ucwords($name), 'icon' => $attributes["icon"], 'link' => $attributes["href"], 'dropdown' => false])
    @endif
@endforeach

