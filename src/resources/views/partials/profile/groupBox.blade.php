<div class="card shadow-sm people-box mt-4">
    <div class="card-body">
        <h5 class="card-title mb-4">Groups</h5>
        <div class="g-5 {{ sizeof($groups) > 0 ? "mb-3" : "mb-2" }}">
            @if(sizeof($groups) > 0)
                @foreach($groups as $group)
                    <div class="btn group-box-link" onclick="window.location='{{url("group/$group->id")}}'">
                        <button style="background-image: url({{$group->profileImage()}})"
                                class="btn small-profile-photo small-group-photo d-inline"></button>
                        <span class="name">{{$group->name}}</span>
                    </div>
                @endforeach
            @else
                No groups found.
            @endif
        </div>
    </div>
</div>
