<!-- rating.js file -->
<script src="../scripts/rating.js"></script>

<div class="rating-input">
    <?php
    for ($i = 1; $i <= 5; $i++) { ?>
        <span onmouseover="starmark(this)" onclick="starmark(this)" id="<?= $i ?>one" class="fas fa-star rating-input-star"></span>
    <?php } ?>
</div>