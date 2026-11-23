<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PharmaCare Express</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex align-items-center min-vh-100 py-4" style="background: linear-gradient(135deg, #5A827E 0%, #84AE92 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-flex flex-column justify-content-between p-4 text-white bg-apotek-dark">
                            <div>
                                
                                    <div class="text-center mb-4">

                                        <img
                                            src="{{ asset('logo.png') }}"
                                            alt="Logo PharmaCare"
                                            style="
                                                width: 100px;
                                                height: 100px;
                                                object-fit: contain;
                                                display: block;
                                                margin: 0 auto 12px auto;
                                            "
                                        >

                                        <span
                                            class="fw-bold fs-4 text-apotek-cream"
                                            style="display: block;"
                                        >
                                            PharmaCare
                                        </span>

                                    </div>

                                <h4 class="fw-bold mt-4">Sistem Informasi Manajemen Apotek</h4>
                                <p class="small opacity-75 mt-2">
                                    Akses terpadu untuk Pimpinan, Apoteker, dan Kasir dalam satu platform.
                                </p>
                            </div>

                        </div>

                        <div class="col-md-7 bg-white p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold text-apotek-dark mb-1">Selamat Datang Kembali</h3>
                                <p class="text-muted small">Silakan masuk menggunakan akun terdaftar Anda</p>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-apotek-dark">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-apotek-cream border-apotek-sage text-apotek-dark">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" id="email"
                                               class="form-control border-apotek-sage @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="contoh@apotek.com" required autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold text-apotek-dark">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-apotek-cream border-apotek-sage text-apotek-dark">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" name="password" id="password"
                                               class="form-control border-apotek-sage @error('password') is-invalid @enderror"
                                               placeholder="Masukkan password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-apotek-primary w-100 py-2 rounded-pill fw-bold shadow-sm">
                                    <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Sistem
                                </button>
                            </form>

                            <hr class="my-4">

                            <div class="text-center">
                                <span class="small text-muted">Belum punya akun?</span>
                                <a href="{{ route('register') }}" class="small fw-bold text-apotek-dark text-decoration-none">
                                    Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>