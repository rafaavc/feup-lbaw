<div class="search-card">
    <a type="button" href="{{ url('recipe/'.$id) }}" class="btn card shadow-sm p-2 mx-auto">
        <div class="card-img-top" style="background-image: url('{{ $image }}')"></div>
        <div class="card-body m-0">
            <h4 class="card-title">{{ $name }}</h4>
            <p class="text-muted m-0" style="font-size: .8rem">{{ $score }}
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i> | {{ $nReviews }} reviews</p>
            <p class="card-text mt-2">by {{ $owner }}</p>
        </div>
    </a>
</div>
