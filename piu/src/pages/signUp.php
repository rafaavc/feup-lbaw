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
            </div>
        </div>
    </main>
    <?php include_once "../components/footer.php"; ?>              

</body>
</html>
