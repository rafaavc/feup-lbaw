<div class="search-card">
    <a type="button" href="{{ url('/user/'. $user->username) }}" class="btn card shadow-sm p-2">
        <img class="card-img-top" src="{{ asset('storage/images/people/' . $user->id . '.jpeg') }}">
        <h5 class="card-title mt-2">{{ $user->name }}</h5>
        <div class="card-body">
            <p class="text-muted m-0 mt-2" style="font-size: .8rem">{{ \App\Models\Member::find($user->id)->score }}
                @for ($i = 1; $i <= floor(\App\Models\Member::find($user->id)->score); $i++)
                    <i class="fas fa-star active"></i>
                @endfor
                | <span class="info-number">{{ \App\Models\Member::find($user->id)->getNumberOfRecipesAttribute() }}</span> recipes
            </p>
        </div>
    </a>
</div>
