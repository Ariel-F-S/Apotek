<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="fas fa-clinic-medical me-2"></i>PharmaCare Express
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarApotek">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarApotek">
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">
                            Dashboard
                        </a>
                    </li>

                    @if(Auth::user()->usertype == 'pimpinan')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active fw-semibold' : '' }}" href="{{ route('laporan.index') }}">
                                Laporan Apotek
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->usertype == 'apoteker')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('obat.*') ? 'active fw-semibold' : '' }}" href="{{ route('obat.index') }}">
                                Data Obat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active fw-semibold' : '' }}" href="{{ route('kategori.index') }}">
                                Kategori Obat
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->usertype == 'kasir')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active fw-semibold' : '' }}" href="{{ route('transaksi.index') }}">
                                Transaksi Penjualan
                            </a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item me-2 mb-2 mb-lg-0">
                        <span class="badge bg-light text-success text-uppercase px-3 py-2">
                            Role: {{ Auth::user()->usertype }}
                        </span>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li>
                                <span class="dropdown-item-text small text-muted">
                                    Login sebagai <strong>{{ ucfirst(Auth::user()->usertype) }}</strong>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>