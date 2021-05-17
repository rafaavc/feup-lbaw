<tr>
    <td>{{ $user->username }}</td>
    <td>{{ $user->name }}</td>
    <td colspan="3">{{ $user->email }}m</td>
    <td>{{ $user->country->abbreviation }}</td>
    <td>{{ $user->city }}</td>
    <td>{{ $user->number_of_posted_recipes }}</td>
    <td>{{ $user->number_of_posted_comments }}</td>
    <td>{{ $user->number_of_reports }}</td>
    <td colspan="3">
        <button type="button" class="btn btn-secondary me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View user profile"><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-warning text-white me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ban user"><i class="fas fa-ban"></i></button>
        <button type="button" class="btn btn-danger has-tooltip my-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete user permanently"><i class="fas fa-trash"></i></button>
    </td>
</tr>
