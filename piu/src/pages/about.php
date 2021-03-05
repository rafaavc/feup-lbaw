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
    <script src="../scripts/about.js" defer></script>
    
    <link href="about.css" rel="stylesheet">
    <link href="../components/footer.css" rel="stylesheet">
    <link href="../components/nav.css" rel="stylesheet">

    <title>About Us</title>
</head>
<body>
    <?php
        include_once "../components/nav.php";
    ?>
    <main>
        <h1 class="text-center">About Us</h1>
        <div class="w-75 mx-auto text-end">
            <i class="fas fa-edit pe-1"></i><a href="#" class="edit-content-text text-decoration-none">Edit</a>
        </div>
        <div class="shadow p-3 mb-3 bg-body rounded w-75 mx-auto edit-content-text overflow-auto">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
        <div class="w-75 mx-auto text-end">
            <i class="fas fa-plus pe-1 d-none add-images"></i><a href="#" class="add-content-img text-decoration-none d-none add-images">Add</a>
            <i class="fas fa-edit pe-1 ms-2"></i><a href="#" class="edit-content-img text-decoration-none ">Edit</a>
        </div>

        <div class="text-center user-profiles w-75 mx-auto shadow-lg px-3 d-none admin-images-settings">
            <p class="fs-4 text-start ps-4 pt-4">Our Team</p>
                <div class="row d-flex justify-content-around img-row">
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                            <div class="btn-group dropup w-25 ms-auto">
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
                                    <li>
                                        <a class="dropdown-item remove-box"><i class="fas fa-ban me-2"></i>Delete All</a>
                                    </li>
                                </ul>
                            </div>
                            <img src="../images/2dukes.jpeg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body px-0">
                                <input type="text" class="form-control" id="inputPassword" value="Rui Pinto">
                                <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="dropdown" aria-expanded="false">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                        <div class="btn-group dropup w-25 ms-auto">
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
                                    <li>
                                        <a class="dropdown-item remove-box"><i class="fas fa-ban me-2"></i>Delete All</a>
                                    </li>
                                </ul>
                            </div>
                            <img src="../images/rafaavc.jpeg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body px-0">
                                <input type="text" class="form-control" id="inputPassword" value="Rafael Cristino">
                                <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="dropdown" aria-expanded="false">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                        <div class="btn-group dropup w-25 ms-auto">
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
                                    <li>
                                        <a class="dropdown-item remove-box"><i class="fas fa-ban me-2"></i>Delete All</a>
                                    </li>
                                </ul>
                            </div>
                            <img src="../images/tiagoogomess.jpeg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body px-0">
                                <input type="text" class="form-control" id="inputPassword" value="Tiago Gomes">
                                <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="dropdown" aria-expanded="false">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                        <div class="btn-group dropup w-25 ms-auto">
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
                                    <li>
                                        <a class="dropdown-item remove-box"><i class="fas fa-ban me-2"></i>Delete All</a>
                                    </li>
                                </ul>
                            </div>
                            <img src="../images/a3brx.jpeg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body px-0">
                                <input type="text" class="form-control" id="inputPassword" value="Alexandre Abreu">
                                <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="dropdown" aria-expanded="false">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

        <!-- ----- -->
        <div class="text-center user-profiles w-75 mx-auto shadow-lg user-images-settings">
            <p class="fs-4 text-start ps-4 pt-4">Our Team</p>
                <div class="row d-flex justify-content-around">
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                            <img src="../images/signIn.jpg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body">
                                <p class="card-text">Rui Pinto</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                            <img src="../images/rafaavc.jpeg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body">
                                <p class="card-text">Rafael Cristino</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                            <img src="../images/tiagoogomess.jpeg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body">
                                <p class="card-text">Tiago Gomes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card border-0">
                            <img src="../images/a3brx.jpeg" class="card-img-top rounded-circle" alt="...">
                            <div class="card-body">
                                <p class="card-text">Alexandre Abreu</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
        </div>
    </main>
    <?php include_once "../components/footer.php"; ?>                  
</body>
</html>