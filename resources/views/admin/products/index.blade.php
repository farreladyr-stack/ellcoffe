@extends('layouts.app')

@section('title', 'Kelola Produk — Admin EllCoffe')

@section('content')
    <section class="py-5">
        <div class="container">
            <!-- Header Admin -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <span class="text-uppercase fw-bold small" style="color: var(--caramel-gold); letter-spacing: 0.08em;">
                        Panel Manajemen UMKM
                    </span>
                    <h1 class="h2 fw-bold section-title mb-1">Daftar Menu EllCoffe</h1>
                    <p class="text-muted-cafe small mb-0">
                        Total <strong>{{ $products->count() }}</strong> menu terdaftar dalam <strong>{{ $totalCategories }}</strong> kategori.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('public.home') }}" class="btn btn-outline-roasted rounded-pill px-3">
                        <i class="bi bi-eye me-1"></i> Lihat Beranda
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-roasted rounded-pill px-4">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Menu
                    </a>
                </div>
            </div>

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #e6f4ea; color: #1e4620;">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tabel Produk -->
            <div class="cafe-card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-ellcoffe align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th style="width: 90px;">Foto</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th class="text-end" style="width: 190px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr>
                                    <td class="fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="rounded-3 object-fit-cover border"
                                                 style="width: 64px; height: 64px;">
                                        @else
                                            <div class="coffee-placeholder rounded-3" style="width: 64px; height: 64px;">
                                                <i class="bi bi-cup-hot fs-4"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--espresso-dark);">{{ $product->name }}</div>
                                        <div class="small text-muted-cafe">{{ \Illuminate\Support\Str::limit($product->description, 65) }}</div>
                                    </td>
                                    <td>
                                        <span class="badge badge-caramel rounded-pill px-3 py-2">
                                            {{ $product->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="price-caramel text-nowrap">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                               class="btn btn-sm btn-outline-roasted rounded-pill px-3">
                                                <i class="bi bi-pencil-square me-1"></i> Ubah
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus menu {{ addslashes($product->name) }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-cup fs-2 d-block mb-2" style="color: var(--caramel-gold);"></i>
                                        <p class="mb-2 fw-semibold">Belum ada data produk.</p>
                                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-roasted rounded-pill px-3">
                                            Tambah Menu Pertama
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
