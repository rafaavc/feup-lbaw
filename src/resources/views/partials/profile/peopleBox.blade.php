<div class="card shadow-sm people-box">
    <div class="card-body">
        <h5 class="card-title mb-4">{{$name}}</h5>
        <div class="row g-5 mb-5">
            @foreach($people as $person)
                <div class="col">
                    <a class="btn small-profile-photo has-tooltip"
                       href="{{url("/user/$person->username")}}"
                       style="background-image: url('{{ $person->profileImage() }}')"
                       data-bs-container="body" data-bs-toggle="tooltip" data-bs-placement="bottom"
                       title="{{$person->name}}
                       @if(isset($groupModerator) && $groupModerator)
                           <button class='btn btn-danger btn-sm has-tooltip ms-3'
                                   data-bs-toggle='tooltip'
                                   data-bs-placement='bottom' title='Remove user from group'>
                                   <i class='fas fa-trash'></i>
                           </button>
                       @endif"
                    ></a>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-outline-secondary">
            <small><i class="fas fa-plus me-2"></i> See all <?= strtolower($name) ?></small>
        </button>
    </div>
</div>
