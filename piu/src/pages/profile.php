<?php

$owner = true;
$pageTitle = "Jamie Oliver's Profile | TasteBuds";
$extraStyles = [
    "../components/navPopups.css",
    "../components/profile_cover.css",
    "../components/post.css",
    "../components/membersFollowingBoxes.css",
    "../components/breadcrumb.css",
    "group.css"
];
$extraScripts = [
    "../components/membersFollowingBoxes.js",
    "../components/navPopups.js"
];
$role="member";
include_once "../components/docHeader.php";
include_once "../components/nav.php";
include_once "../components/post.php";
include_once "../components/breadcrumb.php";
include_once "../components/membersFollowingBoxes.php";

?>

<main class="content-general-padding margin-to-footer">
    <?php drawBreadcrumb(["Profiles", "Jamie Oliver's Profile"], true); ?>
    <div>
        <div class="cover">
            <?php include_once "../components/profile_cover.php"; ?>
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
                </div>
                <?php displayPeopleBox("Following"); ?>
            </div>

            <div class="col-md-8 posts-area ps-md-4">
                <div class="row">
                    <?php for ($i = 0; $i < 2; $i++) {
                        displayRecipe(true);
                    } ?>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-dark load-more w-25 mt-5">Load More</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once "../components/footer.php";
include_once "../components/docFooter.php";
?>