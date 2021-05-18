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
                <button class='btn btn-danger btn-sm has-tooltip ms-3 mb-2'
                    onClick="this.nextElementSibling.style.display='block'">
                    <i class='fas fa-trash'></i>
                </button>
                <div style="display: none;">
                    <p class="mb-2"><small>Are you sure you want<br/>to remove the member<br/>from the group?</small></p>
                    <button class="btn btn-sm btn-outline-secondary" onClick="this.parentElement.style.display='none'">
                        No
                    </button>
                    <button class="btn btn-sm btn-outline-danger remove-group-member-button"
                        data-member='{{ $member->username }}' data-group='{{$group->id}}'>
                        Yes
                    </button>
                </div>
            </td>
        @else
            <td></td>
        @endif
    </tr>
@endforeach
