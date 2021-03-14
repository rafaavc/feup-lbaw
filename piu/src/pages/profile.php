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
    "../components/navPopups.js",
    "../scripts/addToFavourites.js"
];
$role = "member";
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
                    <a class="btn btn-primary mt-2" href="<?= getRootUrl() . "/pages/create_group.php" ?>">Create Group</a>
                </div>
                <?php displayPeopleBox("Following"); ?>
                <div class="card shadow-sm people-box mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Groups</h5>
                        <div class="g-5 mb-5">
                            <div class="mt-4">
                                <button onClick="window.location.href = '<?=getRootUrl()?>/pages/group.php'" style="background-image: url('https://www.studyfinds.org/wp-content/uploads/2020/01/AdobeStock_289529994-816x520.jpeg')" class="btn small-profile-photo small-group-photo d-inline"></button>
                                <span class="name">Vegetarianos do Porto</span>
                            </div>
                            <div class="mt-4">
                                <button onClick="window.location.href = '<?=getRootUrl()?>/pages/group.php'" style="background-image: url('https://www.comidaereceitas.com.br/img/sizeswp/1200x675/2007/11/Leitao_assadaaaa.jpg')" class="btn small-profile-photo small-group-photo d-inline"></button>
                                <span class="name">Amantes de Leitões</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary">
                            <small><i class="fas fa-plus me-2"></i> See all groups</small>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-8 posts-area ps-md-4 mt-5">
                <div class="row first-recipe-mt">
                    <h3>Recipes</h3>
                    <?php
                    displayRecipe(false);
                    displayRecipe(false, "Churro Waffles", "Jamie Oliver", "If you've ever had churros dipped in chocolate, you know what this recipe is all about. Churros are perfectly crunchy, cinnamon sugar-dusted sticks of goodness, dunked in creamy chocolate—a dream come true. But turning your waffles into churros for breakfast? That's heaven.", "https://www.thespruceeats.com/thmb/7xtcaM7YX-9YV9Mrp5ANPi3dLzA=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/churrowaffles-05-5c6378ce46e0fb0001ca8e49.jpg", "https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg", "21 October, 2020");
                    ?>
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