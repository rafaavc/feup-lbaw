
<!-- 
    AS THIS IS SUPPOSED TO BE IN THE LAYOUT GRID OF 
    THE GROUP/PROFILE PAGE, IT HAS NO PRE-IMPOSED RESTRICTIONS 
    ON WIDTH. THOSE RESTRICTIONS WILL BE IMPOSED BY THE GRID ITSELF. 

    THIS DEPENDS ON navPopups.css
-->

<?php function displayProfilePicture($photo, $name) { ?>
    <button class="btn small-profile-photo profile-popover" style="background-image: url('<?=$photo?>')" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="<?=$name?>"></button>
<?php } ?>  

<?php function displayTrendingTopics() { ?>
    <div class="card shadow-sm people-box mb-5">
        <div class="card-body">
            <h5 class="card-title mb-4">Trending Categories</h5>
            <div class="container p-0 mb-3">
                <a role="button" class="btn btn-sm btn-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Vegetarian
                </a>
                <a role="button" class="btn btn-sm btn-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Low carb
                </a>
                <a role="button" class="btn btn-sm btn-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Keto diet
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Vegan
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Traditional Portuguese
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Italian
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Ice Cream
                </a>
            </div>
        </div>
    </div>
<?php } 

function displayTrendingRecipes() { ?>
    <div class="card people-box shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Trending Recipes</h5>
            <div class="container p-0 mb-3">
                <a role="button" class="text-start btn btn-sm btn-secondary d-block mb-3" href="<?=getRootUrl(). "/pages/recipe.php"?>">
                    Cozido à Portuguesa
                </a>
                <a role="button" class="text-start btn btn-sm btn-secondary d-block mb-3" href="<?=getRootUrl(). "/pages/recipe.php"?>">
                    Panko Parmesan Salmon
                </a>
                <a role="button" class="text-start btn btn-sm btn-secondary d-block mb-3" href="<?=getRootUrl(). "/pages/recipe.php"?>">
                    Grandma Elaine's Unstuffed Sweet and Sour Cabbage
                </a>
                <a role="button" class="text-start btn btn-sm btn-outline-secondary d-block mb-3" href="<?=getRootUrl(). "/pages/recipe.php"?>">
                    Easy Homemade Pizza Dough
                </a>
                <a role="button" class="text-start btn btn-sm btn-outline-secondary d-block mb-3" href="<?=getRootUrl(). "/pages/recipe.php"?>">
                    Chicken, Asparagus, and Mushroom Skillet
                </a>
                <a role="button" class="text-start btn btn-sm btn-outline-secondary d-block mb-3" href="<?=getRootUrl(). "/pages/recipe.php"?>">
                    Almond Ricotta Cake
                </a>
            </div>
        </div>
    </div>
<?php } ?>
