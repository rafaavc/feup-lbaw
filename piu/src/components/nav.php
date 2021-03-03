<?php

// TODO:
// add hrefs in list
// add popover to notifications and messages

$menu = "member";

$visitor = [
    "sign in" => "sign-in-alt",
    "sign up" => "user-plus",
];

$member = [
    "notifications" => [
        "bell",
        "popover" => "test"
    ],
    "messages" => [
        "comments",
        "popover" => "test2"
    ],
    "john doe" => [
        "user-circle",
        [
            "my profile" => "address-card",
            "sign out" => "sign-out-alt"
        ]
    ]
];

$admin = [
    "reports" => "exclamation-triangle",
    "users" => "users",
    "john doe" => [
        "user-circle",
        [
            "my profile" => "address-card",
            "sign out" => "sign-out-alt"
        ]
    ]
];

function printMenu()
{
    global $menu;
    global $$menu;
    foreach ($$menu as $name => $icon) {
        $name = ucwords($name);
        if (is_array($icon))
            key_exists("popover", $icon) ? printPopover($name, $icon[0], $icon["popover"]) : printDropdown($name, $icon[0], $icon[1]);
        else
            printItem($name, $icon);
    }
}

function printPopover($name, $icon, $content)
{ ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-<?= $icon ?> d-none d-lg-inline"></i>
            <span class="legend"><?= $name ?></span>
        </a>
    </li>
<?php }

function printDropdown($name, $icon, $submenu)
{ ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-<?= $icon ?> d-none d-lg-inline"></i>
            <span class="legend"><?= $name ?></span>
            <i class="fas fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php foreach ($submenu as $name => $icon) printItem(ucwords($name), $icon, true) ?>
        </ul>
    </li>
<?php }

function printItem($name, $icon, $dropdown = false)
{ ?>
    <li class="<?= $dropdown ? "" : "nav-item" ?>">
        <a class="<?= $dropdown ? "dropdown-item" : "nav-link" ?>" href="#">
            <i class="fas fa-<?= $icon ?> d-none d-lg-inline"></i>
            <span class="legend"><?= $name ?></span>
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