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
    <link href="../components/filterSortBar.css" rel="stylesheet">
    <link href="../components/post.css" rel="stylesheet">
    <link href="../components/footer.css" rel="stylesheet">
    <link href="../components/nav.css" rel="stylesheet">

    <title>Category</title>
</head>
<body class="pt-5">
    <?php
        include_once "../components/post.php";
        include_once "../components/nav.php";
    ?>
    <div class="container search-page">
        <div class="row search-header w-75 mx-auto">
            <?php
                include_once "../components/filterSortBar.php";
            ?>
            <!-- <div class="col sort-by">
                <h1 class="text-center">Still need to insert TOP BAR</h1>
                <span class="sort-by-text">Sort by</span>
                <span class="dropdown ms-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-title">Relevance</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item sort-topic" href="#">Relevance</a></li>
                        <li><a class="dropdown-item sort-topic" href="#">Publication date</a></li>
                        <li><a class="dropdown-item sort-topic" href="#">Rating</a></li>
                        <li><a class="dropdown-item sort-topic" href="#">Difficulty</a></li>
                        <li><a class="dropdown-item sort-topic" href="#">Duration</a></li>
                    </ul>
                </span>
            </div> -->
        </div>
        <div class="card shadow w-75 h-auto search-area searched-recipes mx-auto p-4 my-5">
            <?php 
                displayRecipe(true);
                displayRecipe(true);
            ?>
            <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">LOAD MORE</button>
        </div>
    </div>
    <?php include_once "../components/footer.php"; ?>
</body>
