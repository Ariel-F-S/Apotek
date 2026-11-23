<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PharmaCare Express</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex align-items-center min-vh-100 py-4" style="background: linear-gradient(135deg, #5A827E 0%, #84AE92 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-apotek-dark text-center py-4 border-0">

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

                        <h4 class="fw-bold text-apotek-cream mb-0">Registrasi Akun Apotek</h4>
                        <small class="text-white-50">PharmaCare Express</small>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold text-apotek-dark">Nama Lengkap</label>
                                <input type="text" name="name" id="name"
                                       class="form-control border-apotek-sage @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="Contoh: Apt. Budi Santoso" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="usertype" class="form-label fw-semibold text-apotek-dark">Jabatan / Role Pengguna</label>
                                <select name="usertype" id="usertype"
                                        class="form-select border-apotek-sage @error('usertype') is-invalid @enderror" required>
                                    <option value="" disabled selected>-- Pilih Role --</option>
                                    <option value="pimpinan" {{ old('usertype') == 'pimpinan' ? 'selected' : '' }}>Pimpinan Apotek</option>
                                    <option value="apoteker" {{ old('usertype') == 'apoteker' ? 'selected' : '' }}>Apoteker</option>
                                    <option value="kasir" {{ old('usertype') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                </select>
                                @error('usertype')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold text-apotek-dark">Alamat Email</label>
                                <input type="email" name="email" id="email"
                                       class="form-control border-apotek-sage @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="nama@apotek.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold text-apotek-dark">Password</label>
                                    <input type="password" name="password" id="password"
                                           class="form-control border-apotek-sage @error('password') is-invalid @enderror"
                                           placeholder="Minimal 8 karakter" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold text-apotek-dark">Ulangi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control border-apotek-sage"
                                           placeholder="Konfirmasi password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-apotek-primary w-100 py-2 rounded-pill fw-bold shadow-sm">
                                <i class="fas fa-user-plus me-2"></i> Daftar Akun
                            </button>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <span class="small text-muted">Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="small fw-bold text-apotek-dark text-decoration-none">
                                Login di sini
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>