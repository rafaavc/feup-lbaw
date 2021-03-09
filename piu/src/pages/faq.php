<?php
include "../components/docHeader.php";
include "../components/breadcrumb.php";

$questions = [
    "How to share a recipe?" => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec posuere at tortor auctor dignissim. Curabitur quis metus vel nisl feugiat faucibus. Aenean dui libero, efficitur at tempus vel, pellentesque sed nibh. Cras at nisl efficitur, volutpat urna vitae, consequat purus. Pellentesque volutpat iaculis felis ut egestas. Nunc rhoncus mauris non turpis blandit accumsan. Vestibulum eu pharetra ipsum. Donec eu dolor sit amet sapien maximus tincidunt. Nullam dignissim felis et nunc venenatis commodo. Sed ut nibh id mauris ultricies pellentesque. In sodales luctus tristique. Maecenas luctus elementum vestibulum. Morbi sed massa quis magna lobortis ullamcorper.
    In ipsum tortor, pulvinar quis ligula eget, cursus venenatis augue. Nullam rhoncus volutpat odio eget hendrerit. Duis egestas volutpat metus vitae sollicitudin. Nam eu euismod est. Nulla tincidunt metus quis erat malesuada mattis. Cras nec lacus convallis, sollicitudin urna id, elementum tortor. Aenean fermentum efficitur turpis id dignissim. Sed ac fringilla dolor. Nulla a gravida neque, sit amet lacinia ipsum. Maecenas eget mattis dolor. Aenean sed libero at mi faucibus tempor quis ut tortor. Donec in vulputate ipsum. Aenean pulvinar ornare pellentesque. Sed non ornare est, ac gravida nisi. ",
    
    "How to post a recipe?" => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec posuere at tortor auctor dignissim. Curabitur quis metus vel nisl feugiat faucibus. Aenean dui libero, efficitur at tempus vel, pellentesque sed nibh. Cras at nisl efficitur, volutpat urna vitae, consequat purus. Pellentesque volutpat iaculis felis ut egestas. Nunc rhoncus mauris non turpis blandit accumsan. Vestibulum eu pharetra ipsum. Donec eu dolor sit amet sapien maximus tincidunt. Nullam dignissim felis et nunc venenatis commodo. Sed ut nibh id mauris ultricies pellentesque. In sodales luctus tristique. Maecenas luctus elementum vestibulum. Morbi sed massa quis magna lobortis ullamcorper.
    In ipsum tortor, pulvinar quis ligula eget, cursus venenatis augue. Nullam rhoncus volutpat odio eget hendrerit. Duis egestas volutpat metus vitae sollicitudin. Nam eu euismod est. Nulla tincidunt metus quis erat malesuada mattis. Cras nec lacus convallis, sollicitudin urna id, elementum tortor. Aenean fermentum efficitur turpis id dignissim. Sed ac fringilla dolor. Nulla a gravida neque, sit amet lacinia ipsum. Maecenas eget mattis dolor. Aenean sed libero at mi faucibus tempor quis ut tortor. Donec in vulputate ipsum. Aenean pulvinar ornare pellentesque. Sed non ornare est, ac gravida nisi. ",
    
    "How to edit a recipe?" => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec posuere at tortor auctor dignissim. Curabitur quis metus vel nisl feugiat faucibus. Aenean dui libero, efficitur at tempus vel, pellentesque sed nibh. Cras at nisl efficitur, volutpat urna vitae, consequat purus. Pellentesque volutpat iaculis felis ut egestas. Nunc rhoncus mauris non turpis blandit accumsan. Vestibulum eu pharetra ipsum. Donec eu dolor sit amet sapien maximus tincidunt. Nullam dignissim felis et nunc venenatis commodo. Sed ut nibh id mauris ultricies pellentesque. In sodales luctus tristique. Maecenas luctus elementum vestibulum. Morbi sed massa quis magna lobortis ullamcorper.
    In ipsum tortor, pulvinar quis ligula eget, cursus venenatis augue. Nullam rhoncus volutpat odio eget hendrerit. Duis egestas volutpat metus vitae sollicitudin. Nam eu euismod est. Nulla tincidunt metus quis erat malesuada mattis. Cras nec lacus convallis, sollicitudin urna id, elementum tortor. Aenean fermentum efficitur turpis id dignissim. Sed ac fringilla dolor. Nulla a gravida neque, sit amet lacinia ipsum. Maecenas eget mattis dolor. Aenean sed libero at mi faucibus tempor quis ut tortor. Donec in vulputate ipsum. Aenean pulvinar ornare pellentesque. Sed non ornare est, ac gravida nisi. ",
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