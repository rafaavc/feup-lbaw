<div class="row notification-card g-5">
    <div class="col-3">
        <div class="small-profile-photo" style="background-image: {{ url('/') }}"></div>
        {{-- CHANGED --}}
    </div>
    <div class="col-9">
        <p><strong>{{ $name }}</strong></p>
        {{-- CHANGED --}}
        <p><small>{{ $message }}</small></p>
        {{-- CHANGED --}}
    </div>
</div>
