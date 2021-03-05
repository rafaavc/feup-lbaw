<?php 
    include(__DIR__ . "/conversationCard.php");
    include(__DIR__ . "/notificationCards.php"); 
?>

<button data-popover-content="#messagesPopupContent" class="btn btn-primary nav-popover position-relative" role="button" data-bs-placement="bottom" data-bs-toggle="popover">
    <i class="fas fa-envelope"></i>
    <div class="notif-quantity-indicator"><small>1</small></div>
</button>
<div id="messagesPopupContent" class="d-none">
    <ul class="p-0 m-0">
        <li class="card p-2 mb-2">
            <?= displayConversationCard("Sarah Colbert", "Sarah: That's nice!", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1", true); ?>
        </li>
        <li class="card p-2">
            <?= displayConversationCard("John Guy", "Okay bro.", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.istockphoto.com%2Fphotos%2Fyoung-man-picture-id155602235%3Fk%3D6%26m%3D155602235%26s%3D612x612%26w%3D0%26h%3DpWOQoAJ5p8xzfTWuHMfwj6jCgwH393t2jVbdDeoLKwM%3D&f=1&nofb=1"); ?>
        </li>
    </ul>
</div>

<button data-popover-content="#notificationsPopupContent" class="btn btn-primary nav-popover position-relative" role="button" data-bs-placement="bottom" data-bs-toggle="popover">
    <i class="fas fa-bell"></i>
    <div class="notif-quantity-indicator"><small>3</small></div>
</button>
<div id="notificationsPopupContent" class="d-none">
    <ul class="p-0 m-0">
        <li class="card p-2 mb-2">
            <?= displayFollowRequestCard("Ludwig Nascimento", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F33614%2Fcooking-eat-cut-food.jpg%3Fauto%3Dcompress%26cs%3Dtinysrgb%26dpr%3D1%26w%3D500&f=1&nofb=1", true); ?>
        </li>
        <li class="card p-2 mb-2">
            <?= displayRecipeReviewCard("Sarah Colbert", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1", true); ?>
        </li>
        <li class="card p-2 mb-2">
            <?= displayFollowRequestCard("Annah Guttenberg", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic8.depositphotos.com%2F1059878%2F1065%2Fi%2F450%2Fdepositphotos_10650641-stock-photo-young-woman-enjoying-her-cooking.jpg&f=1&nofb=1", true); ?>
        </li>
        <li class="card p-2">
            <?= displayFollowRequestCard("John Guy", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.istockphoto.com%2Fphotos%2Fyoung-man-picture-id155602235%3Fk%3D6%26m%3D155602235%26s%3D612x612%26w%3D0%26h%3DpWOQoAJ5p8xzfTWuHMfwj6jCgwH393t2jVbdDeoLKwM%3D&f=1&nofb=1"); ?>
        </li>
    </ul>
</div>

