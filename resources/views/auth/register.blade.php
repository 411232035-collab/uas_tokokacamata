<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:linear-gradient(135deg,#11141b,#1B1E24);color:#fff;min-height:100vh;display:flex;align-items:center;justify-content:center;}
        .card{background:#242731;border-radius:20px; border:1px solid rgba(255,255,255,0.08); box-shadow:0 20px 40px rgba(0,0,0,.25);}
        .btn-danger{background:#FF2D2D;border:0;}
        .btn-danger:hover{background:#e62a2a;}
        .form-control{background:#1f232b;color:#fff;border:1px solid rgba(255,255,255,0.12);} 
        .form-control:focus{background:#1f232b;color:#fff;border-color:#FF2D2D;box-shadow:0 0 0 .2rem rgba(255,45,45,.25);} 
        .text-white-strong{color:#fff!important;} 
        .helper-text{font-size:.95rem;color:#b9bec8;}
        .brand-pill{display:inline-block;padding:6px 10px;border-radius:999px;background:rgba(255,45,45,.15);color:#ff7b7b;font-size:.8rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;}
    </style>
</head>
<body>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4">
                <div class="mb-3"><span class="brand-pill">Smart Catalog</span></div>
                <h3 class="mb-2 text-white-strong">Create Account</h3>
                <p class="helper-text mb-3">Daftar akun baru untuk mulai memantau katalog dan performa bisnis.</p>
                @if ($errors->any())
                    <div class="alert alert-danger py-2 mb-3">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    <div class="mb-3"><label class="form-label text-white-strong">Nama</label><input name="name" class="form-control" required value="{{ old('name') }}"></div>
                    <div class="mb-3"><label class="form-label text-white-strong">Email</label><input type="email" name="email" class="form-control" required value="{{ old('email') }}"></div>
                    <div class="mb-3"><label class="form-label text-white-strong">Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label text-white-strong">Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
                    <button class="btn btn-danger w-100">Register</button>
                </form>
                <div class="mt-3 text-center"><a href="{{ route('login') }}" class="text-light text-decoration-none">Sudah punya akun? <strong>Login</strong></a></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
