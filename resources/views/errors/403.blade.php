<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
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
        <h1 class="display-1 text-danger">403</h1>
        <h3>Akses Ditolak</h3>
        <p class="text-muted">Anda tidak memiliki izin untuk membuka halaman ini.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-danger">Kembali ke Dashboard</a>
    </div>
</div>
</body>
</html>
