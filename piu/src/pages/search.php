    <?php
    $role = "member";
    $pageTitle = "Search Results | TasteBuds";
    $extraStyles = ["search.css", "../components/search_results_cards.css", "../components/filterSortBar.css", "../components/breadcrumb.css"];
    $extraScripts = ["../components/filterSortBar.js"];

    include_once "../components/search_results_cards.php";
    include_once "../components/breadcrumb.php";
    include_once "../components/docHeader.php";
    include_once "../components/nav.php";
    ?>
    <?php drawBreadcrumb(["Search",  "\"Cozido à portuguesa\""]); ?>
    <div class="container search-page content-general-margin mt-5 margin-to-footer">
        <div class="search-header">
            <h1 class="mb-5">Search Results</h1>

            <?php include_once "../components/filterSortBar.php"; ?>

            <div class="col info-text mt-5">
                <strong>153</strong>
                results for
                "<strong>Cozido à portuguesa</strong>"
            </div>

        </div>
        <div class="card shadow-sm w-auto h-auto search-area searched-recipes p-2 p-sm-4 mb-5 mt-3">
            <h3 class="section-title ps-2 mb-4 text-center text-md-start">Recipes</h3>
            <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0">
                
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getRecipeCard("Cozido à tuga","Zé Manel Padeiro", "https://www.teleculinaria.pt/wp-content/uploads/2018/03/cozido-a-portuguesa-600x449.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getRecipeCard("Cozido português","Zé da Torre", "https://www.teleculinaria.pt/wp-content/uploads/2020/02/Cozido-a-portuguesa-CHFB.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getRecipeCard("Cozido à portuguesa","Festival dos Sabores", "https://www.pingodoce.pt/wp-content/uploads/2016/02/cover.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getRecipeCard("Cozido à tuguinha","Mulher Portuguesa", "https://www.mulherportuguesa.com/wp-content/uploads/2016/10/Receita-de-cozido-%C3%A1-portuguesa.jpg"); ?>
                </div>
                
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
            <h3 class="section-title ps-2 mb-4">Groups</h3>
            <div class="row gx-2 gy-5 justify-content-between items mx-0">
                
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getGroupCard("Amantes de Leitões", "https://www.comidaereceitas.com.br/img/sizeswp/1200x675/2007/11/Leitao_assadaaaa.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getGroupCard("Porto Vegans", "https://www.studyfinds.org/wp-content/uploads/2020/01/AdobeStock_289529994-816x520.jpeg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getGroupCard("Fitness Life", "https://echomag.com/wp-content/uploads/2020/02/AdobeStock_204048194w-620x264.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getGroupCard("Restaurante Nacional", "http://www.restaurantenacional.pt/sites/default/files/styles/portfolio_653x368_/public/2020-04/restaurante-nacional-paelha-03.jpg?itok=jkKlVJSE"); ?>
                </div>

            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
            <h3 class="section-title ps-2 mb-4">People</h3>
            <div class="row gx-2 gy-5 justify-content-between items mx-0">
                
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getUserCard("Zé Torres", "https://i.insider.com/5899ffcf6e09a897008b5c04?width=1100&format=jpeg&auto=webp"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getUserCard("Chef Manel", "https://meubistro.com/blog/wp-content/uploads/2019/05/chef-de-cozinha.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getUserCard("Chef Zé", "https://static.cordonbleu.edu/Files/MediaFile/70794.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getUserCard("Chef Carlos", "https://anytimechefs.com.au/wp-content/uploads/2018/12/perth-chef-hire.jpg"); ?>
                </div>
         
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
            <h3 class="section-title mb-4">Categories</h3>
            <div class="row gx-2 gy-5 justify-content-between items mx-0">
                
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getCategoryCard("Vegetarian","https://www.health.harvard.edu/media/content/images/cr/f5282d05-33f5-4c93-a08e-b000164a54db.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getCategoryCard("Breakfast","https://www.thedailymeal.com/sites/default/files/2019/01/18/0-Utah-MAIN2.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getCategoryCard("Dessert","https://storcpdkenticomedia.blob.core.windows.net/media/recipemanagementsystem/media/recipe-media-files/recipes/retail/x17/17244-caramel-topped-ice-cream-dessert-600x600.jpg?ext=.jpg"); ?>
                </div>
                <div class="col-lg-1 col-md-6 w-auto">
                    <?php getCategoryCard("Drinks","https://www.thespruceeats.com/thmb/BNMKJiHueV_Eh9n246pdEZM1Ijw=/3626x2418/filters:no_upscale():max_bytes(150000):strip_icc()/bar101-cocktails-504754220-580e83415f9b58564cf470b9.jpg"); ?>
                </div>
                
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <?php
    include_once "../components/footer.php";
    include_once "../components/docFooter.php";
    ?>