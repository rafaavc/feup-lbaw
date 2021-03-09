<?php

    // displayRecipe(true); // Recipe - Visitor 
    // displayRecipe(false); // Recipe - Owner
    // displayReview(true); // Review - Visitor
    // displayReview(false); // Review - Owner
    

    function displayRecipe($isVisitor = true) { ?>
        <div class="card recipe-post mt-5">


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
                <div class="col-sm avatar-image mb-2">
                    <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                </div>
                <div class="col-lg col-sm name-and-date">
                    <div class="row mb-1 username">Jamie Oliver</div>
                    <div class="row publication-date">11 September, 2020</div>
                </div>
            </div>

            <div class="container mt-3 mb-1 p-0 ">
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Vegetarian
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Low carb
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Low carb
                </a>
                <a role="button" class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-3" href="<?=getRootUrl(). "/pages/category.php"?>">
                    Low carb
                </a>
                
            </div>

            <div class="recipe-post-inner">
                <div class="card p-2 shadow" style="max-width: 1000px; border: 0;">
                    <div class="row" style="min-height: 300px;">
                        <div class="col-md-4 post-image">
                            <img src="https://blog.myfitnesspal.com/wp-content/uploads/2017/12/Essential-Guide-to-Healthy-Eating-2-752x472.png" class="bd-placeholder-img recipe-image-big" height="300px" width="100%">
                        </div>
                        <div class="col-md-8 w-50 text-recipe">
                            <div class="text-recipe p-1">
                                <h2 class="card-title">Cozido à Portuguesa</h2>
                                <p class="card-text post-description">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                <p><small class="text-muted">4.6 ⭐⭐⭐⭐⭐ | 563 reviews</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="btn-group col-sm d-flex justify-content-center text-center">
                <button type="button" class="btn btn-light btn-lg post-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-heart-fill mx-3" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                    <span class="button-caption">Add to Favourites</span>
                </button>
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

    function displayReview($isVisitor) { ?>
        <div class="container recipe-post mt-5">
            <div class="col-sm post-options">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                        </svg>

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php if($isVisitor) { ?>
                            <li><a class="dropdown-item" href="#">Report Review</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="#">Edit Review</a></li>
                            <li><a class="dropdown-item" href="#">Delete Review</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row user-info">
                <div class="col-sm avatar-image mb-2">
                    <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                </div>
                <div class="col-lg col-sm name-and-date">
                    <div class="row username w-100"><span class="d-inline w-auto p-0 me-2">Jamie Oliver</span><span class="d-inline w-auto text-start p-0 review-text">wrote a review</span></div>
                    <!-- <div class="row mt-0 text-muted">wrote a review</span> -->
                    <div class="row publication-date">11 September, 2020</div>
                </div>
                <!-- <div class="col name-and-date">
                    <div class="row mb-1 name-and-date">
                        <span class="m-0 p-0 username">Jamie Oliver</span>
                        <span class="m-0 p-0 action text-muted">wrote a review</span>
                    </div>
                    <div class="row publication-date">11 September, 2020</div>
                </div> -->
            </div>
            <blockquote class="blockquote mt-2 card-body shadow p-3 mb-5 mx-5 p-4 bg-white rounded">
                <div class="row rating ms-1 mb-2">⭐⭐⭐⭐⭐</div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            </blockquote>
            <div class="recipe-post-inner-in-review">
                <div class="card mb-4 mx-4 shadow p-2" style="max-width: 800px; max-height: 150px; border: 0;">
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

