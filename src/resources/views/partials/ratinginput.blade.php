<div class="rating-input" style="{{ $hasMadeReview ? 'display: none;' : '' }}">
    <span id="ratingInputCancel" class="fas fa-times"></span>
    @for ($i = 1; $i <= 5; $i++)
        <span id="{{ $i }}ratingInputStar" class="fas fa-star rating-input-star"></span>
    @endfor
    <input type="hidden" value="0" name="rating" />
</div>
