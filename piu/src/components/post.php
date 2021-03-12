<?php

    // displayRecipe(true); // Recipe - Visitor 
    // displayRecipe(false); // Recipe - Owner
    // displayReview(true); // Review - Visitor
    // displayReview(false); // Review - Owner
    

    function displayRecipe($isVisitor = true, $title="Classic Tiramisu", $poster="Jamie Oliver", $description="Classic Italian dessert made with ladyfingers and mascarpone cheese. It can be made in a trifle bowl or a springform pan.", $img="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636", $userImg="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg", $date="11 September, 2020") { ?>
        <div class="card shadow-sm recipe-post mt-5">
            <div class="col-sm post-options">
                <div class="dropdown">
                    <button type="button" class="btn edit-photo-button float-end me-2 mt-2 btn-no-shadow" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1"> 
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

    function displayReview($isVisitor, $reviewContent="I cooked it and it was awesome. Although I don't think you'll get the same results (do you really think you are at my level?), I think you should try it!", $reviewer="Ellie Costa", $reviewerImage="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fwww.lensmen.ie%2Fwp-content%2Fuploads%2F2015%2F02%2FProfile-Portrait-Photographer-in-Dublin-Ireland..jpg&f=1&nofb=1", $reviewDate="11 September, 2020", $recipeTitle="Classic Tiramisu", $recipeImage="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636") { ?>
        <div class="card shadow-sm recipe-post mt-5">
            <div class="col-sm post-options">
                <div class="dropdown">
                    <button type="button" class="btn edit-photo-button float-end me-2 mt-2 btn-no-shadow" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1"> 
                        <?php if($isVisitor) { ?>
                            <li><a class="dropdown-item" href="#">Report Review</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="#">Edit Review</a></li>
                            <li><a class="dropdown-item" href="#">Delete Review</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="row user-info">
                    <div class="col avatar-image mb-2">
                        <img class="rounded-circle z-depth-2" src="<?=$reviewerImage?>">
                    </div>
                    <div class="col col-sm name-and-date ms-4">
                        <div><a href="<?=getRootUrl()?>/pages/profile.php" style="text-decoration: none"><strong><?=$reviewer?></strong></a> <span class="review-text">wrote a review</span></div>
                        <div class="publication-date"><?=$reviewDate?></div>
                    </div>
                </div>
                <div class="mt-4">
                    <div><strong>Rating:</strong> <i class="fas fa-star active ms-2"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star"></i></div>
                    <p><?=$reviewContent?></p>
                </div>
                <a type="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn card mb-2 mt-4 shadow-sm p-2 recipe-post-review">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?=$recipeImage?>" class="bd-placeholder-img recipe-image" width="100%">
                        </div>
                        <div class="col-md-8 p-3">
                            <h4 class="m-0 p-0 card-title"><?=$recipeTitle?></h4>
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

