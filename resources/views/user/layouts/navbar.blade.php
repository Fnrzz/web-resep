<nav class="navbar navbar-expand-lg bg-white py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('index') }}">ResepKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3 ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('index') ? 'active' : '' }}" href="{{ route('index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('menu') ? 'active' : '' }}" href="{{ route('menu') }}">Menu
                        Resep</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('tanya-ai') ? 'active' : '' }}" href="{{ route('tanya-ai') }}">Tanya
                        AI</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-orange px-4 rounded-pill" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
