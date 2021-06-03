<ul class="p-0 m-0" data-follow="follow-{{ $id }}">
    <li class="card p-2 mb-2">
        <div class="row g-5">
            <div class="col-2" style="text-align: left; display: flex; align-items: center;">
                <a style="text-decoration: none;" href="{{ url('user/' . $username) }} ">
                    <div class="small-profile-photo" style="background-image: url(' {{ asset('storage/images/people/' . $id . '.jpeg') }} '), url(' {{ asset('storage/images/people/no_image.png') }} ')"></div>
                </a>
            </div>
            <div class="col-9">
                <div class="row g-2">
                    <div class="col-11" style="text-align: left; display: flex; justify-content: center; align-items: center;">
                        <p class="m-0">
                            @if($state == 'pending')
                                <strong><a style="text-decoration: none;" href="{{ url('user/' . $username) }} ">{{ $username }}</a> {{ "wants to follow you." }}</strong>
                            @else
                                <a style="text-decoration: none; font-weight: bold;" href="{{ url('user/' . $username) }} ">{{ $username }}</a> {{ "started following you." }}
                            @endif
                        </p>
                    </div>
                    @if($state == 'pending')
                        <div class="col-1">
                            <button class="btn btn-outline-secondary follow-request-button"  data-toggle="popover" data-state="accept"><small><i class="fas fa-check"></i></small></button>
                            <button class="btn btn-outline-secondary follow-request-button"  data-toggle="popover" data-state="decline"><small><i class="fas fa-times"></i></small></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </li>
</ul>
