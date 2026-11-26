@extends('layouts.admin')

@section('title', 'Tambah Produk — Admin Ellcoffee')
@section('page_title', 'Tambah Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Tambah Produk Baru</h1>
                    <p class="small text-muted-ell mb-0">Lengkapi detail produk minuman Ellcoffee di bawah ini.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-caramel">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <div class="fw-semibold mb-1"><i class="bi bi-exclamation-circle me-1"></i> Terdapat kesalahan input:</div>
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="ell-card p-4 p-md-5">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-semibold small">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label for="name" class="form-label fw-semibold small">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Ell Latte" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="price" class="form-label fw-semibold small">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" placeholder="Contoh: 26000" class="form-control @error('price') is-invalid @enderror">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold small">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="4" placeholder="Jelaskan cita rasa dan komposisi minuman..." class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold small">Foto Produk</label>
                        <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp" class="form-control @error('image') is-invalid @enderror">
                        <div class="form-text">Format: jpg, jpeg, png, atau webp. Maksimal 2 MB.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-caramel">Kembali</a>
                        <button type="submit" class="btn btn-coffee">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
