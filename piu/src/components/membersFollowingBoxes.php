
<!-- 
    AS THIS IS SUPPOSED TO BE IN THE LAYOUT GRID OF 
    THE GROUP/PROFILE PAGE, IT HAS NO PRE-IMPOSED RESTRICTIONS 
    ON WIDTH. THOSE RESTRICTIONS WILL BE IMPOSED BY THE GRID ITSELF. 

    THIS DEPENDS ON navPopups.css
-->

<?php function displayProfilePicture($photo, $name, $groupModerator) { 
    $button = "<button class='btn btn-danger btn-sm has-tooltip ms-3' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Remove user from group'><i class='fas fa-trash'></i></button>"; ?>
    <button class="btn small-profile-photo has-tooltip" style="background-image: url('<?=$photo?>')" data-bs-container="body" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?=$name.($groupModerator ? $button : "")?>"></button>
<?php } ?>  

<?php function displayPeopleBox($title, $groupModerator=false) { ?>
    <div class="card shadow-sm people-box">
        <div class="card-body">
            <h5 class="card-title mb-4"><?=$title?></h5>
            <div class="row g-5 mb-5">
                <div class="col">
                    <?= displayProfilePicture("https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1", "Sarah Colbert", $groupModerator); ?>
                </div>
                <div class="col">
                    <?= displayProfilePicture("https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.istockphoto.com%2Fphotos%2Fyoung-man-picture-id155602235%3Fk%3D6%26m%3D155602235%26s%3D612x612%26w%3D0%26h%3DpWOQoAJ5p8xzfTWuHMfwj6jCgwH393t2jVbdDeoLKwM%3D&f=1&nofb=1", "Ludwig Nascimento", $groupModerator); ?>
                </div>
                <div class="col">
                    <?= displayProfilePicture("https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F33614%2Fcooking-eat-cut-food.jpg%3Fauto%3Dcompress%26cs%3Dtinysrgb%26dpr%3D1%26w%3D500&f=1&nofb=1", "John Guy", $groupModerator); ?>
                </div>
                <div class="col">
                    <?= displayProfilePicture("https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic8.depositphotos.com%2F1059878%2F1065%2Fi%2F450%2Fdepositphotos_10650641-stock-photo-young-woman-enjoying-her-cooking.jpg&f=1&nofb=1", "Annah Guttenberg", $groupModerator); ?>
                </div>
                <div class="col">
                    <?= displayProfilePicture("https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fpbs.twimg.com%2Fprofile_images%2F558016134012624896%2FKdKrx0oC.jpeg&f=1&nofb=1", "Reneau Orteaux", $groupModerator); ?>
                </div>
                <div class="col">
                    <?= displayProfilePicture("https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fthumbs.dreamstime.com%2Fb%2Fgirl-winter-pijama-cooking-drinking-girl-winter-pijama-trying-to-cook-drinking-white-wine-105907111.jpg&f=1&nofb=1", "Arya Johnson", $groupModerator); ?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-secondary">
                <small><i class="fas fa-plus me-2"></i> See all <?= strtolower($title) ?></small>
            </button>
        </div>
    </div>
<?php } ?>
