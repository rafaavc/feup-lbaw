<div class="search-card">
    <a type="button" href="{{ url('/group/' . $group->id) }}" class="btn card shadow-sm p-2">
        @if (file_exists(storage_path('app/public/images/groups/profile/' . $group->id . '.jpg')))
            <img class="card-img-top" src="{{ asset('storage/images/groups/profile/' . $group->id . '.jpg') }}">
        @else
            <img class="card-img-top" src="{{ asset('storage/images/groups/no_image.jpg') }}">
        @endif
        <div class="card-body">
            <h4 class="card-title mt-3">{{ $group->name }}</h4>
            <p class="text-muted m-0 card-info"><span class="info-number">{{ $group->recipes->count() }}</span> recipes</p>
            <p class="text-muted m-0 mt-1 card-info"><span class="info-number">{{ $group->members->count() }}</span>  members</p>
        </div>
    </a>
</div>
