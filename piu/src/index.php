<?php
    $pageTitle = "TasteBuds";
    $extraStyles = [ "pages/index.css" ];
    $index = true;
    include_once "components/docHeader.php";
    include_once "components/nav.php";
?>
<main class="margin-to-footer">
    <section>
        <div id="carouselExampleDark" class="carousel carousel-light slide carousel-fade"  data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <div class="carousel-inner">
                <div class="carousel-item home-slide content-general-padding active" style="background-image: url('images/image22.jpg')" data-bs-interval="2500">
                    <h2 class="display-4 mb-3 shadow"><strong>TasteBuds helps people build a community of</strong></h2>
                    <h2><div class="display-2 shadow"><strong>healthy</strong></div><div class="display-4 shadow"><strong>eating habits</strong></div></h2>
                </div>
                <div class="carousel-item home-slide content-general-padding" style="background-image: url('images/image21.jpg')" data-bs-interval="2500">
                    <h2 class="display-4 mb-3 shadow"><strong>TasteBuds helps people build a community of</strong></h2>
                    <h2><div class="display-2 shadow"><strong>diverse</strong></div><div class="display-4 shadow"><strong>eating habits</strong></div></h2>
                </div>
                <div class="carousel-item home-slide content-general-padding" style="background-image: url('images/image20.jpg'); background-position: 100% 70%" data-bs-interval="2500">
                    <h2 class="display-4 mb-3 shadow"><strong>TasteBuds helps people build a community of</strong></h2>
                    <h2><div class="display-2 shadow"><strong>tasty</strong></div><div class="display-4 shadow"><strong>eating habits</strong></div></h2>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="content-general-margin">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="d-flex flex-column bd-highlight align-items-lg-end content-align">
                        <h2><strong>Find awesome new recipes</strong></h2>
                        <div class="bd-highlight">Impress your peers with your</div>
                        <div class="bd-highlight">awesome new dishes!</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="images/findRecipes.jpg" class="d-block w-75 h-100" alt="...">
                </div>
            </div>
            <hr class="mt-5 w-100">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <img src="images/shareRecipes.jpg" class="d-block float-end w-75 h-100" alt="...">
                </div>
                <div class="col-lg-6">
                    <div class="d-flex flex-column bd-highlight content-align">
                        <h2><strong>Share your recipes</strong></h2>
                        <div class="bd-highlight">Share your favourite</div>
                        <div class="bd-highlight">recipes with the world!</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content-red sign-up-call-to-action">
            <div class="col-lg-6">
                <div class="d-flex flex-column bd-highlight align-items-lg-end p-4 text-white">
                        <strong class="fs-1">Sign Up</strong>
                        <div class="bd-highlight fs-4">Start connecting now</div>   
                </div>
            </div>
            <div class="col-lg-6 content-align p-5">
                <a href="<?=getRootUrl()."/pages/signUp.php"?>" role="button" class="btn btn-light btn-lg btn-large d-inline-block">Let's do it!</a>     
            </div>
        </div>
        <div class="row cards-homepage content-general-margin">
            <div class="row mt-5 text-center">
                <h1><strong>Find New Friends</strong></h3>
                <p>Connect with new people!</p>
            </div>
            <div class="card-group text-center">
                <div class="col-md my-3 me-3">
                    <div class="card h-100">
                        <img src="images/follow.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Follow</h5>
                            <p class="card-text">Follow people to get updates about them and the new recipes they publish!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md my-3 me-3">
                    <div class="card h-100">
                        <img src="images/group.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Group</h5>
                            <p class="card-text">Create or join private or public groups!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md my-3">
                    <div class="card h-100">
                        <img src="images/chat.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Chat</h5>
                            <p class="card-text">Need more information? Want to know the person behind the recipe? Send them a message!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php 
    include_once "components/footer.php"; 
    include_once "components/docFooter.php"; 
?>