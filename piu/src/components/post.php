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
                <button type="button" class="btn btn-light post-button" onClick="this.firstElementChild.style.color = 'var(--accent-color)'">
                    <i class="fas fa-heart me-2"></i>
                    <span class="button-caption">Add to Favourites</span>
                </button>
                <button type="button" class="btn btn-light post-button">
                    <i class="fas fa-eye me-2"></i>
                    <span class="button-caption">View Recipe</span>
                </button>
                <button type="button" class="btn btn-light post-button">
                    <i class="fas fa-share-alt me-2"></i>
                    <span class="button-caption">Share</span>
                </button>
            </div>
        </div>
    <?php }

    function displayReview($isVisitor) { ?>
        <div class="card recipe-post">
            <div class="col-sm post-options">
                <div class="dropdown">
                    <button type="button" class="btn edit-photo-button float-end me-2 mt-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> 
                        <?php if($isVisitor) { ?>
                            <li><a class="dropdown-item" href="#">Report Review</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="#">Report Review</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="card-body">

            <div class="row user-info">
                <div class="col-sm avatar-image mb-2">
                    <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                </div>
                <div class="col-lg col-sm name-and-date">
                    <div class="row username w-100"><span class="d-inline w-auto p-0 me-2">Jamie Oliver</span><span class="d-inline w-auto text-start p-0 review-text">wrote a review</span></div>
                    <div class="row publication-date">11 September, 2020</div>
                </div>
            </div>
            <blockquote class="blockquote mt-2 card-body shadow p-3 mb-5 bg-white rounded">
                <div class="row rating">⭐⭐⭐⭐⭐</div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            </blockquote>
            <div class="recipe-post-inner-in-review mb-0">
                <div class="card mb-0 mx-4 shadow p-2" style="max-width: 800px; max-height: 150px; border: 0;">
                    <div class="row" style="min-height: 130px;">
                        <div class="col-4">
                            <img src="https://blog.myfitnesspal.com/wp-content/uploads/2017/12/Essential-Guide-to-Healthy-Eating-2-752x472.png" class="bd-placeholder-img recipe-image" height="130px" width="100%">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h2 class="card-title">Cozido à Portuguesa</h2>
                                <p><small class="text-muted">4.6 ⭐⭐⭐⭐⭐ | 563 reviews</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="btn-group col-sm d-flex justify-content-center text-center">
                <button type="button" class="btn btn-light btn-lg post-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle mx-3" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg> 
                    <span class="button-caption">See Post</span>
                </button>
                <button type="button" class="btn btn-light btn-lg post-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-share mx-3" viewBox="0 0 16 16">
                        <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                    </svg>
                    <span class="button-caption">Share</span>
                </button>
            </div>
        </div>
    <?php } 
?>

