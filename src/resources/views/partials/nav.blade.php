<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light content-general-padding">
    <div id="navbarContainer" class="container-fluid justify-content-between p-0">
        <!-- Logo -->
        <a class="navbar-brand flex-lg-grow-1 normalize" href="{{ url("") }}">
            <img class="logo" src="{{ asset('storage/images/tastebuds-dark.png') }}" height="50px" />
        </a>

        <!-- Togglers -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" data-bs-parent="#navbarContainer" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle searchbox">
            <i class="fas fa-search"></i>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" data-bs-parent="#navbarContainer" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Search box -->
        <div class="collapse navbar-collapse justify-content-center flex-grow-1 normalize" id="navbarSearch" data-bs-parent="#navbarContainer">
            <form action="<?=url("/pages/search.php")?>">
                <div class="d-flex">
                    <input type="text" class="form-control icon-right" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <i class="fas fa-search fa-icon-right"></i>
                </div>
            </form>
        </div>

        <!-- Right buttons -->
        <div class="collapse navbar-collapse justify-content-end flex-grow-1 normalize" id="navbarText" data-bs-parent="#navbarContainer">
            <ul class="navbar-nav mb-2 mb-lg-0">
                aaa
            </ul>
        </div>
    </div>
</nav>
