<?php function displayFollowRequestCard($name, $photo, $new=false) { ?>
    
    <div class="row g-5">
        <div class="col-2">
            <div class="small-profile-photo" style="background-image: url('<?=$photo?>')"></div>
        </div>
        <div class="col-9">
            <?php if ($new) { ?>
                <div class="row g-2">
                    <div class="col-11"><?php } ?>
                        <p class="m-0"><?=$new ? '<strong>' : ''?><?=$name?> <?= $new ? "wants to follow you." : "started following you." ?><?=$new ? '</strong>' : ''?></p>
            <?php if ($new) { ?>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-outline-secondary follow-request-button"><small><i class="fas fa-check"></i></small></button>
                        <button class="btn btn-outline-secondary follow-request-button"><small><i class="fas fa-times"></i></small></button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php } ?>

<?php function displayRecipeReviewCard($name, $photo, $new=false) { ?>
    
    <div class="row notification-card g-5">
        <div class="col-2">
            <div class="small-profile-photo" style="background-image: url('<?=$photo?>')"></div>
        </div>
        <div class="col-9">
            <p><?=$new ? '<strong>' : ''?><?=$name?> reviewed your recipe.<?=$new ? '</strong>' : ''?></p>
            <?php if($new) { ?>
                <div class="new-notification-indicator bg-primary"></div>
            <?php } ?>
        </div>
    </div>

<?php } ?>

<?php function displayMemberRequestCard($name, $photo, $new=false) { ?>
    
    <div class="row g-3">
        <div class="col-2" style="max-width: 3.5rem">
            <div class="small-profile-photo" style="background-image: url('<?=$photo?>')"></div>
        </div>
        <div class="col-9">
            <?php if ($new) { ?>
                <div class="row g-4">
                    <div class="col-8"><?php } ?>
                        <p class="m-0"><?=$new ? '<strong>' : ''?><?=$name?> <?= $new ? "wants to join the group" : "" ?><?=$new ? '</strong>' : ''?></p>
            <?php if ($new) { ?>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-outline-secondary follow-request-button"><small><i class="fas fa-check"></i></small></button>
                        <button class="btn btn-outline-secondary follow-request-button"><small><i class="fas fa-times"></i></small></button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php } ?>