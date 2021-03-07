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
    <script src="../scripts/createRecipe.js" defer></script>
    <script src="../scripts/progressBar.js" defer></script>

    <link href="createRecipe.css" rel="stylesheet">
    <link href="../components/footer.css" rel="stylesheet">
    <link href="../components/nav.css" rel="stylesheet">

    <title>Sign Up</title>

</head>
<body>
    <?php include_once "../components/nav.php"; ?>
    <h1 id="pageTitle">Create Recipe</h1>
    <div id="create-recipe-stepper" class="card p-4">
        <div class="card-body">
            <div class="position-relative mt-4">
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
                        <p class="progress-caption text-center">Recipe Information</p>
                    </li>
                    <li class="position-absolute start-50 translate-middle d-none next-step">
                        <p class="progress-caption text-center">Ingredients</p>
                    </li>
                    <li class="position-absolute start-100 translate-middle d-none next-step">
                        <p class="progress-caption text-center">Method</p>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h3 class="mb-4">Recipe Information</h3>
                    <div class="row g-3 mb-3">
                        <div class="col-lg">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes">
                                <label for="floatingInput">Recipe title</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelectGrid" aria-label="Main category">
                                    <option selected>-</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelectGrid">Main category</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 5rem"></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-lg">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes">
                                <label for="floatingInput">Tags</label>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelectGrid" aria-label="Difficulty">
                                    <option selected>-</option>
                                    <option value="1">Easy</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Hard</option>
                                </select>
                                <label for="floatingSelectGrid">Difficulty</label>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingInput" placeholder="Baked Potatoes">
                                <label for="floatingInput">Number of servings</label>
                            </div>
                        </div>
                    </div>

                    <h6 class="mb-3">End Product Photos</h6>
                    <input type="file" class="form-control mb-3">

                    <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <h3 class="mb-4">Ingredients</h3>

                    <?php include(__DIR__.'/../components/createRecipeIngredientRow.html'); ?>

                    <button type="button" class="btn btn-secondary" id="addIngredientButton"><i class="fas fa-plus"></i> Add Ingredient</button>
                    <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h3 class="mb-4">Method</h3>

                    <span class="d-block mb-3"><h5 class="d-inline">Duration</h6> <small>(in minutes)</small></span>
                    <div class="row g-3">
                        <div class="col-lg">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="preparationTime" placeholder="Preparation Time">
                                <label for="preparationTime">Preparation</label>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="cookingTime" placeholder="Cooking Time">
                                <label for="cookingTime">Cooking</label>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="additionalTime" placeholder="Additional Time">
                                <label for="additionalTime">Additional</label>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-5 mb-4">Steps</h4>
                    
                    <h5 class="mb-3">Step 1</h5>                
                    <?php include(__DIR__ . '/../components/createRecipeMethodStep.html'); ?>

                    <button type="button" class="btn btn-secondary" id="addStepButton"><i class="fas fa-plus"></i> Add Step</button>
                    <button type="button" class="btn btn-primary next-step" style="float: right;">Create Recipe</button>

                </div>  
            </div>
        </div>
    </div>
    <?php include_once "../components/footer.php"; ?> 
</body>
</html>
