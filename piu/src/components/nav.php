<?php

// TODO:
// add popover to notifications and messages

$menu = "member";

$visitor = [
    "sign in" => [
        "icon" => "sign-in-alt",
        "href" => "signin"
    ],
    "sign up" => [
        "icon" => "user-plus",
        "href" => "signup"
    ]
];

$dropdown = [
    "my profile" => [
        "icon" => "address-card",
        "href" => "profile"
    ],
    "sign out" => [
        "icon" => "sign-out-alt",
        "href" => "signout"
    ]
];

$member = [
    "notifications" => [
        "icon" => "bell",
        "popover" => "test",
        "content" => "This is the content of the first popover"
    ],
    "messages" => [
        "icon" => "comments",
        "popover" => "test2",
        "content" => "This is the content of the second popover"
    ],
    "john doe" => [
        "icon" => "user-circle",
        "drop" => $dropdown
    ]
];

$admin = [
    "reports" => [
        "icon" => "exclamation-triangle",
        "href" => "reports"
    ],
    "users" => [
        "icon" => "users",
        "href" => "users"
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
        $name = ucwords($name);
        if (key_exists("popover", $attributes)) {
            printPopover($name, $attributes["icon"], $attributes["popover"], $attributes["content"]);
        } elseif (key_exists("drop", $attributes)) {
            printDropdown($name, $attributes["icon"], $attributes["drop"]);
        } else {
            printItem($name, $attributes["icon"], $attributes["href"]);
        }
    }
}

function printIconText($icon, $text, $caret = false)
{ ?>
    <i class="fas fa-<?= $icon ?> d-none d-lg-inline"></i>
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

function printPopover($name, $icon, $content)
{ ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <?php printIconText($icon, $name) ?>
        </a>
    </li>
<?php }

?>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div id="navbarContainer" class="container-fluid justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand flex-lg-grow-1 normalize" href="#">TasteBuds</a>

        <!-- Togglers -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" data-bs-parent="#navbarContainer" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle searchbox">
            <i class="fas fa-search"></i>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" data-bs-parent="#navbarContainer" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Search box -->
        <div class="collapse navbar-collapse justify-content-center flex-grow-1 normalize" id="navbarSearch" data-bs-parent="#navbarContainer">
            <form>
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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