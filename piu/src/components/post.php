<?php

    // displayRecipe(true); // Recipe - Visitor 
    // displayRecipe(false); // Recipe - Owner
    // displayReview(true); // Review - Visitor
    // displayReview(false); // Review - Owner
    

    function displayRecipe($isVisitor = true, $title="Classic Tiramisu", $poster="Alex Johnson", $description="Classic Italian dessert made with ladyfingers and mascarpone cheese. It can be made in a trifle bowl or a springform pan.", $img="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636", $userImg="https://www.thispersondoesnotexist.com/image", $date="11 September, 2020") { ?>
        <div class="card shadow-sm recipe-post mt-5">
            <div class="col-sm post-options">
                <div class="dropdown">
                    <button type="button" class="btn edit-photo-button float-end me-2 mt-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> 
                        <?php if($isVisitor) { ?>
                            <li><a class="dropdown-item" href="#">Report Post</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="#">Edit Post</a></li>
                            <li><a class="dropdown-item" href="#">Delete Post</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="card-body">
            
                <div class="row user-info">
                    <div class="col avatar-image">
                        <img class="rounded-circle z-depth-2" src="<?=$userImg?>">
                    </div>
                    <div class="col name-and-date ms-4">
                        <div><a href="<?=getRootUrl()?>/pages/profile.php" style="text-decoration: none"><strong><?=$poster?></strong></a></div>
                        <div class="publication-date"><?=$date?></div>
                    </div>
                </div>

                <a type="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn card p-2 shadow-sm recipe-preview mt-4">
                    <div class="row px-3">
                        <div class="col-md post-image" style="background-image: url('<?=$img?>')"></div>
                        <div class="col-md w-50 text-recipe pt-4 pt-md-2 px-0 ps-md-4">
                            <div class="text-recipe">
                                <h4 class="card-title"><?=$title?></h4>
                                <p class="card-text post-description"><?=$description?></p>
                                <p><small class="text-muted">4.6 <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> | 563 reviews</small></p>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="container mt-4 p-0 ">
                    <a role="button" class="btn btn-sm btn-secondary d-inline-block me-3 mb-2" href="<?=getRootUrl(). "/pages/category.php"?>">
                        Dessert
                    </a>
                    <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2" href="<?=getRootUrl(). "/pages/category.php"?>">
                        Low carb
                    </a>
                    <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2" href="<?=getRootUrl(). "/pages/category.php"?>">
                        Vegetarian
                    </a>
                </div>
            </div>
            <div class="btn-group col-sm d-flex justify-content-center text-center">
                <button type="button" class="btn post-button" onClick="this.firstElementChild.style.color = 'var(--accent-color)'">
                    <i class="fas fa-heart me-2"></i>
                    <span class="button-caption">Add to Favourites</span>
                </button>
                <a type="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn post-button">
                    <i class="fas fa-eye me-2"></i>
                    <span class="button-caption">View Recipe</span>
                </a>
                <button type="button" class="btn post-button">
                    <i class="fas fa-share-alt me-2"></i>
                    <span class="button-caption">Share</span>
                </button>
            </div>
        </div>
    <?php }

    function displayReview($isVisitor) { ?>
        <div class="card shadow-sm recipe-post mt-5">
            <div class="col-sm post-options">
                <div class="dropdown">
                    <button type="button" class="btn edit-photo-button float-end me-2 mt-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> 
                        <?php if($isVisitor) { ?>
                            <li><a class="dropdown-item" href="#">Report Post</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="#">Edit Post</a></li>
                            <li><a class="dropdown-item" href="#">Delete Post</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="row user-info">
                    <div class="col avatar-image mb-2">
                        <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                    </div>
                    <div class="col col-sm name-and-date ms-4">
                        <div><a href="<?=getRootUrl()?>/pages/profile.php" style="text-decoration: none"><strong>Jamie Oliver</strong></a> <span class="review-text">wrote a review</span></div>
                        <div class="publication-date">11 September, 2020</div>
                    </div>
                </div>
                <div class="mt-4">
                    <div><strong>Rating:</strong> <i class="fas fa-star active ms-2"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star"></i></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                </div>
                <a type="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn card mb-2 mt-4 shadow-sm p-2 recipe-post-review">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://blog.myfitnesspal.com/wp-content/uploads/2017/12/Essential-Guide-to-Healthy-Eating-2-752x472.png" class="bd-placeholder-img recipe-image" width="100%">
                        </div>
                        <div class="col-md-8 p-3">
                            <h4 class="m-0 p-0 card-title">Cozido à Portuguesa</h4>
                            <p class="m-0 p-0"><small class="text-muted">4.6 <i class="fas fa-star active ms-2"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> | 563 reviews</small></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="btn-group col-sm d-flex justify-content-center text-center">
                <a type="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn post-button">
                    <i class="fas fa-eye me-2"></i>
                    <span class="button-caption">View Recipe</span>
                </a>
                <button type="button" class="btn post-button">
                    <i class="fas fa-share-alt me-2"></i>
                    <span class="button-caption">Share</span>
                </button>
            </div>
        </div>
    <?php } 
?>

