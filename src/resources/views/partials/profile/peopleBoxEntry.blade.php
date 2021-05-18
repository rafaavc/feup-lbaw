<div class="col">
    <a class="btn small-profile-photo has-tooltip"
       href="{{url("/user/$person->username")}}"
       style="background-image: url('{{ $person->profileImage() }}')"
       data-bs-container="body" data-bs-toggle="tooltip" data-bs-placement="bottom"
       title="{{$person->name}}"
    ></a>
</div>
