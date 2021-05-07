<div class="search-card">
    <a type="button" href="{{ url('/recipe/' . $recipe->recipe_id) }}" class="btn card shadow-sm p-2 mx-auto h-100">
        <img class="card-img-top" src="{{ asset('storage/images/recipes/' . $recipe->recipe_id . '/1.jpg') }}">
        <h5 class="card-title">{{ $recipe->recipe_name }}</h5>
        @php
            $score = \App\Models\Recipe::find($recipe->recipe_id)->score;
        @endphp
        <div class="card-body w-100">
            <p class="text-muted m-0" style="font-size: .8rem">{{ round($score, 1) }}
                @for ($i = 1; $i <= 5; $i++)
                    @if($i <= floor($score))
                        <i class="fas fa-star active"></i>
                    @else
                        <i class="fas fa-star"></i>
                    @endif
                @endfor
                | {{ \App\Models\Recipe::find($recipe->recipe_id)->getNumReviews() }} reviews</p>
            <p class="card-text mt-2">by {{ $recipe->member_name }}</p>
        </div>
    </a>
</div>
