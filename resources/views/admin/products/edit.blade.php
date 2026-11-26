@extends('layouts.app')

@section('title', 'Ubah Menu: ' . $product->name . ' — Admin EllCoffe')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h2 fw-bold section-title mb-1">Ubah Data Menu</h1>
                            <p class="text-muted-cafe small mb-0">Perbarui informasi untuk <strong>{{ $product->name }}</strong>.</p>
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
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-semibold">Kategori Menu <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                           value="{{ old('name', $product->name) }}"
                                           class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="price" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price"
                                           value="{{ old('price', $product->price) }}"
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
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Ganti Foto Produk (Opsional)</label>
                                @if ($product->image)
                                    <div class="mb-2 d-flex align-items-center gap-3 p-2 rounded-3" style="background-color: var(--cream-paper);">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="rounded-2 object-fit-cover"
                                             style="width: 64px; height: 64px;">
                                        <span class="small text-muted-cafe">Foto saat ini. Unggah file baru jika ingin menggantinya.</span>
                                    </div>
                                @endif
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
                                    <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
