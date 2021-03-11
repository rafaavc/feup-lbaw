<?php

    // displayRecipe(true); // Recipe - Visitor 
    // displayRecipe(false); // Recipe - Owner
    // displayReview(true); // Review - Visitor
    // displayReview(false); // Review - Owner
    

    function displayRecipe($isVisitor = true) { ?>
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
                        <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                    </div>
                    <div class="col name-and-date ms-4">
                        <div><strong>Jamie Oliver</strong></div>
                        <div class="publication-date">11 September, 2020</div>
                    </div>
                </div>

                <div class="card p-2 shadow-sm recipe-preview mt-4">
                    <div class="row" style="min-height: 300px;">
                        <div class="col-md-4 post-image">
                            <img src="https://blog.myfitnesspal.com/wp-content/uploads/2017/12/Essential-Guide-to-Healthy-Eating-2-752x472.png" class="bd-placeholder-img recipe-image-big" height="300px" width="100%">
                        </div>
                        <div class="col-md-8 w-50 text-recipe">
                            <div class="text-recipe p-1">
                                <h2 class="card-title mt-3">Cozido à Portuguesa</h2>
                                <p class="card-text post-description">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                <p><small class="text-muted">4.6 <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> | 563 reviews</small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-4 p-0 ">
                    <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2" href="<?=getRootUrl(). "/pages/category.php"?>">
                        Vegetarian
                    </a>
                    <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2" href="<?=getRootUrl(). "/pages/category.php"?>">
                        Low carb
                    </a>
                    <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2" href="<?=getRootUrl(). "/pages/category.php"?>">
                        Low carb
                    </a>
                    <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2" href="<?=getRootUrl(). "/pages/category.php"?>">
                        Low carb
                    </a>
                </div>
            </div>
            <div class="btn-group col-sm d-flex justify-content-center text-center">
                <button type="button" class="btn post-button" onClick="this.firstElementChild.style.color = 'var(--accent-color)'">
                    <i class="fas fa-heart me-2"></i>
                    <span class="button-caption">Add to Favourites</span>
                </button>
                <button type="button" class="btn post-button">
                    <i class="fas fa-eye me-2"></i>
                    <span class="button-caption">View Recipe</span>
                </button>
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
                        <li><a class="dropdown-item" href="#">Report Review</a></li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="row user-info">
                    <div class="col-sm avatar-image mb-2">
                        <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                    </div>
                    <div class="col-lg col-sm name-and-date ms-4">
                        <div><strong>Jamie Oliver</strong> <span class="review-text">wrote a review</span></div>
                        <div class="publication-date">11 September, 2020</div>
                    </div>
                </div>
                <div class="mt-4">
                    <div><strong>Rating:</strong> <i class="fas fa-star active ms-2"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star"></i></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                </div>
                <div class="card mb-2 mt-4 shadow-sm p-2 recipe-post-review">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://blog.myfitnesspal.com/wp-content/uploads/2017/12/Essential-Guide-to-Healthy-Eating-2-752x472.png" class="bd-placeholder-img recipe-image" width="100%">
                        </div>
                        <div class="col-md-8 p-3">
                            <h2 class="m-0 p-0 card-title">Cozido à Portuguesa</h2>
                            <p class="m-0 p-0"><small class="text-muted">4.6 <i class="fas fa-star active ms-2"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> <i class="fas fa-star active"></i> | 563 reviews</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group col-sm d-flex justify-content-center text-center">
                <button type="button" class="btn post-button">
                    <i class="fas fa-eye me-2"></i>
                    <span class="button-caption">View Recipe</span>
                </button>
                <button type="button" class="btn post-button">
                    <i class="fas fa-share-alt me-2"></i>
                    <span class="button-caption">Share</span>
                </button>
            </div>
        </div>
    <?php } 
?>

