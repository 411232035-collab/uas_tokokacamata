@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <h4 class="mb-4">Tambah Kategori</h4>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Kategori</label>
            <input type="file" name="photo" id="categoryPhotoInput" class="form-control" accept="image/*">
            <div id="categoryPhotoPreview" class="mt-3 rounded-3 border border-white-10 d-none" style="width:160px;height:100px;overflow:hidden;background:#181b22;">
                <img id="categoryPhotoPreviewImg" class="w-100 h-100" style="object-fit:cover;" alt="Preview foto kategori">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <button class="btn btn-danger">Simpan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
