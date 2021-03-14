<?php

$owner = true;
$pageTitle = "Jamie Oliver's Profile | TasteBuds";
$extraStyles = [
    "../components/navPopups.css",
    "../components/profile_cover.css",
    "../components/post.css",
    "../components/membersFollowingBoxes.css",
    "../components/breadcrumb.css",
    "../components/search_results_cards.css",
    "group.css"
];
$extraScripts = [
    "../components/membersFollowingBoxes.js",
    "../components/navPopups.js",
    "../scripts/addToFavourites.js"
];
$role = "member";
include_once "../components/docHeader.php";
include_once "../components/nav.php";
include_once "../components/post.php";
include_once "../components/breadcrumb.php";
include_once "../components/membersFollowingBoxes.php";
include_once "../components/search_results_cards.php";

?>

<main class="content-general-padding margin-to-footer">
    <?php drawBreadcrumb(["Profiles", "Jamie Oliver's Profile"], true); ?>
    <div>
        <div class="cover">

            <?php $section = 3;
            include_once "../components/profile_cover.php"; ?>
        </div>
        <div class="row group-body">
            <div class="col-md-4 p-0 pe-md-4 mt-5">
                <div class="card m-0 mb-4 shadow-sm text-center p-3 personal-info">
                    <h4>Personal Info</h4>
                    <div class="text-start m-auto d-inline">
                        <span><i class="fas fa-map-marker-alt"></i>Ruílhe, Portugal</span>
                        <br>
                        <span><i class="fas fa-birthday-cake"></i>Joined in Jul 2020</span>
                    </div>
                    <a class="btn btn-primary mt-2" href="<?= getRootUrl() . "/pages/createRecipe.php" ?>">Create Recipe</a>
                    <a class="btn btn-primary mt-2" href="<?= getRootUrl() . "/pages/create_group.php" ?>">Create Group</a>
                </div>
                <?php displayPeopleBox("Following"); ?>
                <div class="card shadow-sm people-box mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Groups</h5>
                        <div class="g-5 mb-5">
                            <div class="mt-4">
                                <button class="btn small-profile-photo small-group-photo d-inline"></button>
                                <span class="name">Vegetarianos do Porto</span>
                            </div>
                            <div class="mt-4">
                                <button class="btn small-profile-photo small-group-photo d-inline"></button>
                                <span class="name">Receitas da avó</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary">
                            <small><i class="fas fa-plus me-2"></i> See all groups</small>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-8 posts-area ps-md-4 pe-0 mt-5">
                <h3>Favourite Recipes</h3>
                <?php
                displayRecipe(true, "Traditional Irish Stew", "Jay Gatsby", "Pure comfort food for a chilly day for the slow cooker! A little prep time needed up front. Don't be fooled by how much onion and garlic is used. It's honestly not too much! Cheers!", "https://www.thespruceeats.com/thmb/AhWrgq_6_WUp6Vezr69PdbLC_tM=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/traditional-irish-stew-recipe-435757-hero-01-7ec7d4b8688a424d93b080f000ab53ff.jpg", "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Ftheawesomedaily.com%2Fwp-content%2Fuploads%2F2017%2F02%2Ffunny-profile-pictures-14-1.jpg&f=1&nofb=1", "5 September, 2021", ["Main Dish", "Meat Lovers"], true);
                displayRecipe(true, "Classic Double Crust Blueberry Pie", "Jay Gatsby", "Fresh blueberries are some of the best treasures of summer, and a flavorful cinnamon-spiced blueberry pie will be welcomed by your family and guests. Besides being a delicious fruit, blueberries are called a superfood due to their beneficial nutrients and antioxidants.", "https://www.thespruceeats.com/thmb/l_HEh1Z__Tb43dgZqC3ySmNnOdY=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/classic-double-crust-blueberry-pie-3051709-hero-01-e3db9e34e7dc416ba9b5d48a22f947f1.jpg", "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Ftheawesomedaily.com%2Fwp-content%2Fuploads%2F2017%2F02%2Ffunny-profile-pictures-14-1.jpg&f=1&nofb=1", "2 September, 2021", ["Dessert", "Low Carb"], true);
                ?>
            </div>
        </div>
    </div>
</main>
<?php
include_once "../components/footer.php";
include_once "../components/docFooter.php";
?>