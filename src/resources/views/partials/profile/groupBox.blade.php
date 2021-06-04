<div class="card shadow-sm people-box mt-4">
    <div class="card-body">
        <h5 class="card-title mb-4">Groups</h5>
        <div class="g-5 mb-5">
            @foreach($groups as $group)
                <a href="{{url("group/$group->id")}}" class="btn group-box-link">
                    <button style="background-image: url({{$group->profileImage()}})"
                            class="btn small-profile-photo small-group-photo d-inline"></button>
                    <span class="name">{{$group->name}}</span>
                </a>
            @endforeach
        </div>
        <!--<button type="button" class="btn btn-outline-secondary">
            <small><i class="fas fa-plus me-2"></i> See all groups</small>
        </button>-->
    </div>
</div>
