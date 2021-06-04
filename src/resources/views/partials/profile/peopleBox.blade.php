<div class="card shadow-sm people-box mt-4">
    <div class="card-body">
        <h5 class="card-title mb-4">{!! $name !!}</h5>
        <div class="row g-5 {{ isset($actions) ? "mb-5" : "mb-2" }}">
            @if (sizeof($people) == 0)
                <p class="mb-0">{{ $errorMessage ?? "No one was found." }}</p>
            @else
                @foreach($people as $person)
                    @include('partials.profile.peopleBoxEntry')
                @endforeach
            @endif
        </div>
        @if(isset($actions))
            {!! $actions !!}
        @endif
    </div>
</div>
