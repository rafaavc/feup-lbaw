<tr {{ $user->is_banned ? "style=background-color:var(--bs-red);" : '' }}>
    <td style="word-wrap: break-word; width: 12.5%; padding-right: 0.5em;">{{ $user->username }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 12.5%; padding-right: 0.5em;">{{ $user->name }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 20%; padding-right: 0.5em;">{{ $user->email }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 10%; padding-right: 0.5em;">{{ $user->country->name }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 10%; padding-right: 0.5em;">{{ $user->city }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 5%; padding-right: 0.5em;">{{ $user->number_of_posted_recipes }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 5%; padding-right: 0.25em;">{{ $user->number_of_posted_comments }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 5%; padding-right: 0.25em;">{{ $user->number_of_reports }}</td>
    <td style="word-wrap: break-word; padding: 0; width: 20%;" class="text-center">
        <a href="{{ url('user/' . $user->username ) }}"><button type="button" class="user-action btn btn-secondary me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View user profile"><i class="fas fa-eye"></i></button></a>
        @if($user->is_banned)
            <button type="button" data-ban="false" class="user-action user-ban btn btn-success text-white me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ban user"><i class="fas fa-undo"></i></button>
        @else
            <button type="button" data-ban="true" class="user-action user-ban btn btn-warning text-white me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ban user"><i class="fas fa-ban"></i></button>
        @endif
        <button type="button" class="user-action btn btn-danger has-tooltip me-2 my-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete user permanently"><i class="fas fa-trash"></i></button>
    </td>
</tr>
