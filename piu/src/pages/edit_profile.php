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

    <link href="edit_profile.css" rel="stylesheet">
    <link href="../components/footer.css" rel="stylesheet">
    <link href="../components/nav.css" rel="stylesheet">

    <title>Edit Profile</title>
</head>
<body>
    <?php
    include_once "../components/search_results_cards.php";
    include_once "../components/nav.php";
    ?>

    <div class="container edit_profile_page">
        <h1 class="m-5">Edit Profile</h1>

        <div class="card shadow p-2 w-auto h-auto edit-profile-area mx-5 p-5 my-5">
            <div class="row">
                <div class="col profile-photo-area">
                    <h4 class="area-title">Profile Photo</h4>
                    <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                </div>
                <div class="col cover-photo-area">
                    <h4 class="area-title">Cover Photo</h4>
                    <img src="https://res.cloudinary.com/sanitarium/image/fetch/q_auto/https://www.sanitarium.com.au/getmedia%2Fae51f174-984f-4a70-ad3d-3f6b517b6da1%2Ffruits-vegetables-healthy-fats.jpg%3Fwidth%3D1180%26height%3D524%26ext%3D.jpg" class="bd-placeholder-img">
                </div>
            </div>
            
        </div>

    </div>
    
    <?php include_once "../components/footer.php"; ?>
</body>
