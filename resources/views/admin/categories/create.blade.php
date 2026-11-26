@extends('layouts.admin')

@section('title', 'Tambah Kategori — Admin Ellcoffee')
@section('page_title', 'Tambah Kategori')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Tambah Kategori Baru</h1>
                    <p class="small text-muted-ell mb-0">Buat kategori baru untuk mengelompokkan menu Ellcoffee.</p>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-caramel">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="ell-card p-4 p-md-5">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Manual Brew" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold small">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" placeholder="Deskripsi singkat kategori..." class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-caramel">Kembali</a>
                        <button type="submit" class="btn btn-coffee">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
