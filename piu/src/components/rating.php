
<!-- rating.js file -->
<script src="../scripts/rating.js"></script>

<div class="rating">
    <?php 
    for ($i = 1; $i <= 5; $i++) { ?>
        <span onmouseover="starmark(this)" onclick="starmark(this)" id="<?=$i?>one" class="fa fa-star"></span>
    <?php } ?>
    <button onclick="result()" type="button" class="btn btn-lg btn-primary mx-4">Submit</button>
</div>

