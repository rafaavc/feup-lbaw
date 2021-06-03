@php
    $numNotifications = count($allNotifications) > 0 ? count($allNotifications) : 0;
    $firstNumberNotifications = $numNotifications;
    $numNotifications -= $numAlreadyFollowedNotifications;
    $numNotifications -= $numAlreadyReadNotifications;

@endphp
<li class="nav-item">
    <button id="showPopOver" data-popover-content="#notificationsPopupContent" class="btn btn-primary btn-sm mt-2 me-4 nav-popover position-relative d-none d-lg-block" role="button" data-bs-placement="bottom" data-bs-toggle="popover">
        <i class="fas fa-bell"></i>
        <div class="notif-quantity-indicator"><small>{{ $numNotifications }}</small></div>
    </button>
    <button type="button" id="mobile-notificationPopUp" class="btn no-btn nav-link d-block d-lg-none position-relative" data-bs-toggle="collapse" aria-expanded="false" aria-controls="notificationsPopupContent" data-bs-target="#notificationsPopupContent">
        @include('partials.nav.icontext', ['icon' => 'bell', 'text' => 'notifications' ])
        <div class="notif-quantity-indicator-mobile"><small> {{ $numNotifications }}</small></div>
    </button>
    <div id="notificationsPopupContent" class="collapse p-2 d-lg-none" style="min-height: 5rem; max-height: 20rem; overflow-x: hidden;">
        @if($firstNumberNotifications > 0)
            @foreach ($allNotifications as $notification)
                @if($notification['type'] == 'followRequest')
                    @include('partials.nav.followInfo', ['username' => $notification['username'], 'id' => $notification['id'], 'state' => $notification['state']])
                @elseif($notification['type'] == 'favouriteNotification')
                    @include('partials.nav.notificationInfo', ['userId' => $notification['userId'],'read' => $notification['read'],'recipeId' => $notification['recipeId'], 'type' => $notification['type'], 'username' => $notification['username'], 'id' => $notification['id'], 'recipeName' => $notification['recipeName']])
                @elseif($notification['type'] == 'commentNotification')
                    @include('partials.nav.notificationInfo', ['userId' => $notification['userId'], 'read' => $notification['read'], 'rating' => $notification['rating'], 'recipeId' => $notification['recipeId'], 'type' => $notification['type'], 'username' => $notification['username'], 'id' => $notification['id'], 'recipeName' => $notification['recipeName']])
                @elseif($notification['type'] == 'deleteNotification')
                    @include('partials.nav.notificationInfo', ['read' => $notification['read'], 'type' => $notification['type'], 'recipeName' => $notification['recipeName'], 'id' => $notification['id']])
                @endif
            @endforeach
        @else
            <div style="display: flex; align-items: center; height: 5rem;">
                <b>You don't have any notifications.</b>
            </div>
        @endif
    </div>
</li>
