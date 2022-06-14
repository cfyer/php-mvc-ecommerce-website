<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="btn btn-primary me-lg-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="icofont icofont-cart"></span>
        </button>
        <a class="navbar-brand" href="/">{{ $_ENV['APP_NAME'] }}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId">
            <i class="icofont icofont-navigation-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Products</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item my-1" href="#">
                            <i class="icofont icofont-caret-right"></i>
                            Category 1
                        </a>
                        <a class="dropdown-item my-1" href="#">
                            <i class="icofont icofont-caret-right"></i>
                            Category 1
                        </a>
                        <a class="dropdown-item my-1" href="#">
                            <i class="icofont icofont-caret-right"></i>
                            Category 1
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Account</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Register</a>
                        <a class="dropdown-item" href="#">Login</a>
                    </div>
                </li>
            </ul>

            <form class="d-flex my-2 my-lg-0">
                <input class="form-control rounded-0" type="text" placeholder="Search">
                <button class="btn btn-success rounded-0" type="submit">
                    <i class="icofont icofont-search-2"></i>
                </button>
            </form>
        </div>
    </div>
</nav>



<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Cart</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

    </div>
</div>
