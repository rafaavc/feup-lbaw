<?php
include "../components/docHeader.php";
include "../components/breadcrumb.php";

$questions = [
    "How to sign up" => "If you are a visitor and wants to create a new account in our site, you can sign up in any page, in the navbar there will be a button with the text \"Sign Up\", this will send you to a page where you can create a profile with your information.",

    "How to sign in?" => "If you are a visitor in the website, you can sign in in any page, in the navbar there will be a button with the text \"Sign In\", this will redirect you to a page where you can use your username and password to sign in.",

    "How does Google sign in and sign out works?" => "If you want to create an account in our site you can use Google to be your way in, that way you will not have a password on our website, the way to sign in your account would be via this Google account.",

    "Where is the homepage?" => "If you are in the site you can go to the homepage at any time using the breadcrumb (The path in the top of the page that gives your location on the website) or clicking on our logo on the top left corner of the page.",

    "How to search for something?" => "You can search for recipes, users, tags and groups. This can be achieved using our searchbox, on the top of the page a place to type your search will be available (mobile users need to click on the magnifying glass icon for it to appear), then after writing your search term you can press enter and you will see the search results.",

    "How to filter my search results?" => "After doing a search, you will see some filter inputs, you can use them to filter the results by category, tags, rating, ingredients, date, duration and difficulty, after you choose a filter your results will include or exclude as you ordered.",

    "How do I know more about the developers of this page?" => "Our website has an \"About\" page, where you can read information about this project and its developers, you can access it at any time using the link at the footer (the very bottom of the page).",

    "How to see a profile?" => "If the profile is public you can access it in various ways depending on where you see the user: <ul><li>If it's a user that appears as a result of a search you can just click on their name or profile picture</li><li>If you want to know more about a user that has made a recipe, on the information box of the recipe (the box at the top) you can click on the name of the user</li><li>If you want to know more about a user that made a comment you can just click on the name that appears immediatly above the comment</li></ul>",

    "How to see the reviews of a recipe?" => "You can't see ratings themselves, but if a user made a review they can justify it using the comment section, the rating of that user will appear bellow his/her name and you will have more infomration about the recipe.",

    "How to view a recipe?" => "If you are in a feed or search results page you can just click on the name of the recipe or its image and you will be redirected to the recipe page.",

    "How to see the frequently asked questions page?" => "This is not a good place to make this question, as you are already in it.",

    "How to share a recipe?" => "If you are in a recipe page and want to share it you can just go to the information box of that recipe and click on the button that says \"Share\", if you are on mobile you will only see the icon ",

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