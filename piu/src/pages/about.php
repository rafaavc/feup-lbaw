    <?php
        $pageTitle = "About | TasteBuds";
        $extraStyles = [ "about.css" ];
        $extraScripts = [ "../scripts/about.js" ];
        include_once "../components/docHeader.php";
        include_once "../components/nav.php";
        include_once __DIR__ . "/aboutCards.php";
    ?>
    <main>
        <h1 class="content-general-margin">About Us</h1>
        <div class="content-general-margin text-end">
            <i class="fas fa-edit pe-1"></i><a href="#" class="edit-content-text text-decoration-none">Edit</a>
        </div>
        <div class="card shadow p-3 mb-3 bg-body rounded content-general-margin edit-content-text overflow-auto">
            TasteBuds is a new concept of a social network that enables people to share cooking recipes with the world, gain visibility, and possibly attracting new people to their business or any other ventures. Technology is always evolving to improve and facilitate people's lives. Cooking is one of the things we do every day, and TasteBuds is the best tool to ease the task of remembering all the cooking recipes while helping people diversify and improve their eating habits. Created by four young FEUP entrepreneurs, TasteBuds' main goal is to build a community where people can help each other create even better recipes every day!
            <div class="form-floating d-none">
                <textarea class="form-control h-100" rows="10"></textarea>
                <button class="btn btn-secondary mt-3 float-end">Submit</button>
            </div>
        </div>
        <div class="content-general-margin text-end">
            <i class="fas fa-plus pe-1 d-none add-images"></i><a href="#" class="add-content-img text-decoration-none d-none add-images">Add</a>
            <i class="fas fa-edit pe-1 ms-2"></i><a href="#" class="edit-content-img text-decoration-none ">Edit</a>
        </div>

        <!-- Admin Display -->
        
        <div class="text-center user-profiles content-general-margin shadow-lg px-3 d-none admin-images-settings mb-3">
            <p class="fs-4 text-start ps-4 pt-4">Our Team</p>
                <div class="row d-flex justify-content-around img-row">
                <?php 
                    displayTeamUser_AdminSettings("Alexandre Abreu", "../images/a3brx.jpeg");
                    displayTeamUser_AdminSettings("Tiago Gomes", "../images/tiagoogomess.jpeg");
                    displayTeamUser_AdminSettings("Rafael Cristino", "../images/rafaavc.jpeg");
                    displayTeamUser_AdminSettings("Rui Pinto", "../images/2dukes.jpeg");
                ?>
                </div> 
        </div>

        <!-- User Display -->

        <div class="card text-center user-profiles content-general-margin shadow-lg user-images-settings mb-3">
            <p class="fs-4 text-start ps-4 pt-4">Our Team</p>
                <div class="row d-flex justify-content-around">
                    <?php
                        displayTeamUser("Alexandre Abreu", "../images/a3brx.jpeg");
                        displayTeamUser("Tiago Gomes", "../images/tiagoogomess.jpeg");
                        displayTeamUser("Rafael Cristino", "../images/rafaavc.jpeg");
                        displayTeamUser("Rui Pinto", "../images/2dukes.jpeg"); 
                    ?>
                </div>
        </div>
    </main>
    <?php 
        include_once "../components/footer.php"; 
        include_once "../components/docFooter.php";
    ?>