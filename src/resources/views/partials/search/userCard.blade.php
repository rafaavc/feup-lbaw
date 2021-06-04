<div class="search-card">
    <a type="button" href="{{ url('/user/'. $user->username) }}" class="btn card shadow-sm p-2">
        @if (file_exists(storage_path('app/public/images/people/' . $user->id . '.jpeg')))
            <img class="card-img-top" src="{{ asset('storage/images/people/' . $user->id . '.jpeg') }}" alt="profile picture of {{$user->name}}">
        @else
            <img class="card-img-top" src="{{ asset('storage/images/no_image.jpg') }}" alt="default profile picture of users">
        @endif
        <h5 class="card-title mt-2">{{ $user->name }}</h5>
        @php
            $score = \App\Models\Member::find($user->id)->score;
        @endphp
        <div class="card-body">
            <p class="text-muted m-0 mt-2" style="font-size: .8rem">{{ round($score, 1) }}
                @php
                    $score = floor($score);
                @endphp
                @for ($i = 1; $i <= 5; $i++)
                    @if($i <= $score)
                        <i class="fas fa-star active"></i>
                    @else
                        <i class="fas fa-star"></i>
                    @endif
                @endfor
                | <span class="info-number">{{ \App\Models\Member::find($user->id)->getNumberOfRecipesAttribute() }}</span> recipes
            </p>
        </div>
    </a>
</div>
