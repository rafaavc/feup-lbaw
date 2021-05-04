@for($i = 1; $i < round($rating); ++$i)
    <i class="fas fa-star active"></i>
@endfor
@for($i = $rating; $i < 5; ++$i)
    <i class="fas fa-star"></i>
@endfor
