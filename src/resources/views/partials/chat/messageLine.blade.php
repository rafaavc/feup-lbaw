@if (1 == 1)
    <div class="row g-3 message-line mt-3">
        {{-- CHANGED --}}
        <div class="col-2" style="width: 4.5rem;">
            <div class="small-profile-photo" style="background-image: {{ url('/') }}"></div>
            {{-- CHANGED --}}
        </div>
        <div class="col-6">
            <p class="m-0 bg-secondary message-line-content">{{ $message }}</p>
        </div>

    </div>
@else
    <div class="message-line mt-3">
    {{-- CHANGED --}}
        <p class="m-0 message-line-content message-own bg-primary">{{ $message }}</p>
    </div>
@endif
