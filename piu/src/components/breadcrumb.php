<?php function drawBreadcrumb($pages, $withoutMargin = false) { 
    global $role;?>
    <nav style="--bs-breadcrumb-divider: '>';" class="<?php if ($withoutMargin) echo ''; else echo 'content-general-margin'; ?> margin-from-nav" aria-label="breadcrumb">
        <ol class="breadcrumb p-2"> 
            <i class="fas fa-home"></i>
            <li class="breadcrumb-item"><a href="<?=getRootUrl() . ($role == "visitor" ? "" : ($role == "admin" ? "/pages/reportsManagement.php" : "/pages/feed.php" ))?>">Home</a></li>
            <?php for($i = 0; $i < count($pages) - 1; $i++) { ?>
                <li class="breadcrumb-item"><a href="#"><?= $pages[$i] ?></a></li>
            <?php } ?>
            <li class="breadcrumb-item" aria-current="page"><a href="#"><?= end($pages) ?></a></li>
        </ol>
    </nav>
<?php } ?>
    

