<?php

$recipe = [
    "name" => "Classic Tiramisu",
    "method" => [
        "Step 1" => "Combine egg yolks and sugar in the top of a double boiler, over boiling water. Reduce heat to low, and cook for about 10 minutes, stirring constantly. Remove from heat and whip yolks until thick and lemon colored.",
        "Step 2" => "Add mascarpone to whipped yolks. Beat until combined. In a separate bowl, whip cream to stiff peaks. Gently fold into yolk mixture and set aside.",
        "Step 3" => "Split the lady fingers in half, and line the bottom and sides of a large glass bowl. Brush with coffee liqueur. Spoon half of the cream filling over the lady fingers. Repeat ladyfingers, coffee liqueur and filling layers. Garnish with cocoa and chocolate curls. Refrigerate several hours or overnight.",
        "Step 4" => "To make the chocolate curls, use a vegetable peeler and run it down the edge of the chocolate bar."
    ]
];

function printInstruction($number, $name, $text, $image = null)
{ ?>
    <section class="instruction d-inline-block col-12">
        <h3 class="btn" data-bs-toggle="collapse" href="#instruction<?= $number ?>" role="button" aria-expanded="false" aria-controls="instruction<?= $number ?>">
            <i class="fas fa-check-circle d-inline-block align-middle"></i>
            <span class="d-inline-block align-middle"><?= $number ?>. <?= $name ?></span>
        </h3>
        <div class="collapse show" id="instruction<?= $number ?>">
            <div class="d-flex">
                <div class="col-<?= $image === null ? "12" : "8" ?> card card-body d-inline-block">
                    <?= $text ?>
                </div>
                <?php if ($image !== null) { ?>
                    <img class="col-3 d-inline-block" src="<?= $image ?>">
                <?php } ?>
            </div>
        </div>
    </section>
<?php }

function printMethod($method)
{
    $i = 1;
    foreach ($method as $name => $text) {
        printInstruction(
            $i++,
            $name,
            $text,
            $i % 2 == 0 ? "https://www.thespruceeats.com/thmb/OCytFbckS2guE73MmUTAGLw6D9k=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/cubes-of-tofu-168621031-588670e23df78c2ccdef8c7d.jpg" : null
        );
    }
}

?>

<div id="method" class="col-8">
    <h2>Method</h2>
    <?php printMethod($recipe["method"]); ?>
</div>