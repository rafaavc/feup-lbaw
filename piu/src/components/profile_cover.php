<header class="cover">
    <img src="https://images-prod.healthline.com/hlcmsresource/images/AN_images/vegetarian-diet-plan-1296x728-feature.jpg" class="cover-image" alt="...">
    <div class="card shadow-sm px-3">
        <div class="row g-0 p-3 text-center text-md-start" style="">
            <div class="col-md-2 image-container">
                <img class="rounded-circle mx-auto" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" alt="..." style="border: 0">
            </div>
            <div class="col-md-6 ms-md-4 card-body m-0">
                <h1 class="card-title">Jamie Oliver</h1>
                <p class="card-text">Sushi chef | Sushisan</p>
                <table class="table table-borderless lh-1">
                    <tr>
                        <td>Recipes</td>
                        <td>Followers</td>
                        <td>Following</td>
                    </tr>
                    <tr>
                        <td>1213</td>
                        <td>102</td>
                        <td>30</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3 card-body text-md-end m-0">
                <div class="btn-group" role="group" aria-label="">
                    <?php if ($owner) { ?>
                        <a href="<?= getRootUrl() . "/pages/edit_profile.php" ?>" class=" btn btn-outline-dark"><i class="fas fa-edit"></i>Edit</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-outline-dark"><i class="fas fa-user-plus"></i>Follow</button>
                        <button type="button" class="btn btn-outline-dark"><i class="fas fa-comments"></i>Chat</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row" style="position: relative; bottom: -1px">
            <div class="rating-box col-md-3 order-md-2 text-center mb-3 mb-md-0">
                <span class="small d-block">Average rating</span>
                <div class="rating">
                    <span class="value me-1">3.3</span>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <ul class="nav nav-tabs col-md-9 ps-md-3">
                <li class="nav-item">
                    <a class="nav-link <?=!isset($section) ? "active" : "" ?>" aria-current="page" href="<?=getRootUrl()?>/pages/profile.php">Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=isset($section) && $section == 2 ? "active" : ""?>" href="<?=getRootUrl()?>/pages/profile_reviews.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=isset($section) && $section == 3 ? "active" : ""?>" href="<?=getRootUrl()?>/pages/profile_favourites.php">Favourites</a>
                </li>
            </ul>
        </div>
    </div>
</header>