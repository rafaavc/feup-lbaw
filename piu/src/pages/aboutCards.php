<?php
    function displayTeamUser($name, $photo) { ?>
        <div class="col-lg-2 col-md-6">
            <div class="card border-0">
                <img src="<?= $photo ?>" class="card-img-top rounded-circle" alt="...">
                <div class="card-body">
                    <p class="card-text"><?= $name ?></p>
                </div>
            </div>
        </div>
    <?php } 

    function displayTeamUser_AdminSettings($name, $photo) { ?>
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
                <img src="<?= $photo ?>" class="card-img-top rounded-circle" alt="...">
                <div class="card-body px-0">
                    <input type="text" class="form-control" id="inputPassword" value="<?= $name ?>">
                    <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="dropdown" aria-expanded="false">Submit</button>
                </div>
            </div>
        </div>
    <?php }