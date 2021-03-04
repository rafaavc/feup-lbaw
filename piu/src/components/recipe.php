<?php

$recipe = [
    "method" => [
        "Stir the tofu" => "Preheat a large, heavy skillet over medium-high heat. Add 2 tablespoons oil. Break tofu apart over skillet into bite-size pieces, sprinkle with salt and pepper, then cook, stirring frequently with a thin metal spatula, until liquid cooks out and tofu browns, about 10 minutes. (If you notice liquid collecting in pan, increase heat to evaporate water.) Be sure to get under the tofu when you stir, scraping the bottom of the pan where the good, crispy stuff is and keeping it from sticking.",
    ]
];

function printInstruction($number, $name, $text)
{ ?>
    <h3 class="btn" data-bs-toggle="collapse" href="#instruction<?= $number ?>" role="button" aria-expanded="false" aria-controls="instruction<?= $number ?>">
        <i class="fas fa-check-circle d-inline-block align-middle"></i>
        <span class="d-inline-block align-middle"><?= $number ?>. <?= $name ?></span>
    </h3>
    <div class="collapse show" id="instruction<?= $number ?>">
        <div class="card card-body">
            <?= $text ?>
        </div>
    </div>
<?php }

function printMethod($method)
{
    $i = 1;
    foreach ($method as $name => $text) {
        printInstruction($i++, $name, $text);
    }
}

?>

<h2>Method</h2>
<section class="instruction">
    <?php printMethod($recipe["method"]); ?>
</section>