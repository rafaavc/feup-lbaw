<?php

$extraStyles = ["recipe.css", "../components/search_results_cards.css", "../components/profile_cover.css", "../components/textareaWithButton.css", "../components/breadcrumb.css", "../components/rating.css"];

$extraScripts = ["../scripts/recipeYields.js"];

$pageTitle = "Classic Tiramisu | TasteBuds";
$role = "member";

include "../components/docHeader.php";
include "../components/search_results_cards.php";

$author = false;

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
        "Step 1" => [
            "text" => "Combine egg yolks and sugar in the top of a double boiler, over boiling water. Reduce heat to low, and cook for about 10 minutes, stirring constantly. Remove from heat and whip yolks until thick and lemon colored.",
            "image" => "https://cdn.sallysbakingaddiction.com/wp-content/uploads/2019/06/tiramisu-cream-400x400.jpg"
        ],
        "Step 2" => [
            "text" => "Add mascarpone to whipped yolks. Beat until combined. In a separate bowl, whip cream to stiff peaks. Gently fold into yolk mixture and set aside.",
        ],
        "Step 3" => [
            "text" => "Split the lady fingers in half, and line the bottom and sides of a large glass bowl. Brush with coffee liqueur. Spoon half of the cream filling over the lady fingers. Repeat ladyfingers, coffee liqueur and filling layers. Garnish with cocoa and chocolate curls. Refrigerate several hours or overnight.",
            "image" => "https://cdn.sallysbakingaddiction.com/wp-content/uploads/2019/06/ladyfingers-for-tiramisu-400x400.jpg"
        ],
        "Step 4" => [
            "text" => "To make the chocolate curls, use a vegetable peeler and run it down the edge of the chocolate bar.",
        ]
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
                            "post" => "now",
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
    <section class="instruction d-inline-block col-12 mt-4">
        <h3 class="btn p-0" data-bs-toggle="collapse" href="#instruction<?= $number ?>" role="button" aria-expanded="false" aria-controls="instruction<?= $number ?>">
            <i class="fas fa-check-circle d-inline-block align-middle"></i>
            <span class="d-inline-block align-middle"><?= $number ?>. <?= $name ?></span>
        </h3>
        <div class="collapse show" id="instruction<?= $number ?>">
            <div class="d-md-flex">
                <div class="col-md-<?= $image === null ? "12" : "8" ?> card card-body d-inline-block p-0 mt-3">
                    <?= $text ?>
                </div>
                <?php if ($image !== null) { ?>
                    <img class="col-12 col-md-3 d-inline-block mt-3 mt-md-0 ms-md-3" src="<?= $image ?>">
                <?php } ?>
            </div>
        </div>
    </section>
<?php }

function printMethod($method)
{
    $i = 1;
    foreach ($method as $name => $info) {
        printInstruction(
            $i++,
            $name,
            $info["text"],
            isset($info["image"]) ? $info["image"] : null
        );
    }
}

function printComment($comment, $depth = 0)
{ ?>
    <div class="card comment <?= $depth !== 0 ? "subcomment" : "" ?>">
        <div class="row g-0 p-3">
            <div class="col">
                <img class="d-inline-block rounded-circle" src="../images/people/<?= $comment["user"] ?>.jpg" alt="...">
            </div>
            <div class="col-5 card-body">
                <h6 class="card-title"><a href="<?= getRootUrl() ?>/pages/profile.php"><?= $comment["user"] ?></a> <?= key_exists("rate", $comment) ? "reviewed" : "commented" ?>:</h6>
                <?php if (key_exists("rate", $comment)) { ?>
                    <div class="rating mb-3">
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                <?php } ?>
                <p class="card-text mt-3"><?= $comment["comment"] ?></p>
                <p class="card-text mt-3">
                    <small class="text-muted">
                        <?= key_exists("edit", $comment) ? "Edited " . $comment["edit"] : $comment["post"] ?>
                    </small>
                </p>
            </div>
            <div class="col-md text-end position-relative">
                <button class="btn btn-sm btn-outline-secondary p-1 m-1"><i class="fas fa-reply me-1"></i>Reply</button>
            </div>
        </div>
        <?php if (key_exists("replies", $comment)) printComment($comment["replies"][0], $depth + 1) ?>
    </div>
<?php }

function printBoxContent($array)
{ ?>
    <table class="table table-borderless">
        <?php foreach ($array as $item => $value) { ?>
            <tr>
                <td><?= $item ?></td>
                <td><?= $value ?></td>
            </tr>
        <?php } ?>
    </table>
<?php }

function printBoxes($mobile = false)
{ ?>
    <div class="<?= $mobile ? "d-block d-xl-none" : "d-none d-xl-block" ?>">
        <div class="media my-4 my-md-0">
            <img class="img-fluid main" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
            <div class="small-img d-flex">
                <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F2270040.jpg&w=596&h=596&c=sc&poi=face&q=85">
                <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F339568.jpg&w=595&h=595&c=sc&poi=face&q=85">
                <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F378412.jpg&w=596&h=596&c=sc&poi=face&q=85">
                <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F11110.jpg&w=596&h=399&c=sc&poi=face&q=85">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <section class="icon-box mb-4">
                    <i class="fas fa-clock"></i>
                    <? printBoxContent([
                        "Duration" => "45 mins",
                        "Preparation" => "15 mins",
                        "Cooking" => "30 mins",
                        "Additional" => "-"
                    ]) ?>
                </section>
                <section class="icon-box p-2 mt-md-0">
                    <i class="fas fa-chart-bar"></i>
                    <form>
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td>
                                    <label for="yieldsInput" class="form-label">Yields</label>
                                </td>
                                <td>
                                    <span class="number">3</span> servings
                                </td>
                            </tr>
                        </table>
                        <input type="range" class="form-range" min="1" max="10" id="yieldsInput<?= $mobile ? "-mobile" : "" ?>" value="3">
                        <input type="reset" class="btn btn-sm btn-outline-secondary mt-3" onclick="calculateQuantities()" value="Reset servings">
                    </form>
                </section>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <section class="icon-box pb-2">
                    <i class="fas fa-list"></i>
                    <? printBoxContent([
                        "Energy" => "579 cal",
                        "Sugars" => "52.7 g",
                        "Fat" => "39.6 g"
                    ]) ?>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="showNutritionModal()">
                        See all
                    </button>
                </section>
            </div>
        </div>
    </div>
<?php } ?>

