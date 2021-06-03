@if(isset($profileImage) && $profileImage !== '' && Auth::user()->name === $text)
    <img class="rounded-circle" src="{{$profileImage}}" width="30px" height="30px">
@else
    <i class="fas fa-{{ $icon }} mx-2"></i>
@endif
<span class="legend">&nbsp;{{ $text }}</span>
@if (isset($caret) && $caret)
    <i class="fas fa-caret-down"></i>
@endif
