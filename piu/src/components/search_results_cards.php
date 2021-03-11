<?php

    // Recipe card
    function getRecipeCard() { ?> 
        <div class="search-card">
            <a type="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn card shadow-sm p-2">
                <div class="card-img-top recipe-card-img-top"></div>
                <div class="card-body m-0">
                    <h4 class="card-title">Cozido à portuguesa</h4>
                    <p class="text-muted m-0" style="font-size: .8rem">4.6 
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i> | 563 reviews</p>
                    <p class="card-text mt-2">by Jamie Oliver</p>
                </div>
            </a>
        </div>
    <?php }

    // Group card
    function getGroupCard() { ?>
        <div class="search-card">
            <a type="button" href="<?=getRootUrl()?>/pages/group.php" class="btn card shadow-sm p-2">
                <div class="card-img-top group-card-img-top"></div>
                <div class="card-body">
                    <h4 class="card-title">Vegetarianos do Porto</h4>
                    <p class="text-muted m-0 card-info"><span class="info-number">237</span> recipes</p>
                    <p class="text-muted m-0 mt-1 card-info"><span class="info-number">57</span>  members</p>
                </div>
            </a>
        </div>
    <?php }

    // Category card
    function getCategoryCard() { ?>
        <div class="search-card">
            <a type="button" href="<?=getRootUrl()?>/pages/category.php" class="btn card shadow-sm p-2">
                <div class="card-img-top category-card-img-top"></div>
                <div class="card-body">
                    <h4 class="card-title mt-3">Vegetarian</h4>
                    <p class="text-muted m-0 card-info"><span class="info-number">237</span> recipes</p>
                </div>
    </a>
        </div>
    <?php }

    // User card
    function getUserCard() { ?>
        <div class="search-card">
            <a href="<?=getRootUrl()?>/pages/profile.php" class="btn card shadow-sm p-2">
                <div class="user-card-img-top">
                    <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                </div>
                <div class="card-body">
                    <h4 class="card-title mt-2">Jamie Oliver</h4>
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