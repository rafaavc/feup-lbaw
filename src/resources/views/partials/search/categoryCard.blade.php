<div class="search-card">
    <a type="button" href="{{ url('/') }}" class="btn card shadow-sm p-2">
        <img class="card-img-top" src="{{ asset('storage/images/categories/' . $category->id . '.jpg') }}" alt="Image of the category {{$category->name}}">
        <div class="card-body">
            <h4 class="card-title mt-3">{{ $category->name }}</h4>
            <p class="text-muted m-0 card-info"><span class="info-number">{{ \App\Models\Category::find($category->id)->getNumRecipes() }}</span> recipes</p>
        </div>
    </a>
</div>
