@if(isset($profileImage) && $profileImage !== '' && Auth::user()->name === $text)
    <img class="rounded-circle" style="object-fit: cover;" src="{{$profileImage}}" width="30px" height="30px">
@else
    <i class="fas fa-{{ $icon }} mx-2"></i>
@endif
@if(isset($text) && strlen($text) > 0)
    <span class="legend">&nbsp;{{ $text }}</span>
@endif
@if (isset($caret) && $caret)
    <i class="fas fa-caret-down"></i>
@endif
