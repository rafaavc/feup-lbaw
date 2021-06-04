{{--

    Confirmation modal
    Receives: $modalId, $modalTitle, $modalMessage, $modalYesFunction, $modalYesText, $modalNoText?

--}}

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{!! $modalTitle !!}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $modalMessage !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $modalNoText }}</button>
                @if(isset($modalYesText))
                    <button type="button" {{ isset($modalYesId) ? 'id="'. $modalYesId . '"' : "" }} data-bs-dismiss="modal" class="btn btn-primary {{ $modalYesClass ?? "" }}" data-data="{{ $modalYesData ?? "" }}" onClick="{{ $modalYesFunction ?? "" }}">{{ $modalYesText }}</button>
                @endif
            </div>
        </div>
    </div>
</div>



