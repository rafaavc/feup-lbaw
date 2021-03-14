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
                    <?php 
                        displayRecipe(false); 
                        displayRecipe(true, "Classic Double Crust Blueberry Pie", "Jay Gatsby", "Fresh blueberries are some of the best treasures of summer, and a flavorful cinnamon-spiced blueberry pie will be welcomed by your family and guests. Besides being a delicious fruit, blueberries are called a superfood due to their beneficial nutrients and antioxidants.", "https://www.thespruceeats.com/thmb/l_HEh1Z__Tb43dgZqC3ySmNnOdY=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/classic-double-crust-blueberry-pie-3051709-hero-01-e3db9e34e7dc416ba9b5d48a22f947f1.jpg", "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Ftheawesomedaily.com%2Fwp-content%2Fuploads%2F2017%2F02%2Ffunny-profile-pictures-14-1.jpg&f=1&nofb=1", "2 September, 2021", ["Dessert", "Low Carb"]);      
                    ?>
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
