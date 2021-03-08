<?php

    $pages = [
        "Home", "My Profile", "Reviews"
    ];

    drawBreadcrumb($pages);

    function drawBreadcrumb($pages) { ?>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb p-2 content-general-margin"> 
                <i class="fas fa-home"></i>
                <?php for($i = 0; $i < count($pages) - 1; $i++) { ?>
                    <li class="breadcrumb-item"><a href="#"><?= $pages[$i] ?></a></li>
                <?php } ?>
                <li class="breadcrumb-item" aria-current="page"><a href="#"><?= end($pages) ?></a></li>
            </ol>
        </nav>
    <?php } 
?>
    

