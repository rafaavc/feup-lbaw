<div class="d-flex mb-3">
    <i class='fas fa-{{$icon}} fa-icon-left'></i>
    <input {{ isset($pattern) ? 'pattern='.$pattern : '' }} {{ isset($minlength) ? 'minlength='.$minlength : '' }} {{ isset($maxlength) ? 'maxlength='.$maxlength : '' }} title="{{ $title ?? '' }}" type="{{$type ?? "text"}}" name="{{$name}}" class="form-control icon-left me-2"
           aria-label="Recipient's username"
           aria-describedby="basic-addon2" {{isset($required) ? "required" : ""}}
           {{ isset($value) ? "value='" . $value . "'" : "" }}>
</div>
