<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container-fluid">

        <a href="/cart" class="btn btn-sm btn-primary me-lg-2">
            <span class="icofont icofont-cart"></span>
        </a>

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
                    <div class="dropdown-menu border-0 shadow-sm" aria-labelledby="dropdownId">
                        @foreach (\App\Models\Category::all() as $category)
                            <a class="dropdown-item my-1" href="/categories/{{ $category->id }}/">
                                <i class="icofont icofont-caret-right"></i>
                                {{ $category->name }}
                            </a>
                        @endforeach
                        <a class="dropdown-item my-1" href="/products/">
                            <i class="icofont icofont-caret-right"></i>
                            All Products
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Account</a>
                    <div class="dropdown-menu border-0 shadow-sm" aria-labelledby="dropdownId">
                        @if (!is_auth())
                        <a class="dropdown-item" href="/register">Register</a>
                        <a class="dropdown-item" href="/login">Login</a>
                        @else
                        <a class="dropdown-item" href="/panel">Panel</a>
                        <form action="logout/" method="POST">
                            <input type="submit" value="logout" class="dropdown-item">
                        </form>
                        @endif
                    </div>
                </li>
            </ul>

            <form class="d-flex my-2 my-lg-0" action="/products" method="GET">
                <input name="key" class="form-control rounded-0" type="text" placeholder="Search">
                <button class="btn btn-success rounded-0" type="submit">
                    <i class="icofont icofont-search-2"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
