<div id="peopleBox" class="card shadow-sm people-box mt-4">
    <div class="card-body">
        <h5 class="card-title mb-4">{!! $name !!}</h5>
        <div class="row g-5 mb-5">
            @foreach($people as $person)
                @include('partials.profile.peopleBoxEntry')
            @endforeach
        </div>
        @if(isset($actions))
            {!! $actions !!}
        @endif
    </div>
</div>
