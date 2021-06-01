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
            <a role="button" class="btn btn-sm btn-secondary d-inline-block me-3 mb-3" href="{{ url('/category/1') }}">
                Vegetarian
            </a>
            <a role="button" class="btn btn-sm btn-secondary d-inline-block me-3 mb-3" href="{{ url('/category/1') }}">
                Low carb
            </a>
            <a role="button" class="btn btn-sm btn-secondary d-inline-block me-3 mb-3" href="{{ url('/category/1') }}">
                Keto diet
            </a>
            <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="{{ url('/category/1') }}">
                Vegan
            </a>
            <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="{{ url('/category/1') }}">
                Traditional Portuguese
            </a>
            <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="{{ url('/category/1') }}">
                Italian
            </a>
            <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="{{ url('/category/1') }}">
                Ice Cream
            </a>
        </div>
    </div>
</div>
