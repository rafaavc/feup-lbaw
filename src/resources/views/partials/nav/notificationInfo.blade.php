<ul class="p-0 m-0">
    <li class="card p-2 mb-2">
        <div class="row g-5">
            <div class="col-2" style="text-align: left; display: flex; align-items: center;">
                @if($notification['type'] != 'deleteNotification')
                    <a style="text-decoration: none;" href="{{ url('user/' . $username) }} ">
                        <div class="small-profile-photo" style="background-image: url(' {{ asset('storage/images/people/' . $userId . '.jpeg') }} '), url(' {{ asset('storage/images/people/no_image.png') }} ')"></div>
                    </a>
                @endif
            </div>
            <div class="col-9 {{ $notification['type'] == 'deleteNotification' ? "ps-0" : "" }} pe-0">
                <div class="row g-2">
                    <div class="col-11" style="text-align: left; display: flex; justify-content: center; align-items: center; ">
                        @if(!$read)
                            <input type="hidden"  data-notification-type="{{ $notification['type'] }}" data-notification-id="{{ $notification['id'] }}">
                        @endif
                        <p class="m-0">
                            @if($notification['type'] != 'deleteNotification')
                                <a style="text-decoration: none; font-weight: bold;" href="{{ url('user/' . $username) }} ">{{ $username }}</a>
                                @if($type == 'favouriteNotification')
                                    {{ "favourited" }}
                                    {{ $recipeName }}.
                                @elseif($type == 'commentNotification')
                                    {{ $rating ? "reviewed" : "commented" }}
                                    {{ $recipeName }}.
                                @endif
                            @else
                                {{ "Recipe "}} <b>{{ $recipeName }}</b> {{ "deleted by an administrator!" }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
