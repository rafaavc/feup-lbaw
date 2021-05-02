@php
    $showRatingCount = !isset($showRatingCount) || $showRatingCount == true;
@endphp
<span class="small me-2">
    @if($score == 0)
        {{ $showRatingCount ? 'No ratings' : '' }}
    @else
        {{ round($score, 1) }} {{ $showRatingCount ? ('(' . $num_rating . ' ' . ($num_rating == 1 ? 'review' : 'reviews')) . ')' : '' }}
    @endif
</span>
@php
    $rounded = round($score);
@endphp
@for($i = 0; $i < 5; $i++)
    <i class="fas fa-star{{ $i < $rounded ? " active" : "" }}"></i>
@endfor
