<div class="rating-input">
    @for ($i = 1; $i <= 5; $i++)
        <span onmouseover="starmark(this)" onclick="starmark(this)" id="{{ $i }}one" class="fas fa-star rating-input-star"></span>
    @endfor
</div>
