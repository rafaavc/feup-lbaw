<?php
    include_once "components/icons.php";
    
    inputIconRight('search'); echo "<br><br>";
    inputIconLeft('email'); echo "<br><br>";
    inputIconRight('lock'); echo "<br><br>";
    inputIconRight('flag'); echo "<br><br>";
    inputIconLeft('location'); echo "<br><br>";

    
    function inputIconRight($iconName) { ?>
        <div class="d-inline-flex mb-3">
            <input type="text" class="form-control icon-right me-2" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <?= getIcon($iconName, "right"); ?>
        </div>
    <?php } ?>

    <?php function inputIconLeft($iconName) { ?>
        <div class="d-inline-flex mb-3">
            <?= getIcon($iconName, "left"); ?>
            <input type="text" class="form-control icon-left me-2" aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>
    <?php } ?>

