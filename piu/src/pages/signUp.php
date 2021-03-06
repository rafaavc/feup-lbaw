<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Auth - https://developers.google.com/identity/sign-in/web/sign-in -->
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="../scripts/signIn.js" defer></script>
    <script src="../scripts/signUp.js" defer></script>

    <link href="signIn.css" rel="stylesheet">
    <link href="signUp.css" rel="stylesheet">
    <link href="../components/inputIcon.css" rel="stylesheet">
    <link href="../components/footer.css" rel="stylesheet">
    <link href="../components/nav.css" rel="stylesheet">
    <title>Sign Up</title>

</head>
<body>
    <?php include_once "../components/nav.php"; ?>
    <main>
        <div class="container py-5">
            <div class="row mt-3">
                <div class="col-xl-6 sign-img">
                    <div class="d-grid gap-2 col-6 mx-auto mt-5 sign-left-text w-100 text-center">
                        <div class="welcome-msg text-start">
                            <h1><strong>You're </strong>about to</h1>
                            <h1 class="text-center">be part of this</h1>
                            <h1 class="fw-bolder text-center">COMMUNITY</h1>
                            <button type="button" class="btn btn-dark w-100 mx-auto mt-4">Go Home</button>     
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 sign-form mt-5">
                    <div class="position-relative mb-5">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item position-absolute top-0 start-0 translate-middle" role="presentation">
                                <button active class="btn btn-secondary active rounded-pill" onClick="this.parentNode.parentNode.previousElementSibling.firstElementChild.style.width = '0%'; this.active = true;" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">1</button>
                            </li>
                            <li class="nav-item position-absolute top-0 start-50 translate-middle" role="presentation">
                                <button class="btn btn-secondary rounded-pill" onClick="this.parentNode.parentNode.previousElementSibling.firstElementChild.style.width = '50%'" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">2</button>
                            </li>
                            <li class="nav-item position-absolute top-0 start-100 translate-middle" role="presentation">
                                <button class="btn btn-secondary rounded-pill" onClick="this.parentNode.parentNode.previousElementSibling.firstElementChild.style.width = '100%'" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">3</button>
                            </li>
                        </ul>
                        <ul class="nav nav-pills position-relative" id="pills-tab" role="tablist">
                            <li class="position-absolute start-0 translate-middle" style="display: none">
                                <p>Recipe Information</p>
                            </li>
                            <li class="position-absolute start-50 translate-middle">
                                <p>Ingredients</p>
                            </li>
                            <li class="position-absolute start-100 translate-middle">
                                <p>Method</p>
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
                                <button type="button" class="btn btn-dark d-block">Sign Up</button>     
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
                                echo "<span class='d-block mt-4'>Repeat Password</span>";
                                inputIconLeft('lock'); 
                            ?>
                            <span class='d-block mt-4'>Profile Photo</span>
                            <img src="../images/noImage.png" class="rounded-circle mx-auto d-block file-input" alt="...">
                            <input type="file" name="myfile" class="d-none"></input>
                            <div class="d-grid gap-2 col-6 mx-auto my-2">
                                <button type="button" class="btn btn-dark d-block">Next</button>     
                            </div>
                        </div>
                        <div class="tab-pane fade pt-5" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="text-center">
                                <p><strong class="finish-msg">YOU'RE</strong></p>
                                <p><strong class="finish-msg">IN!</strong></p>
                                <img src="https://thumbs.gfycat.com/ShyCautiousAfricanpiedkingfisher-max-1mb.gif" alt="...">
                                <div class="d-grid gap-2 col-6 mx-auto mt-5">
                                    <button type="button" class="btn btn-dark d-block">Finish</button>     
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "../components/footer.php"; ?>              

</body>
</html>
