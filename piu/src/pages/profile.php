<?php

$owner = true;
$pageTitle = "Jamie Oliver Profile | TasteBuds";
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

include_once "../components/docHeader.php";
include_once "../components/nav.php";
include_once "../components/post.php";
include_once "../components/breadcrumb.php";
include_once "../components/membersFollowingBoxes.php";

?>

<main>
    <div class="container content-general-margin">
        <div class="cover">
            <?php include_once "../components/profile_cover.php"; ?>
        </div>
        <div class="row group-body">
            <div class="col-md-4">
                <div class="row m-0 text-start">
                    <?php drawBreadcrumb(["Profile", "Jamie Oliver"], true); ?>
                </div>
                <div class="row members-box m-0">
                    <?php displayPeopleBox("Following"); ?>
                </div>
            </div>

            <div class="col-md-8 posts-area">
                <div class="row">
                    <?php for ($i = 0; $i < 2; $i++) {
                        displayRecipe(true);
                    } ?>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once "../components/footer.php";
include_once "../components/docFooter.php";
?>