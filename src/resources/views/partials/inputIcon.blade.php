@php
    function getIcon($iconName, $direction = "left") : string {
           return $direction === "left"
               ? "<i class='fas fa-$iconName fa-icon-left'></i>"
               : "<i class='fas fa-$iconName fa-icon-right'></i>";
    }
@endphp

<div class="d-flex mb-3">
    @php
        getIcon($icon, "left");
    @endphp
    <input type="text" class="form-control icon-left me-2" aria-label="Recipient's username"
           aria-describedby="basic-addon2">
</div>
