<?php 
    $pageTitle = "Sign In | TasteBuds";
    $extraStyles = [ "../components/inputIcon.css", "signIn.css", "../components/breadcrumb.css" ];
    include_once "../components/breadcrumb.php";
    include_once "../components/docHeader.php";
    include_once "../components/nav.php"; 
?>
<main>
    <?php drawBreadcrumb([ "Sign In" ]); ?>
    <div class="container content-general-margin mt-2 margin-to-footer">
        <div class="row">
            <div class="col-xl-6 sign-img">
                <div class="d-grid gap-2 col-6 mx-auto mt-5 sign-left-text w-100 text-center">
                    <div class="welcome-msg">
                        <h1><strong>Welcome Back,</strong></h1>
                        <h3>Sign in to continue</h3>
                        <button type="button" class="btn btn-dark w-100 mx-auto mt-4">Go Home</button>     
                    </div>
                </div>
            </div>
            <div class="col-xl-6 sign-form mt-5">
                <h1>Sign In</h1>
                <h3>Please enter your account details.</h3>
                
                <?php
                    include_once "../components/inputIcon.php";
                    echo "<span class='d-block mt-4'>Email Address</span>";
                    inputIconLeft('envelope'); 
                    echo "<span class='d-block mt-4'>Password</span>";
                    inputIconLeft('lock'); 
                ?>

                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="button" class="btn btn-dark d-block">Sign In</button>     
                </div>
                <span class="d-block text-center mt-3">Don't have an account? &nbsp;<a href="#" class="signUp-a">Sign Up</a></span>
                <div class="separator mt-3">or</div>
                
                <div class="g-signin2" data-width="200"></div>  
            </div>
        </div>
    </div>
</main>
<?php 
    include_once "../components/footer.php";
    include_once "../components/docFooter.php"; 
?>
