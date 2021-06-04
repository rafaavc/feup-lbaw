<div class="search-card mx-auto">
    <a type="button" href="{{ url('recipe/'.$id) }}" class="btn card shadow-sm p-2 mx-auto">
        <img class="card-img-top" src="{{ $image }}" alt="main image of recipe">
        <div class="card-body m-0">
            <h4 class="card-title">{{ $name }}</h4>
            <p class="text-muted m-0" style="font-size: .8rem">
                @include('partials.rating', ['score' => $score, 'num_rating' => $num_rating ])
            </p>
            <p class="card-text mt-2">by {{ $owner }}</p>
        </div>
    </a>
</div>
