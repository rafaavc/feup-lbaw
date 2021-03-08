<?php function displayConversationCard($name, $content, $photo, $new=false) { ?>
    
    <div class="row notification-card g-5">
        <div class="col-3">
            <div class="small-profile-photo" style="background-image: url('<?=$photo?>')"></div>
        </div>
        <div class="col-9">
            <p><?=$new ? '<strong>' : ''?><?=$name?><?=$new ? '</strong>' : ''?></p>
            <p><small><?=$content?></small></p>
            <?php if($new) { ?>
                <div class="new-notification-indicator bg-primary"></div>
            <?php } ?>
        </div>
    </div>

<?php } ?>