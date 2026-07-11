@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Tambah Produk</h4>
            <p class="text-muted mb-0">Tambahkan koleksi kacamata baru ke katalog.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-light"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1">Data produk belum lengkap.</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kode Produk</label>
                <input name="product_code" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code', $suggestedCode) }}" required>
                @error('product_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Produk</label>
                <input name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" placeholder="Contoh: Ray-Ban Aviator Classic" required>
                @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id') === (string) $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @if($categories->isEmpty())
                    <div class="form-text text-warning">Kategori belum ada. Produk tetap bisa disimpan tanpa kategori.</div>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga Beli</label>
                <input name="purchase_price" type="number" min="0" step="1000" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price', 1000000) }}" required>
                @error('purchase_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga Jual</label>
                <input name="selling_price" type="number" min="0" step="1000" class="form-control @error('selling_price') is-invalid @enderror" value="{{ old('selling_price', 1500000) }}" required>
                @error('selling_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Stok</label>
                <input name="stock" type="number" min="0" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 10) }}" required>
                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Minimum Stock</label>
                <input name="minimum_stock" type="number" min="0" class="form-control @error('minimum_stock') is-invalid @enderror" value="{{ old('minimum_stock', 5) }}" required>
                @error('minimum_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Foto Produk</label>
                <input type="file" name="photo" id="productPhotoInput" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div id="productPhotoPreview" class="mt-3 rounded-3 border border-white-10 d-none" style="width:160px;height:100px;overflow:hidden;background:#181b22;">
                    <img id="productPhotoPreviewImg" class="w-100 h-100" style="object-fit:cover;" alt="Preview foto produk">
                </div>
            </div>
        </div>
        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-danger"><i class="fas fa-save me-2"></i>Simpan</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
<script>
    const productInput = document.getElementById('productPhotoInput');
    const productPreview = document.getElementById('productPhotoPreview');
    const productPreviewImg = document.getElementById('productPhotoPreviewImg');
    if (productInput) {
        productInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                productPreviewImg.src = e.target.result;
                productPreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
