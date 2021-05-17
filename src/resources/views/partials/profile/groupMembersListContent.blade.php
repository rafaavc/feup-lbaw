@foreach($groupMembers as $member)
    <tr>
        <td>
            <a class="btn small-profile-photo"
                href="{{url("/user/$member->username")}}"
                style="background-image: url('{{ $member->profileImage() }}')"
            ></a>
        </td>
        <td>
            <a href="{{url("/user/$member->username")}}">
                {{ $member->name }}
            </a>
        </td>
        @if(Gate::inspect('update', $group)->allowed() && $member->id != Auth::user()->id)
            <td>
                <button class='btn btn-danger btn-sm has-tooltip ms-3 remove-group-member-button'
                   data-member='{{ $member->username }}' data-group='{{$group->id}}'>
                   <i class='fas fa-trash'></i>
                </button>
            </td>
        @else
            <td></td>
        @endif
    </tr>
@endforeach
