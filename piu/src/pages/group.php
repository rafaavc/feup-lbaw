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
    $pageTitle = "Group Vegetarianos do Porto | TasteBuds";
    include_once "../components/docHeader.php";
    include_once "../components/nav.php";
    include_once "../components/post.php";
    include_once "../components/breadcrumb.php";
    include_once "../components/membersFollowingBoxes.php";
    include_once "../components/notificationCards.php";

    function displayMemberRequests() { ?>
        <div id="memberRequests" class="card shadow-sm people-box mt-5">
            <div class="card-body m-0">
                <h5 class="card-title mb-4">Member Requests</h5>
                <ul class="p-0 m-0">
                    <li class="card p-2 mb-2">
                        <?= displayMemberRequestCard("John Fisher", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.istockphoto.com%2Fphotos%2Fprofile-view-of-serious-young-man-over-white-background-picture-id534880122%3Fk%3D6%26m%3D534880122%26s%3D612x612%26w%3D0%26h%3DZ9CzW6g2QTs2sWGe7oyHpnQNRo9laboY8fgMMPUjMfo%3D&f=1&nofb=1", true); ?>
                    </li>
                    <li class="card p-2 mb-2">
                        <?= displayMemberRequestCard("Scott Carried", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse2.mm.bing.net%2Fth%3Fid%3DOIP.dR_lyjyp3Oux_XLl9A9TfgHaE8%26pid%3DApi&f=1", true); ?>
                    </li>
                </ul>
            </div>
        </div>
<?php } ?>

<main class="content-general-margin margin-to-footer">
    <?php drawBreadcrumb(["Groups", "Vegetarianos do Porto"], true); ?>
    <div class="cover">
        <?php include_once "../components/group_cover.php"; ?>
    </div>
    <div class="row group-body mt-3 g-5">
        <div class="col-md-4">
            <?php displayPeopleBox("Members", true); ?>
            <?php displayMemberRequests(); ?>
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
