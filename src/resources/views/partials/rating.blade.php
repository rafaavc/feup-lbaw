@php
    $showRatingCount = !isset($showRatingCount) || $showRatingCount == true;
@endphp
<span class="small me-1">
    @if($score == 0)
        {{ 'No reviews' }}
    @else
        {{ round($score, 1) }}
    @endif
</span>
@php
    $rounded = round($score);
@endphp
@for($i = 0; $i < 5; $i++)
    <i class="fas fa-star{{ $i < $rounded ? " active" : "" }}"></i>
@endfor
@if($score != 0)
    <span class="small ms-2">
        {{ $showRatingCount ? ('(' . $num_rating . ' ' . ($num_rating == 1 ? 'review' : 'reviews')) . ')' : '' }}
    </span>
@endif
