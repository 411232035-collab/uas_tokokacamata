@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Kategori</h4>
            <p class="text-muted mb-0">Kelompokkan koleksi kacamata Anda.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-danger"><i class="fas fa-plus me-2"></i>Tambah Kategori</a>
    </div>

    <div class="row g-4">
        @foreach($categories as $category)
            <div class="col-lg-4 col-md-6">
                <div class="card-dark h-100 p-3 border border-white-10">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if($category->photo_path)
                            <img src="{{ asset('storage/' . $category->photo_path) }}" alt="{{ $category->name }}" width="64" height="64" style="object-fit:cover;border-radius:12px;">
                        @else
                            <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:rgba(255,45,45,.15);">
                                <i class="fas fa-tags text-danger"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-1">{{ $category->name }}</h5>
                            <div class="small text-muted">{{ $category->slug }}</div>
                        </div>
                    </div>
                    <div class="small text-muted mb-3">{{ $category->description ?? 'Kategori produk kacamata.' }}</div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-light"><i class="fas fa-edit me-1"></i>Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash me-1"></i>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
