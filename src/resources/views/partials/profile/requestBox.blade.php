@push('js')
<script src="{{ asset('js/group.js') }}" type="module"></script>
@endpush

<div id="memberRequests" class="card shadow-sm people-box mt-4">
    <div class="card-body m-0">
        <h5 class="card-title mb-4">Member Requests</h5>

        <ul class="p-0 m-0">
            @foreach($requests as $request)
                <li class="card p-2 mb-2">
                    <div class="row g-3">
                        <div class="col-2" style="max-width: 3.5rem">
                            <div class="small-profile-photo"
                                 style="background-image: url('{{$request->profileImage()}}')"></div>
                        </div>
                        <div class="col-9">
                            @if($new)
                                <div class="row g-4">
                                    <div class="col-8">
                                        @endif
                                        <p class="m-0">
                                            @if($new)
                                                <strong>
                                                    @endif
                                                    {{$request->name}}
                                                    @if($new)
                                                        wants to join the group
                                                </strong>
                                            @endif
                                        </p>
                                        @if($new)
                                    </div>
                                    <div class="col-1">
                                        <button data-group="{{$group->id}}" data-member="{{$request->username}}" class="btn btn-outline-secondary follow-request-button group-request-accept">
                                            <small>
                                                <i class="fas fa-check"></i>
                                            </small>
                                        </button>
                                        <button data-group="{{$group->id}}" data-member="{{$request->username}}" class="btn btn-outline-secondary follow-request-button group-request-reject">
                                            <small>
                                                <i class="fas fa-times"></i>
                                            </small>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
