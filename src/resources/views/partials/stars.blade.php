@for($i = 0; $i < round($rating); ++$i)
    <i class="fas fa-star active"></i>
@endfor
@for($i = round($rating); $i < 5; ++$i)
    <i class="fas fa-star"></i>
@endfor
