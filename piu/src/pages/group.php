<?php 

$pageTitle = "Group Name | TasteBuds";
$extraStyles = [ "../components/navPopups.css",
    "../components/cover.css",
    "../components/post.css",
    "../components/membersFollowingBoxes.css",
    "group.css"
];
$extraScripts = [
    "../components/membersFollowingBoxes.js",
    "../components/navPopups.js"
];

include_once "../components/docHeader.php";
include_once "../components/nav.php";

include_once "../components/post.php";

?>

<main>
    <div class="container">
        <div class="cover">
            <?php include_once "../components/cover.php"; ?>
        </div>
        <div class="row group-body">
            <div class="col members-box">
                <?php include_once "../components/membersFollowingBoxes.php"; ?>
            </div>
            <div class="col posts-area">
                <?php for ($i = 0; $i < 2; $i++) {
                    displayRecipe(true);
                } ?>
            </div>
        </div>
        
        
    </div>
</main>
<?php
    include_once "../components/footer.php";           
    include_once "../components/docFooter.php";
?>
