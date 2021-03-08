
<?php global $isCategory; ?>

<?php
    $pageTitle = ($isCategory ? "Category" : "Feed") . " | TasteBuds";
    $extraStyles = [ "../components/filterSortBar.css", "../components/post.css", "category.css" ];
    $extraScripts = [ "../components/filterSortBar.js" ];
    include_once "../components/post.php";
    include_once "../components/docHeader.php"; 
    include_once "../components/nav.php"; 
?>
<div class="container content-general-margin margin-to-footer">
    <div class="mt-5 category-header">
        <h1 class="mt-2 mb-5">
            <?php 
                if ($isCategory) echo "Vegetarian";
                else echo "Feed";
            ?>
        </h1>
        <?php
            include_once "../components/filterSortBar.php";
        ?>
    </div>
    <div class="card shadow search-area searched-recipes p-4 my-5">
        <?php 
            displayRecipe(true);
            displayRecipe(true);
        ?>
        <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
    </div>
</div>
<?php 
    include_once "../components/footer.php"; 
    include_once "../components/docFooter.php";
?>

