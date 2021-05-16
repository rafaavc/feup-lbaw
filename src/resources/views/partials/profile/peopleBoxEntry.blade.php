<div class="col">
    <a class="btn small-profile-photo has-tooltip"
       href="{{url("/user/$person->username")}}"
       style="background-image: url('{{ $person->profileImage() }}')"
       data-bs-container="body" data-bs-toggle="tooltip" data-bs-placement="bottom"
       title="{{$person->name}}
       @if(Gate::inspect('update', $group)->allowed())
           <button class='btn btn-danger btn-sm has-tooltip ms-3'
                   data-bs-toggle='tooltip'
                   data-bs-placement='bottom' title='Remove user from group'>
                   <i class='fas fa-trash'></i>
           </button>
       @endif"
    ></a>
</div>
