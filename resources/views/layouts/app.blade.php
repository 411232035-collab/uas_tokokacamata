<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Catalog Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root { color-scheme: dark; }
        body { background: linear-gradient(135deg, #0F1117, #181C25); color:#f8fafc; font-family:Inter,Segoe UI,sans-serif; }
        .sidebar { background: rgba(23,26,31,.96); min-height:100vh; width:250px; padding:20px; position:fixed; top:0; left:0; border-right:1px solid rgba(255,255,255,.08); backdrop-filter: blur(10px); }
        .sidebar nav a.active { background:#FF2D2D; }
        .content { margin-left:250px; padding:24px; }
        .topbar { background: rgba(36,39,49,.8); border:1px solid rgba(255,255,255,.08); border-radius:16px; padding:12px 16px; backdrop-filter: blur(10px); }
        .card-dark { background: linear-gradient(145deg, rgba(36,39,49,.95), rgba(26,29,37,.95)); border:1px solid rgba(255,255,255,.08); border-radius:16px; box-shadow:0 10px 25px rgba(0,0,0,.25); }
        .content, .card-dark, .topbar, .table-dark, .dropdown-menu-dark { color:#f8fafc; }
        h1, h2, h3, h4, h5, h6, .fw-semibold, .fw-bold, label, th { color:#fff; }
        p, small, td, .small, .form-label { color:#eef2f7; }
        .text-muted, .text-secondary, .text-body-secondary { color:#d5dbe7 !important; }
        .text-light { color:#f8fafc !important; }
        .text-success { color:#65e69a !important; }
        .text-danger { color:#ff6868 !important; }
        .card-dark .text-muted, .topbar .text-muted, .table-dark .text-muted { color:#dce3ef !important; }
        .card-dark p, .card-dark small, .card-dark .small { line-height:1.55; }
        .card-dark a:hover { color:#fff; }
        .brand { font-size:1.3rem; font-weight:700; color:#FF2D2D; margin-bottom:24px; }
        .sidebar a { display:block; color:#fff; text-decoration:none; margin:10px 0; padding:10px 12px; border-radius:10px; transition:.2s; }
        .sidebar a:hover { background:#FF2D2D; transform: translateX(2px); }
        .kpi { padding:16px; }
        .kpi .value { font-size:1.2rem; font-weight:700; }
        .animate-fade { animation: fadeIn .35s ease; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(8px);} to { opacity:1; transform:translateY(0);} }
        .table-dark { background:#242731; border:1px solid rgba(255,255,255,.08); }
        .table-dark th, .table-dark td { border-color: rgba(255,255,255,.08); }
        .form-control, .form-select { background:#171b24; color:#fff; border-color:rgba(255,255,255,.18); }
        .form-control:focus, .form-select:focus { background:#171b24; color:#fff; border-color:#ff6868; box-shadow:0 0 0 .2rem rgba(255,104,104,.2); }
        .form-control::placeholder { color:#c5ccd8; }
        .dropdown-item { color:#f8fafc; }
        .btn-danger { background:#FF2D2D; border-color:#FF2D2D; }
        .btn-danger:hover { background:#e62a2a; border-color:#e62a2a; }
        .status-pill { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; font-size:.8rem; }
    </style>
</head>
<body>
@include('components.sidebar')
<div class="content">
    <div class="topbar d-flex justify-content-between align-items-center gap-2 mb-3">
        <div>
            <div class="fw-semibold">Dashboard Overview</div>
            <small class="text-muted">Panel operasional toko kacamata</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            @auth
                <span class="status-pill bg-success bg-opacity-25 text-success">
                    <i class="fas fa-circle" style="font-size: 0.6rem;"></i> Online
                </span>
                <span class="status-pill bg-danger bg-opacity-25 text-danger">{{ auth()->user()->name }}</span>
                <span class="status-pill bg-secondary bg-opacity-25 text-light">{{ ucfirst(auth()->user()->role ?? 'staff') }}</span>
            @endauth
            <div class="dropdown">
                <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="notifDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i> <span class="badge bg-danger" id="notifCount">0</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" id="notifList"></ul>
            </div>
        </div>
    </div>
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    fetch('/api/notifications')
        .then(response => response.ok ? response.json() : Promise.reject('not-ok'))
        .then(data => {
            const countEl = document.getElementById('notifCount');
            const listEl = document.getElementById('notifList');
            if (!countEl || !listEl) return;
            countEl.textContent = data.count ?? 0;
            listEl.innerHTML = (data.items || []).length
                ? (data.items || []).map(item => `<li class="dropdown-item text-white">${item.product_name}: stok ${item.stock} / minimum ${item.minimum_stock}</li>`).join('')
                : '<li class="dropdown-item text-white">Tidak ada notifikasi</li>';
        })
        .catch(() => {
            const countEl = document.getElementById('notifCount');
            if (countEl) countEl.textContent = '0';
        });
</script>
</body>
</html>
