@if(isset($profileImage) && $profileImage !== '' && strtolower(Auth::user()->name) == strtolower($text))
    <img class="rounded-circle" style="object-fit: cover;" src="{{$profileImage}}" width="30" height="30" alt="profile picture of user {{$text}}">
@else
    <i class="fas fa-{{ $icon }} mx-2"></i>
@endif
@if(isset($text) && strlen($text) > 0)
    <span class="legend">&nbsp;{{ $text }}</span>
@endif
@if (isset($caret) && $caret)
    <i class="fas fa-caret-down"></i>
@endif
