<span class="small me-2">
    @if($score == 0)
        No ratings
    @else
        {{ round($score, 1) }} ({{ $num_rating }} {{$num_rating == 1 ? 'rating' : 'ratings'}})
    @endif
</span>
@php
    $rounded = round($score);
@endphp
@for($i = 0; $i < 5; $i++)
    <i class="fas fa-star{{ $i < $rounded ? " active" : "" }}"></i>
@endfor
