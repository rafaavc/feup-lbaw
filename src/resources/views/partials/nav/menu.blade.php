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
        // Follow Requests Notifications
        $followRequests = array();
        $userRequests = Illuminate\Support\Facades\DB::table('tb_following')->where('id_followed', Auth::user()->id)->where('state', '!=', 'rejected')->orderByDesc('timestamp')->get();
        foreach ($userRequests as $request) {
            $userFollowing = App\Models\Member::find($request->id_following);
            array_push($followRequests, ['type' => 'followRequest', 'username' => $userFollowing->username, 'id' => $userFollowing->id, 'state' => $request->state, 'timestamp' => $request->timestamp]);
        }

        // Favourites Notifications
        $favouritesNotifications = array();
        $userRecipeIds = Auth::user()->recipes()->get(['id'])->map(function($model) {
            return $model->id;
        })->toArray();

        $favourites = Illuminate\Support\Facades\DB::table('tb_favourite_notification')
            ->whereIn('id_recipe', $userRecipeIds)
            ->where('id_caused_by', '!=', Auth::user()->id)
            ->orderByDesc('timestamp')
            ->get();

        foreach ($favourites as $notification) {
            $userWhoFavourited = App\Models\Member::find($notification->id_caused_by);
            $recipe = App\Models\Recipe::find($notification->id_recipe);
            array_push($favouritesNotifications, ['type' => 'favouriteNotification', 'recipeId' => $recipe->id, 'username' => $userWhoFavourited->username, 'id' => $userWhoFavourited->id, 'recipeName' => $recipe->name, 'timestamp' => $notification->timestamp]);
        }

        // Comment/Review
        $commentNotifications = array();
        $userRecipeComments = App\Models\Comment::whereIn('id_recipe', $userRecipeIds)
            ->where('id_member', '!=', Auth::user()->id)
            ->orderByDesc('post_time')
            ->get();

        foreach ($userRecipeComments as $comment) {
            $userWhoCommented = App\Models\Member::find($comment->id_member);
            $recipe = App\Models\Recipe::find($comment->id_recipe);
            array_push($commentNotifications, ['type' => 'commentNotification', 'recipeId' => $recipe->id, 'rating' => $comment->rating, 'username' => $userWhoCommented->username, 'id' => $userWhoCommented->id, 'recipeName' => $recipe->name, 'timestamp' => $comment->post_time]);
        }

        // Delete recipe
        $deleteNotifications = array();
        $userDeleteNotifications = Illuminate\Support\Facades\DB::table('tb_delete_notification')->where('id_receiver', Auth::user()->id)->orderByDesc('timestamp')->get();

        foreach ($userDeleteNotifications as $notification) {
            array_push($deleteNotifications, ['type' => 'deleteNotification', 'recipeName' => $notification->name_recipe, 'timestamp' => $notification->timestamp]);
        }

        $allNotifications = array_merge($followRequests, $favouritesNotifications, $commentNotifications, $deleteNotifications);
        $allNotifications = collect($allNotifications)->sortByDesc('timestamp')->all();
        // var_dump($allNotifications);

        $menu = [
            "Feed" => [
                "icon" => "comments",
                "href" => url("/feed")
            ],
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
            @include('partials.nav.notificationspopover', ['allNotifications' => $allNotifications])
        @elseif ($name == "messages")
            @include('partials.nav.messagespopover')
        @endif
    @elseif (key_exists("drop", $attributes))
        @include('partials.nav.dropdown', ['name' => ucwords($name), 'icon' => $attributes["icon"], 'profileImage' => $attributes["profileImage"], 'submenu' => $attributes["drop"]])
    @else
        @include('partials.nav.item', ['name' => ucwords($name), 'icon' => $attributes["icon"], 'link' => $attributes["href"], 'dropdown' => false])
    @endif
@endforeach

