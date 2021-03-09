<?php
include "../components/docHeader.php";
include "../components/breadcrumb.php";

$questions = [
    "How to print a recipe?" => "If you open a recipe in the upper part there will be an text that says \"share\", if you are using a mobile dispositive, then only the icon of a printer will be seen.",
    
    "How to post a recipe?" => "You can post recipes in two ways, either go to your feed or to your profile page, in both pages there will be a green button to create a recipe.",
    
    "How to edit a recipe?" => "To edit a recipe you must go to the recipe page, if you're the author a button with the text \"edit\" will appear, if you are using a mobile dispositive, then only the icon of a pencil and papper will be seen.",
];


function printFAQ($id, $name, $text)
{ ?>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$id?>" aria-expanded="false" aria-controls="collapse<?=$id?>">
                <?= $name ?>
            </button>
        </h2>
        <div id="collapse<?=$id?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <?= $text ?>
            </div>
        </div>
    </div>
<?php }

?>

<body>
    <?php
    include "../components/nav.php";
    drawBreadcrumb(["FAQ"]);
    ?>
    <div class="accordion content-general-margin" id="accordionExample">
        <?php
        $i = 0;
        foreach ($questions as $name => $text)
            printFAQ($i++, $name, $text);
        ?>
    </div>
</body>

<?php
include "../components/docFooter.php";
?>