<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="recipe.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    <script src="../scripts/recipeYields.js" defer></script>

    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

    <!-- Components CSS -->
    <link href="../components/nav.css" rel="stylesheet">
    <link href="../components/breadcrumb.css" rel="stylesheet">
    <link href="../components/textareaWithButton.css" rel="stylesheet">
</head>

<?php

$recipe = [
    "name" => "Classic Tiramisu",
    "ingredients" => [
        "egg yolks" => "<span class=\"number\">6</span>",
        "white sugar" => "<span class=\"number\">1.25</span> cups",
        "mascarpone cheese" => "<span class=\"number\">1.25</span> cups",
        "heavy whipping cream" => "<span class=\"number\">1.75</span> cups",
        "coffee flavored liqueur" => "<span class=\"number\">0.33</span> cup",
        "ladyfingers" => "<span class=\"number\">12</span> ounce",
        "unsweetened cocoa powder" => "<span class=\"number\">1</span> teaspoon",
        "square semisweet chocolate" => "<span class=\"number\">1</span> ounce",
    ],
    "method" => [
        "Step 1" => "Combine egg yolks and sugar in the top of a double boiler, over boiling water. Reduce heat to low, and cook for about 10 minutes, stirring constantly. Remove from heat and whip yolks until thick and lemon colored.",
        "Step 2" => "Add mascarpone to whipped yolks. Beat until combined. In a separate bowl, whip cream to stiff peaks. Gently fold into yolk mixture and set aside.",
        "Step 3" => "Split the lady fingers in half, and line the bottom and sides of a large glass bowl. Brush with coffee liqueur. Spoon half of the cream filling over the lady fingers. Repeat ladyfingers, coffee liqueur and filling layers. Garnish with cocoa and chocolate curls. Refrigerate several hours or overnight.",
        "Step 4" => "To make the chocolate curls, use a vegetable peeler and run it down the edge of the chocolate bar."
    ],
    "comments" => [
        [
            "user" => "The Master Critic of Foods",
            "comment" => "Needs more salt!",
            "rate" => 3,
            "post" => "2 days ago",
            "edit" => "3 mins ago",
            "replies" => [
                [
                    "user" => "High Cholesterol Man",
                    "comment" => "I think it has more salt than needed.",
                    "post" => "2 hours ago",
                    "replies" => [
                        [
                            "user" => "The Master Critic of Foods",
                            "comment" => "How dare you question the Master Critic! I know better!",
                            "post" => "now"
                        ]
                    ]
                ]
            ]
        ],
        [
            "user" => "The Food Lover",
            "comment" => "I loved it!",
            "post" => "5 days ago",
        ]
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
            $i % 3 != 0 ? "https://www.thespruceeats.com/thmb/OCytFbckS2guE73MmUTAGLw6D9k=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/cubes-of-tofu-168621031-588670e23df78c2ccdef8c7d.jpg" : null
        );
    }
}

function printComment($comment, $subcomment = false)
{ ?>
    <div class="card comment <?= $subcomment ? "subcomment" : "" ?>">
        <div class=" row g-0 p-3 d-flex">
            <img class="d-none d-md-inline-block rounded-circle" src="../images/people/<?= $comment["user"] ?>.jpg" alt="...">
            <div class="col-md-9 card-body">
                <h5 class="card-title"><a href="#"><?= $comment["user"] ?></a> <?= key_exists("rate", $comment) ? "reviewed" : "commented" ?>:</h5>
                <?php if (key_exists("rate", $comment)) { ?>
                    <div class="rating">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                <?php } ?>
                <p class="card-text"><?= $comment["comment"] ?></p>
                <p class="card-text">
                    <small class="text-muted">
                        <?= key_exists("edit", $comment) ? "Edited " . $comment["edit"] : $comment["post"] ?>
                    </small>
                </p>
            </div>
        </div>
        <?php if (key_exists("replies", $comment)) printComment($comment["replies"][0], true) ?>
    </div>
<?php }

?>

<body>
    <?php
    include "../components/nav.php";
    include "../components/breadcrumb.php";
    ?>
    <main class="row m-0">
        <article id="recipe" class="col-8">
            <header>
                <h1>Tiramisu</h1>
            </header>
            <section id="ingredients">
                <h2>Ingredients</h2>
                <table class="table table-striped p-3">
                    <?php
                    foreach ($recipe["ingredients"] as $ingredient => $quantity) { ?>
                        <tr>
                            <td class="quantity"><?= $quantity ?></td>
                            <td><?= $ingredient ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
            <section id="method">
                <h2>Method</h2>
                <?php printMethod($recipe["method"]);
                ?>
            </section>
            <section class="icon-box" id="comments">
                <i class="fas fa-comments"></i>
                <?php
                foreach ($recipe["comments"] as $i => $comment)
                    printComment($comment);
                include "../components/textareaWithButton.php";
                ?>
            </section>
        </article>
        <aside class="col-4">
            <div class="media">
                <img class="img-fluid main" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                <div class="small-img d-flex">
                    <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                    <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                    <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                    <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <section class="icon-box">
                        <i class="fas fa-clock"></i>
                        <table class="table table-borderless">
                            <tr>
                                <td>Duration</td>
                                <td>45 mins</td>
                            </tr>
                            <tr>
                                <td>Preparation</td>
                                <td>15 mins</td>
                            </tr>
                            <tr>
                                <td>Cooking</td>
                                <td>30 mins</td>
                            </tr>
                            <tr>
                                <td>Additional</td>
                                <td>-</td>
                            </tr>
                        </table>
                    </section>
                    <section class="icon-box">
                        <i class="fas fa-chart-bar"></i>
                        <form>
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <label for="yieldsInput" class="form-label">Yields</label>
                                    </td>
                                    <td>
                                        <span class="number">3</span> servings
                                    </td>
                                </tr>
                            </table>
                            <input type="range" class="form-range" min="1" max="10" id="yieldsInput" value="3">
                            <input type="reset" onclick="calculateQuantities()" value="Reset to 3 servings">
                        </form>
                    </section>
                </div>
                <div class="col-6">
                    <section class="icon-box">
                        <i class="fas fa-list"></i>
                        <table class="table table-borderless">
                            <tr>
                                <td>Energy</td>
                                <td>579 cal</td>
                            </tr>
                            <tr>
                                <td>Sugars</td>
                                <td>52.7 g</td>
                            </tr>
                            <tr>
                                <td>Fat</td>
                                <td>39.6 g</td>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>
        </aside>
    </main>
</body>