<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { color-scheme: dark; }
        body {
            margin:0;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:radial-gradient(circle at top left, #311b1b 0%, #0c0f16 55%, #090c12 100%);
            color:#f7f7f7;
            font-family:Inter,Segoe UI,sans-serif;
        }
        .auth-shell { width:min(100%, 460px); padding:24px; }
        .card {
            background:rgba(31,35,43,.96);
            border:1px solid rgba(255,255,255,.08);
            border-radius:24px;
            box-shadow:0 24px 60px rgba(0,0,0,.35);
            backdrop-filter:blur(16px);
        }
        .btn-danger{background:#FF2D2D;border:0;}
        .btn-danger:hover{background:#e62a2a;}
        .btn-outline-light{border-color:rgba(255,255,255,.12);} .btn-outline-light:hover{background:#1f232b;color:#fff;}
        .form-control{background:#151922;color:#fff;border:1px solid rgba(255,255,255,.12); border-radius:12px; padding:12px 14px;}
        .form-control:focus{background:#151922;color:#fff;border-color:#FF2D2D;box-shadow:0 0 0 .2rem rgba(255,45,45,.25);} 
        .text-white-strong{color:#fff!important;} 
        .helper-text{font-size:.95rem;color:#b9bec8;}
        .brand-pill{display:inline-block;padding:6px 10px;border-radius:999px;background:rgba(255,45,45,.15);color:#ff7b7b;font-size:.75rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;}
        .password-wrap{position:relative;}
        .password-wrap .toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:transparent;border:0;color:#b9bec8;}
        .small-link{font-size:.9rem;color:#ff7d7d; text-decoration:none;}
    </style>
</head>
<body>
<div class="auth-shell">
    <div class="card p-4 p-md-5">
        <div class="mb-3"><span class="brand-pill">Smart Catalog</span></div>
        <h3 class="mb-2 text-white-strong">Masuk ke dashboard</h3>
        <p class="helper-text mb-3">Kelola katalog, stok, dan laporan penjualan dengan cepat.</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success py-2 mb-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label text-white-strong">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}" autocomplete="email">
            </div>
            <div class="mb-3">
                <label class="form-label text-white-strong">Password</label>
                <div class="password-wrap">
                    <input type="password" id="passwordInput" name="password" class="form-control" required autocomplete="current-password">
                    <button type="button" class="toggle" onclick="togglePassword()" aria-label="Lihat password"><i class="fas fa-eye"></i></button>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <label class="form-check text-white-strong">
                    <input type="checkbox" class="form-check-input me-2" name="remember">
                    <span>Ingat saya</span>
                </label>
                <a href="{{ route('register') }}" class="small-link">Buat akun</a>
            </div>
            <button class="btn btn-danger w-100">Login</button>
        </form>

        <div class="mt-3 d-flex gap-2 justify-content-center flex-wrap">
            <button type="button" class="btn btn-outline-light btn-sm" onclick="quickFill('agus@gmail.com','salim1234')">Login Admin Agus</button>
            <button type="button" class="btn btn-outline-light btn-sm" onclick="quickFill('admin@smartcatalog.test','password123')">Login Admin Demo</button>
        </div>

        <div class="mt-3 text-center">
            <a href="{{ route('register') }}" class="text-light text-decoration-none">Belum punya akun? <strong>Register</strong></a>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon = document.querySelector('.toggle i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
    function quickFill(email, password) {
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="password"]').value = password;
    }
</script>
</body>
</html>
