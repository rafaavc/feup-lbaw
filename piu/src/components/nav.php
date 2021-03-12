<?php

include_once(__DIR__."/conversationCard.php");
include_once(__DIR__."/notificationCards.php");

function getRootUrl() {
    return "http://".$_SERVER['HTTP_HOST'];
}

// TODO:
// add popover to notifications and messages
$role = isset($role) ? $role : "visitor";
$menu = $role;

$visitor = [
    "sign in" => [
        "icon" => "sign-in-alt",
        "href" => getRootUrl()."/pages/signIn.php"
    ],
    "sign up" => [
        "icon" => "user-plus",
        "href" => getRootUrl()."/pages/signUp.php"
    ]
];

$dropdown = [
    "my profile" => [
        "icon" => "address-card",
        "href" => getRootUrl()."/pages/profile.php"
    ],
    "sign out" => [
        "icon" => "sign-out-alt",
        "href" => getRootUrl()
    ]
];

$member = [
    "notifications" => [
        "icon" => "bell",
        "popover" => "This is the content of the first popover"
    ],
    "messages" => [
        "icon" => "comments",
        "popover" => "This is the content of the second popover"
    ],
    "john doe" => [
        "icon" => "user-circle",
        "drop" => $dropdown
    ]
];

$admin = [
    "reports" => [
        "icon" => "exclamation-triangle",
        "href" => getRootUrl()."/pages/reportsManagement.php"
    ],
    "users" => [
        "icon" => "users",
        "href" => getRootUrl()."/pages/usersManagement.php"
    ],
    "john doe" => [
        "icon" => "user-circle",
        "drop" => $dropdown
    ]
];

function printMenu()
{
    global $menu;
    global $$menu;
    foreach ($$menu as $name => $attributes) {
        if (key_exists("popover", $attributes)) {
            if ($name == "notifications") {
                printNotificationsPopover();
            } else if ($name == "messages") {
                printMessagesPopover();
            }
        } elseif (key_exists("drop", $attributes)) {
            $name = ucwords($name);
            printDropdown($name, $attributes["icon"], $attributes["drop"]);
        } else {
            $name = ucwords($name);
            printItem($name, $attributes["icon"], $attributes["href"]);
        }
    }
}

function printIconText($icon, $text, $caret = false)
{ ?>
    <i class="fas fa-<?= $icon ?> d-none d-lg-inline ms-3"></i>
    <span class="legend"><?= $text ?></span>
    <?php
    if ($caret) { ?>
        <i class="fas fa-caret-down"></i>
    <?php }
}

function printDropdown($name, $icon, $submenu)
{ ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php printIconText($icon, $name, true) ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php foreach ($submenu as $name => $attributes) printItem(ucwords($name), $attributes["icon"], $attributes["href"], true) ?>
        </ul>
    </li>
<?php }

function printItem($name, $icon, $link, $dropdown = false)
{ ?>
    <li class="<?= $dropdown ? "" : "nav-item" ?>">
        <a class="<?= $dropdown ? "dropdown-item" : "nav-link" ?>" href="<?= $link ?>">
            <?php printIconText($icon, $name) ?>
        </a>
    </li>
<?php }

function printMessagesPopover()
{ ?>
    <li class="nav-item">
        <button data-popover-content="#messagesPopupContent" class="btn btn-primary btn-sm mt-2 nav-popover position-relative" role="button" data-bs-placement="bottom" data-bs-toggle="popover">
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
            <a href="<?=getRootUrl()."/pages/privateMessages.php"?>" role="button" class="btn btn-outline-secondary mt-2 btn-sm">
                <i class="fas fa-plus me-2"></i> View all messages
            </a>
        </div>
    </li>
<?php }

function printNotificationsPopover()
{ ?>
    <li class="nav-item">
        <button data-popover-content="#notificationsPopupContent" class="btn btn-primary btn-sm mt-2 me-4 nav-popover position-relative" role="button" data-bs-placement="bottom" data-bs-toggle="popover">
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
    </li>
<?php }


?>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light content-general-padding">
    <div id="navbarContainer" class="container-fluid justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand flex-lg-grow-1 normalize" href="<?=getRootUrl() . ($role == "visitor" ? "" : ($role == "admin" ? "/pages/reportsManagement.php" : "/pages/feed.php" ))?>">
            <img class="logo" src="<?=isset($index) ? "." : ".." ?>/images/tastebuds-dark.png" height="50px" />
        </a>

        <!-- Togglers -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" data-bs-parent="#navbarContainer" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle searchbox">
            <i class="fas fa-search"></i>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" data-bs-parent="#navbarContainer" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Search box -->
        <div class="collapse navbar-collapse justify-content-center flex-grow-1 normalize" id="navbarSearch" data-bs-parent="#navbarContainer">
            <form action="<?=getRootUrl()."/pages/search.php"?>">
                <div class="d-flex">
                    <input type="text" class="form-control icon-right" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <i class="fas fa-search fa-icon-right"></i>
                </div>
            </form>
        </div>

        <!-- Right buttons -->
        <div class="collapse navbar-collapse justify-content-end flex-grow-1 normalize" id="navbarText" data-bs-parent="#navbarContainer">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php printMenu() ?>
            </ul>
        </div>
    </div>
</nav>