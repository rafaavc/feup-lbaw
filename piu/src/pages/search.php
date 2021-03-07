<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

    <link href="search.css" rel="stylesheet">
    <link href="../components/search_results_cards.css" rel="stylesheet">
    <link href="../components/footer.css" rel="stylesheet">
    <link href="../components/nav.css" rel="stylesheet">

    <title>Search Results</title>
</head>
<body>
    <?php
    include_once "../components/search_results_cards.php";
    include_once "../components/nav.php";
    ?>
    <div class="container search-page">
        <div class="row search-header my-5 mx-1">
            <div class="col info-text">
                <span class="number-of-results">153</span>
                results for
                "<span class="searched-text">cozido à portuguesa</span>"
            </div>
            <div class="col sort-by">
            <span class="sort-by-text">Sort by</span>
            <span class="dropdown ms-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-title">Relevance</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Relevance</a></li>
                        <li><a class="dropdown-item" href="#">Publication date</a></li>
                        <li><a class="dropdown-item" href="#">Rating</a></li>
                        <li><a class="dropdown-item" href="#">Difficulty</a></li>
                        <li><a class="dropdown-item" href="#">Duration</a></li>
                    </ul>
                </span>
            </div>
        </div>
        <div class="card shadow p-2 w-auto h-auto search-area searched-recipes mx-5 p-4 my-5">
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
        <div class="card shadow p-2 w-auto h-auto search-area searched-recipes mx-5 p-4 my-5">
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
        <div class="card shadow p-2 w-auto h-auto search-area searched-recipes mx-5 p-4 my-5">
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
        <div class="card shadow p-2 w-auto h-auto search-area searched-recipes mx-5 p-4 my-5">
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
    <?php include_once "../components/footer.php"; ?>
</body>
