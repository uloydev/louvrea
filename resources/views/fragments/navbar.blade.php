<nav class="navbar navbar-expand-lg navbar-light bg-warning"style="z-index: 100;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <a class="dropdown-item" href="{{ route('product-list') }}">All Product</a>
                        @foreach (App\Models\ProductCategory::all() as $cat)
                            <a class="dropdown-item"
                                href="{{ route('product-list', ['cat' => $cat->id]) }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about-us')}}">About Us</a>
                </li>

            </ul>
            <form class="form-inline search-form" action="{{ route('product-list') }}" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="search">
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a class="nav-link pr-4" href="{{ route('cart.index') }}">
                            <i class="icofont-cart"style="font-size: 2em;"></i>
                            <span class="badge badge-pill badge-danger position-absolute">{{App\Models\Cart::where('user_id', auth()->id())->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">
                            <img src="{{ isset(auth()->user()->avatar) ? asset('storage/'.auth()->user()->avatar) : asset('img/profile-default.svg') }}" class="rounded-circle mx-auto d-block" alt="profile image" style="width: 2em;">
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
