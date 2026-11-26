@extends('layouts.app')

@section('title', 'Tambah Menu Baru — Admin EllCoffe')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h2 fw-bold section-title mb-1">Tambah Menu Baru</h1>
                            <p class="text-muted-cafe small mb-0">Lengkapi informasi menu kopi atau minuman EllCoffe.</p>
                        </div>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-roasted rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Periksa kembali isian formulir:</div>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="cafe-card p-4 p-md-5 shadow-sm">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-semibold">Kategori Menu <span class="text-danger">*</span></label>
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
                                    <label for="name" class="form-label fw-semibold">Nama Menu <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                           value="{{ old('name') }}"
                                           placeholder="Contoh: V60 Flores Bajawa"
                                           class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="price" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price"
                                           value="{{ old('price') }}"
                                           placeholder="Contoh: 28000"
                                           min="1000"
                                           class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">Deskripsi &amp; Catatan Rasa <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="4"
                                          placeholder="Jelaskan profil rasa, bahan, atau metode penyeduhan..."
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Foto Produk (Opsional)</label>
                                <input type="file" name="image" id="image"
                                       accept=".jpg,.jpeg,.png,.webp"
                                       class="form-control @error('image') is-invalid @enderror">
                                <div class="form-text">Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-roasted rounded-pill px-4">Batal</a>
                                <button type="submit" class="btn btn-roasted rounded-pill px-4">
                                    <i class="bi bi-save me-1"></i> Simpan Menu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
