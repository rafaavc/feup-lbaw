<div class="search-card">
    <a type="button" href="{{ url('/') }}" class="btn card shadow-sm p-2">
        <img class="card-img-top" src="{{ asset('storage/images/groups/' . $group->id . '.jpg') }}">
        <div class="card-body">
            <h4 class="card-title mt-3">{{ $group->name }}</h4>
            <p class="text-muted m-0 card-info"><span class="info-number">237</span> recipes</p>
            <p class="text-muted m-0 mt-1 card-info"><span class="info-number">57</span>  members</p>
        </div>
    </a>
</div>
