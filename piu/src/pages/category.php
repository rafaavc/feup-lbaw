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

    <!-- Script -->
    <script src="../components/filterSortBar.js" defer></script>
    
    <link href="category.css" rel="stylesheet">
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
    <div class="container">
        <div class="mt-5 category-header">
            <h1 class="mt-2 mb-5 text-center">Vegetarian</h1>
            <?php
                include_once "../components/filterSortBar.php";
            ?>
        </div>
        <div class="card shadow w-100 h-auto search-area searched-recipes mx-auto p-4 my-5">
            <?php 
                displayRecipe(true);
                displayRecipe(true);
            ?>
            <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
        </div>
    </div>
    <?php include_once "../components/footer.php"; ?>
</body>
</html>
