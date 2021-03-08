<?php
    $pageTitle = "Edit Profile | TasteBuds";
    $extraStyles = [ "edit_profile.css", "../components/inputIcon.css" ];
    $extraScripts = [ "../scripts/edit_profile.js" ];
    include_once "../components/search_results_cards.php";
    include_once "../components/docHeader.php";
    include_once "../components/nav.php";
?>

<div class="container edit_profile_page content-general-margin margin-from-nav margin-to-footer">
    <h1 class="mb-5">Edit Profile</h1>

    <div class="card shadow p-2 w-auto h-auto edit-profile-area p-5 mt-4">
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

<?php 
    include_once "../components/footer.php"; 
    include_once "../components/docFooter.php"; 
?>