<?php
include "../components/nav.php";
include "../components/breadcrumb.php";

drawBreadcrumb(["Recipes", "Desserts", "Classic Tiramisu"])

?>

<main class="row content-general-margin margin-to-footer">
    <article id="recipe" class="col-xl-8 p-0 pe-xl-4">
        <header class="row text-left pt-3 pb-3 mb-md-3 shadow-sm mt-5 mt-xl-0">
            <h1 class="col-11">Classic Tiramisu</h1>
            <div class="col-9">
                <div class="rating">
                    <span class="small">34 ratings</span>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="row g-0 py-2 text-center text-md-start">
                    <table>
                        <tbody>
                            <tr>
                                <td class="col-2 col-md-1 image-container">
                                    <img class="rounded-circle" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" alt="...">
                                </td>
                                <td class="align-middle">
                                    <div class="col-md-5 card-body p-0 m-0 ms-2 text-start">
                                        by <a href="<?= getRootUrl() ?>/pages/profile.php">Jamie Oliver</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>Classic Italian dessert made with ladyfingers and mascarpone cheese. It can be made in a trifle bowl or a springform pan.</p>


                <span class="d-block mb-3"><small>Difficulty: medium</small></span>
                <span class="d-inline-block me-3">Tags: </span>
                <a role="button" class="btn btn-sm btn-secondary d-inline-block me-2 mb-2" href="<?= getRootUrl() . "/pages/category.php" ?>">
                    Dessert
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-2 mb-2" href="<?= getRootUrl() . "/pages/category.php" ?>">
                    Low carb
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-2 mb-2" href="<?= getRootUrl() . "/pages/category.php" ?>">
                    Vegetarian
                </a>
            </div>
            <ul class="col-3 text-end">
                <li class="list-group-item bg-light" style="border-radius: .5rem">
                    <a href="<?= getRootUrl() ?>/pages/editRecipe.php">
                        <span class="legend">Edit Recipe</span><i class="fas fa-edit ms-2"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <span class="legend">Print</span><i class="fas fa-print"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <span class="legend">Share</span><i class="fas fa-share-alt"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <?php if ($author) { ?>
                        <a href="#">
                            <span class="legend">Edit</span><i class="fas fa-edit"></i>
                        </a>
                    <?php } else { ?>
                        <a href="#">
                            <span class="legend">Favourite</span><i class="fas fa-heart"></i>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </header>
        <?php printBoxes(true) ?>
        <section id="ingredients" class="mt-5">
            <h2 class="p-0 mb-4">Ingredients</h2>
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
        <section id="method" class="mt-5">
            <h2 class="p-0">Method</h2>
            <?php printMethod($recipe["method"]); ?>
        </section>
        <section class="icon-box mt-5 shadow-sm" id="comments">
            <i class="fas fa-comments"></i>
            <?php
            foreach ($recipe["comments"] as $i => $comment)
                printComment($comment);
            ?>
            <div class="form-floating m-3 position-relative">
                <textarea class="form-control" placeholder="Leave a comment here" id="commentTextarea" style="height: 6rem"></textarea>
                <label for="floatingTextarea2">Your comment</label>
                <button type="button" class="btn btn-primary position-absolute py-1 send" onclick="result()">
                    <small><i class="fas fa-paper-plane me-2"></i>
                        Comment</small>
                </button>
                <?php include "../components/rating.php" ?>
            </div>
        </section>
    </article>
    <aside class="col-xl-4 p-0 ps-xl-4 mt-5 mt-xl-0">
        <div class="d-none d-xl-block">
            <?php printBoxes() ?>
        </div>
        <div class="suggested mt-5">
            <h4 class="text-center">Suggested</h4>
            <div class="row">
                <div class="col">
                    <?php getRecipeCard("Basic Brown Sugar Meringue", "Emma Watson", "https://www.thespruceeats.com/thmb/F1ebSCX8WuGCeEhkdsoyMMvmaFE=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/brown-sugar-meringue-for-pies-3056204-hero-01-3ea7e126fc034c9c9ca69e8d7ddba9e2.jpg") ?>
                </div>
                <div class="col">
                    <?php getRecipeCard("Classic Double Crust Blueberry Pie", "Jay Gatsby", "https://www.thespruceeats.com/thmb/l_HEh1Z__Tb43dgZqC3ySmNnOdY=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/classic-double-crust-blueberry-pie-3051709-hero-01-e3db9e34e7dc416ba9b5d48a22f947f1.jpg") ?>
                </div>
                <div class="col">
                    <?php getRecipeCard("Traditional Irish Stew", "Jay Gatsby", "https://www.thespruceeats.com/thmb/AhWrgq_6_WUp6Vezr69PdbLC_tM=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/traditional-irish-stew-recipe-435757-hero-01-7ec7d4b8688a424d93b080f000ab53ff.jpg") ?>
                </div>
                <div class="col">
                    <?php getRecipeCard() ?>
                </div>
            </div>
        </div>
    </aside>
</main>

<?php
include "../components/footer.php";
include "../components/docFooter.php";
?>