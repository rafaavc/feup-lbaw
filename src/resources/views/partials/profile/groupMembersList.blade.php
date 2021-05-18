@php
    $totalPerRequest = 10;
    $groupMembersCount = $group->members()->count();
    $groupMembers = $group->members()->skip($offset*$totalPerRequest)->take($totalPerRequest)->get();
@endphp

<table class="table text-center">
    <tbody>
      @include('partials.profile.groupMembersListContent')
    </tbody>
</table>

@if($groupMembersCount > $totalPerRequest)
    <div class="text-center">
        <button id="loadMoreMembersButton" data-group="{{ $group->id }}" data-offset="10" class="btn btn-outline-secondary">
            <small>
                <i class="fas fa-plus me-2"></i>
                Load more
            </small>
        </button>
    </div>
@endif

