<ul class="p-0 m-0">
    <li class="card p-2 mb-2">
        <div class="row g-5">
            <div class="col-2">
                <div class="small-profile-photo" style="background-image: url(' {{ asset('storage/images/people/' . $id . '.jpeg') }} ')"></div>
            </div>
            <div class="col-9">
                <div class="row g-2">
                    <div class="col-11">
                        <p class="m-0">
                            @if($state == 'pending')
                                <strong>{{ $name }} {{ "wants to follow you." }}</strong>
                            @else
                                {{ $name }} {{ "started following you." }}
                            @endif
                        </p>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-outline-secondary follow-request-button"  data-toggle="popover"><small><i class="fas fa-check"></i></small></button>
                        <button class="btn btn-outline-secondary follow-request-button"  data-toggle="popover"><small><i class="fas fa-times"></i></small></button>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
