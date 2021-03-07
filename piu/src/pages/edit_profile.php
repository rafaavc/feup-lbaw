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

    <!-- Scripts -->
    <script src="../scripts/edit_profile.js" defer></script>
    
    <link href="edit_profile.css" rel="stylesheet">
    <link href="../components/inputIcon.css" rel="stylesheet">
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
                <div class="col profile-photo-area mx-2">
                    <div class="row row-with-image">
                        <div class="col area-title-col">
                            <h4 class="area-title">Profile Photo</h4>
                        </div>   
                        <div class="col">                     
                            <div class="btn-group dropdown w-20 ms-auto">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item file-input"><i class="fas fa-upload me-2"></i>Upload Image</a>
                                        <input type="file" name="myfile"></input>
                                    </li>
                                    <li>
                                        <a class="dropdown-item file-delete"><i class="fas fa-eraser me-2"></i>Clear Image</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <img class="rounded-circle z-depth-2 profile-image" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                </div>
                <div class="col cover-photo-area mx-2">
                    <div class="row area-title-row row-with-image">
                        <div class="col area-title-col">
                            <h4 class="area-title">Cover Photo</h4>
                        </div>
                        <div class="col">
                            <div class="btn-group dropdown w-20 ms-auto">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item file-input"><i class="fas fa-upload me-2"></i>Upload Image</a>
                                        <input type="file" name="myfile"></input>
                                    </li>
                                    <li>
                                        <a class="dropdown-item file-delete"><i class="fas fa-eraser me-2"></i>Clear Image</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <img src="https://res.cloudinary.com/sanitarium/image/fetch/q_auto/https://www.sanitarium.com.au/getmedia%2Fae51f174-984f-4a70-ad3d-3f6b517b6da1%2Ffruits-vegetables-healthy-fats.jpg%3Fwidth%3D1180%26height%3D524%26ext%3D.jpg" class="bd-placeholder-img">
                </div>
            </div>

            <h4 class="area-title mt-4">Biography</h4>
            <div class="form-group">
                <textarea class="form-control mb-4 p-3 edit-profile-text-input" id="exampleFormControlTextarea1" rows="3">User's biography</textarea>
            </div>

            <h4 class="area-title">Name</h4>
            <div class="form-group">
                <textarea class="form-control mb-4 p-3 edit-profile-text-input" id="exampleFormControlTextarea1" rows="1">User's name</textarea>
            </div>

            <h4 class="area-title">Country</h4>
            <div class="form-group">
                <textarea class="form-control mb-4 p-3 edit-profile-text-input" id="exampleFormControlTextarea1" rows="1">User's country</textarea>
            </div>

            <h4 class="area-title">City</h4>
            <div class="form-group">
                <textarea class="form-control mb-5 mt-1 p-3 edit-profile-text-input" id="exampleFormControlTextarea1" rows="1">User's city</textarea>
            </div>
            <h4 class="area-title">Profile Visibility</h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Public
                </label>
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Private
                </label>
            </div>
            <div class="text-center mt-5 mb-3">
                <button class="btn btn-primary submit-button">Submit</button>
            </div>
            
        </div>

    </div>
    
    <?php include_once "../components/footer.php"; ?>
</body>
