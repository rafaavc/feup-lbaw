<?php 

    $role = "member";
    $pageTitle = "Group Name | TasteBuds";
    $extraStyles = [ "../components/navPopups.css",
        "../components/group_cover.css",
        "../components/post.css",
        "../components/membersFollowingBoxes.css",
        "../components/breadcrumb.css",
        "group.css"
    ];
    $extraScripts = [
        "../components/membersFollowingBoxes.js",
        "../components/navPopups.js"
    ];

    $role = "member";
    include_once "../components/docHeader.php";
    include_once "../components/nav.php";
    include_once "../components/post.php";
    include_once "../components/breadcrumb.php";
    include_once "../components/membersFollowingBoxes.php";

?>

<main class="content-general-margin margin-to-footer">
        <?php drawBreadcrumb(["Groups", "Vegetarianos do Porto"], true); ?>
        <div class="cover">
            <?php include_once "../components/group_cover.php"; ?>
        </div>
        <div class="row group-body mt-3 g-5">
            <div class="col-md-4">
                <?php displayPeopleBox("Members"); ?>
            </div>
            
            <div class="col-md-8 posts-area">
                <div class="row button-area text-start">
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> 
                        &nbspPost Recipe to Group
                    </button>
                </div>
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
</main>
<?php
    include_once "../components/footer.php";           
    include_once "../components/docFooter.php";
?>
