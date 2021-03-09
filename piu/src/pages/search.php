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
    <?php drawBreadcrumb(["Search",  "\"cozido à portuguesa\""]); ?>
    <div class="container search-page content-general-margin mt-5 margin-to-footer">
        <div class="search-header">
            <h1 class="mb-5">Search Results</h1>

            <?php include_once "../components/filterSortBar.php"; ?>

            <div class="col info-text mt-5">
                <strong>153</strong>
                results for
                "<strong>cozido à portuguesa</strong>"
            </div>
            <!-- <div class="col sort-by">
                <span class="sort-by-text">Sort by</span>
                <span class="dropdown ms-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-title">Relevance</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Relevance</a></li>
                        <li><a class="dropdown-item" href="#">Publication date</a></li>
                        <li><a class="dropdown-item" href="#">Rating</a></li>
                        <li><a class="dropdown-item" href="#">Difficulty</a></li>
                        <li><a class="dropdown-item" href="#">Duration</a></li>
                    </ul>
                </span>
            </div> -->
        </div>
        <div class="card shadow w-auto h-auto search-area searched-recipes p-4 mb-5 mt-3">
            <h3 class="section-title">Recipes</h3>
            <div class="row d-flex justify-content-around items mx-0">
                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div class="col-lg-1 col-md-6 mx-4 my-4 w-auto">
                        <?php getRecipeCard(); ?>
                    </div>
                <?php }
                ?>
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
        <div class="card shadow p-2 w-auto h-auto search-area searched-recipes p-4 my-5">
            <h3 class="section-title">Groups</h3>
            <div class="row d-flex justify-content-around items mx-0">
                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div class="col-lg-1 col-md-6 mx-4 my-4 w-auto">
                        <?php getGroupCard(); ?>
                    </div>
                <?php }
                ?>
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
        <div class="card shadow p-2 w-auto h-auto search-area searched-recipes p-4 my-5">
            <h3 class="section-title">People</h3>
            <div class="row d-flex justify-content-around items mx-0">
                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div class="col-lg-1 col-md-6 mx-4 my-4 w-auto">
                        <?php getUserCard(); ?>
                    </div>
                <?php }
                ?>
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
        <div class="card shadow p-2 w-auto h-auto search-area searched-recipes p-4 my-5">
            <h3 class="section-title">Categories</h3>
            <div class="row d-flex justify-content-around items mx-0">
                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div class="col-lg-1 col-md-6 mx-4 my-4 w-auto">
                        <?php getCategoryCard(); ?>
                    </div>
                <?php }
                ?>
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