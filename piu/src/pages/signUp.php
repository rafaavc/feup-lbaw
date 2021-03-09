<?php 
    $pageTitle = "Sign Up | TasteBuds";
    $extraStyles = [ "../components/inputIcon.css", "signUp.css", "signIn.css", "../components/breadcrumb.css" ];
    $extraScripts = [ "../scripts/signUp.js", "../scripts/progressBar.js" ];
    include_once "../components/breadcrumb.php";
    include_once "../components/docHeader.php";
    include_once "../components/nav.php"; 
?>
<main>
    <?php drawBreadcrumb([ "Sign Up" ]); ?>
    <div class="container content-general-margin mt-2">
        <div class="row">
            <div class="col-xl-6 sign-img">
                <div class="d-grid gap-2 col-6 mx-auto mt-5 sign-left-text w-100 text-center">
                    <div class="welcome-msg text-start">
                        <h1><strong>You're </strong>about to</h1>
                        <h1 class="text-center">be part of this</h1>
                        <h1 class="fw-bolder text-center">COMMUNITY</h1>
                        <a href="<?=getRootUrl()?>" role="button" class="btn btn-dark w-100 mx-auto mt-4">Go Home</a>     
                    </div>
                </div>
            </div>
            <div class="col-xl-6 sign-form">
                <div class="position-relative d-none sign-up-stepper">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item position-absolute top-0 start-0 translate-middle" role="presentation">
                            <button active class="btn btn-primary active rounded-pill" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">1</button>
                        </li>
                        <li class="nav-item position-absolute top-0 start-50 translate-middle" role="presentation">
                            <button disabled class="btn btn-primary rounded-pill" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">2</button>
                        </li>
                        <li class="nav-item position-absolute top-0 start-100 translate-middle" role="presentation">
                            <button disabled class="btn btn-primary rounded-pill" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">3</button>
                        </li>
                    </ul>
                    <ul class="nav nav-pills position-relative" id="pills-tab" role="tablist">
                        <li class="position-absolute start-0 translate-middle d-none next-step">
                            <p class="progress-caption text-center">Account Info</p>
                        </li>
                        <li class="position-absolute start-50 translate-middle d-none next-step">
                            <p class="progress-caption text-center">Personal Info</p>
                        </li>
                        <li class="position-absolute start-100 translate-middle d-none next-step">
                            <p class="progress-caption text-center">Finish!</p>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <h1>Sign Up</h1>
                        <h3>Please enter your account details.</h3>
                        
                        <?php
                            include_once "../components/inputIcon.php";
                            echo "<span class='d-block mt-4'>Username</span>";
                            inputIconLeft('user'); 
                            echo "<span class='d-block mt-4'>Email Address</span>";
                            inputIconLeft('envelope'); 
                            echo "<span class='d-block mt-4'>Password</span>";
                            inputIconLeft('lock'); 
                            echo "<span class='d-block mt-4'>Repeat Password</span>";
                            inputIconLeft('lock'); 
                        ?>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="button" class="btn btn-primary d-block next-step" id="first-step">Sign Up</button>     
                        </div>
                        <span class="d-block text-center mt-3">Already have an account? &nbsp;<a href="#" class="signUp-a">Sign In</a></span>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h1>Sign Up</h1>
                        <h3>Please enter your personal details.</h3>
                        <?php
                            echo "<span class='d-block mt-4'>Name</span>";
                            inputIconLeft('user'); 
                            echo "<span class='d-block mt-4'>Country</span>";
                            inputIconLeft('flag'); 
                            echo "<span class='d-block mt-4'>City</span>";
                            inputIconLeft('map-marker-alt'); 
                        ?>
                        <span class='d-block mt-4'>Profile Photo</span>
                        <img src="../images/noImage.png" class="rounded-circle mx-auto d-block file-input" alt="...">
                        <input type="file" name="myfile" class="d-none"></input>
                        <div class="d-grid gap-2 col-6 mx-auto my-2">
                            <button type="button" class="btn btn-primary d-block mt-3 next-step">Next</button>     
                        </div>
                    </div>
                    <div class="tab-pane fade pt-5" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="text-center">
                            <p class="mb-5"><strong class="finish-msg">YOU'RE IN!</strong></p>
                            <img src="https://thumbs.gfycat.com/ShyCautiousAfricanpiedkingfisher-max-1mb.gif" alt="...">
                            <div class="d-grid gap-2 col-6 mx-auto mt-5">
                                <a href="<?=getRootUrl()."/pages/feed.php"?>" role="button" class="btn btn-primary d-block">Finish</a>     
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</main>
<?php 
    include_once "../components/footer.php"; 
    include_once "../components/docFooter.php";
?>
