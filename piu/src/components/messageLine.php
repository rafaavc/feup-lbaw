<?php function displayMessageLine($msg, $position, $photo=null) { 
    $n = $position*2;
    if ($photo) { ?>
        <div class="row g-3 position-absolute message-line" style="bottom: <?= $n === 0 ? 0 : $n."rem" ?>">
            <div class="col-2" style="width: 4.5rem;">
                <div class="small-profile-photo" style="background-image: url('<?=$photo?>')"></div>
            </div>
            <div class="col-9">
                <p class="m-0 message-other message-line-content"><?=$msg?></p>
            </div>
        </div>
    <?php } else { ?>
        <div class="position-absolute message-line" style="right: 0; bottom: <?= $n."rem" ?>">
            <p class="m-0 message-line-content message-own"><?=$msg?></p>
        </div>
    <?php }
    } ?>