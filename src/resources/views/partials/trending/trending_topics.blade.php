@push('css')
    <link href="{{ asset('css/components/trending.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/trending.js') }}" defer></script>
@endpush

<div class="card shadow-sm people-box mb-5">
    <div class="card-body">
        <h5 class="card-title mb-4">Trending Categories</h5>
        <div class="container p-0 mb-3">
            @php
                $counter = 0;
            @endphp
            @foreach ($tags as $tag)
                <a class="{{'btn btn-sm btn' . (($counter++ > 2) ? '-outline' : '') . '-secondary d-inline-block me-3 mb-3'}}" href="{{ url('/tag/' . $tag->id) }}">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>
