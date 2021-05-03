<i class="fas fa-{{ $icon }} mx-2"></i>
<span class="legend">{{ $text }}</span>
@if (isset($caret) && $caret)
    <i class="fas fa-caret-down"></i>
@endif
