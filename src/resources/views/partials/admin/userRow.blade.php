<tr>
    <td style="width: 10%; padding-right: 0.5em;">{{ $user->username }}</td>
    <td style="padding: 0; width: 10%; padding-right: 0.5em;"">{{ $user->name }}</td>
    <td style="padding: 0; width: 20%; padding-right: 0.5em;">{{ $user->email }}m</td>
    <td style="padding: 0; width: 10%; padding-right: 0.5em;">{{ $user->country->name }}</td>
    <td style="padding: 0; width: 5%; padding-right: 0.5em;">{{ $user->city }}</td>
    <td style="padding: 0; width: 7.5%; padding-right: 0.5em;">{{ $user->number_of_posted_recipes }}</td>
    <td style="padding: 0; width: 7.5%; padding-right: 0.25em;">{{ $user->number_of_posted_comments }}</td>
    <td style="padding: 0; width: 7.5%; padding-right: 0.25em;">{{ $user->number_of_reports }}</td>
    <td style="padding: 0; width: 20%;" class="text-center">
        <button type="button" class="user-action btn btn-secondary me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View user profile"><i class="fas fa-eye"></i></button>
        <button type="button" class="user-action btn btn-warning text-white me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ban user"><i class="fas fa-ban"></i></button>
        <button type="button" class="user-action btn btn-danger has-tooltip me-2 my-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete user permanently"><i class="fas fa-trash"></i></button>
    </td>
</tr>
