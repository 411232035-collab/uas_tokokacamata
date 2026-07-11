@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Upload Banner Landing Page</h4>
            <p class="text-muted mb-0">Pilih gambar banner lalu lihat pratinjau sebelum disimpan.</p>
        </div>
        <span class="badge bg-danger">Banner</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">File Banner</label>
                    <input type="file" name="banner" id="bannerInput" class="form-control" accept="image/*">
                </div>
                <div class="small text-muted">Format yang didukung: JPG, PNG, WebP. Maksimal 2 MB.</div>
                <div class="mt-3">
                    <button class="btn btn-danger"><i class="fas fa-upload me-2"></i>Unggah Banner</button>
                </div>
            </form>
        </div>
        <div class="col-lg-5">
            <div class="card-dark p-3 border border-white-10">
                <h6 class="mb-3">Pratinjau Banner</h6>
                <div id="bannerPreviewWrapper" class="rounded-3 border border-white-10 d-none" style="max-width:100%;overflow:hidden;background:#181b22;">
                    <img id="bannerPreviewImg" class="w-100" style="max-height:260px;object-fit:cover;" alt="Preview banner">
                </div>
                <div class="mt-3 small text-muted">Preview akan muncul segera setelah Anda memilih file.</div>
            </div>
        </div>
    </div>
</div>

<script>
    const bannerInput = document.getElementById('bannerInput');
    const bannerPreviewWrapper = document.getElementById('bannerPreviewWrapper');
    const bannerPreviewImg = document.getElementById('bannerPreviewImg');
    if (bannerInput) {
        bannerInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                bannerPreviewImg.src = e.target.result;
                bannerPreviewWrapper.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
