<nav class="navbar navbar-expand-lg bg-white py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">ResepKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav gap-3 ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu') }}">Menu Resep</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tanya-ai') }}">Tanya AI</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-orange px-4 rounded-pill" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
