<?php

    // Recipe card
    function getRecipeCard($name="Cozido à portuguesa", $author="Jamie Oliver", $image="https://www.heart.org/-/media/images/news/2019/april-2019/0429sustainablefoodsystem_sc.jpg") { ?> 
        <div class="search-card">
            <a type="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn card shadow-sm p-2">
                <div class="card-img-top" style="background-image: url('<?=$image?>')"></div>
                <div class="card-body m-0">
                    <h4 class="card-title"><?=$name?></h4>
                    <p class="text-muted m-0" style="font-size: .8rem">4.6 
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i> | 563 reviews</p>
                    <p class="card-text mt-2">by <?=$author?></p>
                </div>
            </a>
        </div>
    <?php }

    // Group card
    function getGroupCard($name="Vegetarianos do Porto", $image="https://www.nit.pt/wp-content/uploads/2020/05/b75a414ec50510989b8fa3672785e005.jpg") { ?>
        <div class="search-card">
            <a type="button" href="<?=getRootUrl()?>/pages/group.php" class="btn card shadow-sm p-2">
                <div class="card-img-top group-card-img-top" style="background-image: url('<?=$image?>')"></div>
                <div class="card-body">
                    <h4 class="card-title"><?=$name?></h4>
                    <p class="text-muted m-0 card-info"><span class="info-number">237</span> recipes</p>
                    <p class="text-muted m-0 mt-1 card-info"><span class="info-number">57</span>  members</p>
                </div>
            </a>
        </div>
    <?php }

    // Category card
    function getCategoryCard($name="Vegetarian", $image="https://www.health.harvard.edu/media/content/images/cr/f5282d05-33f5-4c93-a08e-b000164a54db.jpg") { ?>
        <div class="search-card">
            <a type="button" href="<?=getRootUrl()?>/pages/category.php" class="btn card shadow-sm p-2">
                <div class="card-img-top category-card-img-top" style="background-image: url('<?=$image?>')"></div>
                <div class="card-body">
                    <h4 class="card-title mt-3"><?=$name?></h4>
                    <p class="text-muted m-0 card-info"><span class="info-number">237</span> recipes</p>
                </div>
            </a>
        </div>
    <?php }

    // User card
    function getUserCard($name="Jamie Oliver", $image="https://cdn.fastly.picmonkey.com/contentful/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=800&q=70") { ?>
        <div class="search-card">
            <a href="<?=getRootUrl()?>/pages/profile.php" class="btn card shadow-sm p-2">
                <div class="rounded-circle card-img-top user-card-img-top" style="background-image: url('<?=$image?>')"></div>
                <div class="card-body">
                    <h4 class="card-title mt-2"><?=$name?></h4>
                    <p class="text-muted m-0 mt-2" style="font-size: .8rem">4.6 
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i> | <span class="info-number">13</span> recipes</p>
                </div>
            </a>
        </div>
    <?php }
?>