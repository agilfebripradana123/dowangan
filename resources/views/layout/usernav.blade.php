<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand ml-2" href="{{ route('user.home') }}">Dowangan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

                <div class="collapse navbar-collapse justify-content-end text-center" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#profil">Profil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#konten">Konten</a></li>
                        <li class="nav-item"><a class="nav-link" href="#maps">Maps</a></li>
                        <li class="nav-item"><a class="nav-link" href="#data">Data Penduduk</a></li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn btn-warning btn-sm ms-3">Login</a>
                </div>

            </div>
        </nav>
       