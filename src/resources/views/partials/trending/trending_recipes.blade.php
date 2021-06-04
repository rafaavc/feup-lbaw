<div class="card people-box shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-4">Trending Recipes</h5>
        <div class="container p-0 mb-3">
            @php
                $counter = 0;
            @endphp
            @foreach ($trendingRecipes as $trendingRecipe)
                <a class="{{'text-start btn btn-sm btn' . (($counter++ > 2) ? '-outline' : '') . '-secondary d-block mb-3'}}" href="{{ url('/recipe/' . $trendingRecipe->id) }}">
                    {{ $trendingRecipe->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>
