<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#1B1E24; color:#fff; font-family:Inter,Segoe UI,sans-serif; }
        .container { min-height:100vh; display:flex; align-items:center; justify-content:center; }
        .card { background:#242731; border-radius:24px; padding:40px; border:1px solid rgba(255,255,255,0.08); }
        .btn-danger { background:#FF2D2D; border:0; }
    </style>
</head>
<body>
<div class="container">
    <div class="card text-center">
        <h1 class="display-1 text-danger">404</h1>
        <h3>Halaman Tidak Ditemukan</h3>
        <p class="text-muted">Alamat yang Anda tuju belum tersedia atau mungkin salah.</p>
        <a href="{{ route('home') }}" class="btn btn-danger">Kembali ke Beranda</a>
    </div>
</div>
</body>
</html>
