<?php 
    $role = "member";
    $pageTitle = "Edit Recipe / TasteBuds";
    $extraStyles = [ "createRecipe.css", "../components/breadcrumb.css" ];
    $extraScripts = [ "../scripts/progressBar.js", "../scripts/createRecipe.js" ];
    include_once "../components/breadcrumb.php"; 
    include_once "../components/docHeader.php"; 
    include_once "../components/breadcrumb.php"; 
    include_once "../components/nav.php"; 
?>

<?php drawBreadcrumb(["Recipes", "Desserts", "Classic Tiramisu", "Edit Recipe"]); ?>
<h1 id="pageTitle" class="content-general-margin mt-3">Edit Recipe</h1>
<div id="create-recipe-stepper" class="content-general-margin mt-4 margin-to-footer card p-4">
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
                    <p class="progress-caption text-center">Information</p>
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
                            <input type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="Classic Tiramisu">
                            <label for="floatingInput">Recipe title <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelectGrid" aria-label="Main category">
                                <option>-</option>
                                <option selected value="1">Dessert</option>
                                <option value="2">Main Dish</option>
                                <option value="3">Snack</option>
                            </select>
                            <label for="floatingSelectGrid">Main category <span class='form-required'></span></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 7rem">Classic Italian dessert made with ladyfingers and mascarpone cheese. It can be made in a trifle bowl or a springform pan.</textarea>
                    <label for="floatingTextarea2">Description <span class='form-required'></span></label>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="Low carb, Vegetarian">
                            <label for="floatingInput">Tags <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelectGrid" aria-label="Difficulty">
                                <option>-</option>
                                <option value="1">Easy</option>
                                <option selected value="2">Medium</option>
                                <option value="3">Hard</option>
                            </select>
                            <label for="floatingSelectGrid">Difficulty <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" placeholder="Baked Potatoes" value="3">
                            <label for="floatingInput">Number of servings <span class='form-required'></span></label>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 d-inline-block">End Product Photos</h6> <span class='form-required'></span>
                <input type="file" class="form-control mb-3">

                <h6 class="mb-3 d-inline-block">Visibility</h6> <span class='form-required'></span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Public
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Private
                    </label>
                </div>

                <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h3 class="mb-4">Ingredients</h3>
                
                <?php 
                    $quantity = 6; $name = "egg yolks";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php'); 
                    $quantity = 1.25; $unit = 2; $name = "white sugar";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php');
                    $quantity = 1.25; $unit = 2; $name = "mascarpone cheese";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php');
                    $quantity = 1.75; $unit = 2; $name = "heavy whipping cream";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php');
                    $quantity = 0.33; $unit = 2; $name = "coffee flavored liqueur";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php');
                    $quantity = 12; $unit = 3; $name = "ladyfingers";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php');
                    $quantity = 1; $unit = 1; $name = "unsweetened cocoa powder";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php');
                    $quantity = 1; $unit = 3; $name = "square semisweet chocolate";
                    include(__DIR__.'/../components/createRecipeIngredientRow.php');
                ?>

                <button type="button" class="btn btn-secondary" id="addIngredientButton"><i class="fas fa-plus"></i> Add Ingredient</button>
                <button type="button" class="btn btn-primary next-step" style="float: right;">Next</button>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="mb-4">Method</h3>

                <span class="d-block mb-3"><h5 class="d-inline">Duration</h6> <small>(in minutes)</small></span>
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="preparationTime" placeholder="Preparation Time" value="15">
                            <label for="preparationTime">Preparation <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="cookingTime" placeholder="Cooking Time" value="30">
                            <label for="cookingTime">Cooking <span class='form-required'></span></label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="additionalTime" placeholder="Additional Time" value="0">
                            <label for="additionalTime">Additional</label>
                        </div>
                    </div>
                </div>

                <h4 class="mt-5 mb-4">Steps</h4>
                
                <h5 class="mb-3">Step 1</h5>                
                <?php 
                    $name = "Step 1"; $description = "Combine egg yolks and sugar in the top of a double boiler, over boiling water. Reduce heat to low, and cook for about 10 minutes, stirring constantly. Remove from heat and whip yolks until thick and lemon colored.";
                    include(__DIR__ . '/../components/createRecipeMethodStep.php'); 
                ?>
                <h5 class="mb-3">Step 2</h5>                
                <?php 
                    $name = "Step 2"; $description = "Add mascarpone to whipped yolks. Beat until combined. In a separate bowl, whip cream to stiff peaks. Gently fold into yolk mixture and set aside.";
                    include(__DIR__ . '/../components/createRecipeMethodStep.php'); 
                ?>
                <h5 class="mb-3">Step 3</h5>                
                <?php 
                    $name = "Step 3"; $description = "Split the lady fingers in half, and line the bottom and sides of a large glass bowl. Brush with coffee liqueur. Spoon half of the cream filling over the lady fingers. Repeat ladyfingers, coffee liqueur and filling layers. Garnish with cocoa and chocolate curls. Refrigerate several hours or overnight.";
                    include(__DIR__ . '/../components/createRecipeMethodStep.php'); 
                ?>
                <h5 class="mb-3">Step 4</h5>                
                <?php 
                    $name = "Step 4"; $description = "To make the chocolate curls, use a vegetable peeler and run it down the edge of the chocolate bar.";
                    include(__DIR__ . '/../components/createRecipeMethodStep.php'); 
                ?>

                <button type="button" class="btn btn-secondary" id="addStepButton"><i class="fas fa-plus"></i> Add Step</button>
                <a role="button" href="<?=getRootUrl()?>/pages/recipe.php" class="btn btn-primary next-step" style="float: right;">Edit Recipe</a>

            </div>  
        </div>
    </div>
</div>
<?php 
    include_once "../components/footer.php"; 
    include_once "../components/docFooter.php"; 
?> 
