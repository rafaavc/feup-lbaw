
<?php global $isCategory; ?>

<?php
    $role = "member";
    $pageTitle = ($isCategory ? "Category: Vegetarian" : "Feed") . " | TasteBuds";
    $extraStyles = [ "../components/filterSortBar.css", "../components/post.css", "category.css"];
    $mainScript = "../components/filterSortBar.js";
    $extraScripts = $isCategory ?  [$mainScript, "../scripts/category.js"] : [$mainScript];
    include_once "../components/post.php";
    include_once "../components/docHeader.php"; 
    include_once "../components/nav.php"; 
    include_once "../components/trending.php"; 
?>

<div class="margin-from-nav content-general-margin">
    <?php if ($isCategory) { ?>
        <h4>Category</h4>
    <?php } ?>
    <h1>
        <?php 
            if ($isCategory) echo "Vegetarian";
            else echo "Feed";
        ?>
    </h1>
</div>
<div class="row g-5 content-general-margin margin-to-footer">
    <div class="col-xxl-9 px-0">
        <div class="mt-4<?= $isCategory ? " category-header" : " mb-3" ?> filter-bar-container">
            <?php
                include_once "../components/filterSortBar.php";
            ?>
        </div>
        <?php if (!$isCategory) { ?><a href="<?=getRootUrl()."/pages/createRecipe.php"?>" role="button" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Create Recipe</a><?php } ?>
        <div class="search-area searched-recipes my-5">
            <?php 
                displayRecipe(false);
                if (!$isCategory) {
                    displayReview(true);
                    displayRecipe(true, "Traditional Irish Stew", "Jay Gatsby", "Pure comfort food for a chilly day for the slow cooker! A little prep time needed up front. Don't be fooled by how much onion and garlic is used. It's honestly not too much! Cheers!", "https://www.thespruceeats.com/thmb/AhWrgq_6_WUp6Vezr69PdbLC_tM=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/traditional-irish-stew-recipe-435757-hero-01-7ec7d4b8688a424d93b080f000ab53ff.jpg", "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Ftheawesomedaily.com%2Fwp-content%2Fuploads%2F2017%2F02%2Ffunny-profile-pictures-14-1.jpg&f=1&nofb=1", "5 September, 2021", ["Main Dish", "Meat Lovers"]);
                    displayRecipe(true, "Classic Double Crust Blueberry Pie", "Jay Gatsby", "Fresh blueberries are some of the best treasures of summer, and a flavorful cinnamon-spiced blueberry pie will be welcomed by your family and guests. Besides being a delicious fruit, blueberries are called a superfood due to their beneficial nutrients and antioxidants.", "https://www.thespruceeats.com/thmb/l_HEh1Z__Tb43dgZqC3ySmNnOdY=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/classic-double-crust-blueberry-pie-3051709-hero-01-e3db9e34e7dc416ba9b5d48a22f947f1.jpg", "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Ftheawesomedaily.com%2Fwp-content%2Fuploads%2F2017%2F02%2Ffunny-profile-pictures-14-1.jpg&f=1&nofb=1", "2 September, 2021", ["Dessert", "Low Carb"]);
                }
                else displayRecipe(true, "Churro Waffles", "Jamie Oliver", "If you've ever had churros dipped in chocolate, you know what this recipe is all about. Churros are perfectly crunchy, cinnamon sugar-dusted sticks of goodness, dunked in creamy chocolate—a dream come true. But turning your waffles into churros for breakfast? That's heaven.", "https://www.thespruceeats.com/thmb/7xtcaM7YX-9YV9Mrp5ANPi3dLzA=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/churrowaffles-05-5c6378ce46e0fb0001ca8e49.jpg", "https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg", "21 October, 2020"); 

            ?>
            <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto"><i class="fas fa-plus me-2"></i> Load More</button>
        </div>
    </div>
    <div class="col-xxl-3 pe-0 trending-topics-recipes">
        <?php displayTrendingTopics(); ?>
        <?php displayTrendingRecipes(); ?>
    </div>
</div>
<?php 
    include_once "../components/footer.php"; 
    include_once "../components/docFooter.php";
?>

