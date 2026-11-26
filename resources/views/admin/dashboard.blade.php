@extends('layouts.admin')

@section('title', 'Dashboard Admin — Ellcoffee')
@section('page_title', 'Dashboard Admin')

@section('content')
    <!-- Statistik Ringkas -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-muted-ell">Total Produk</div>
                        <div class="fs-2 fw-bold text-espresso">{{ $totalProducts }}</div>
                    </div>
                    <i class="bi bi-cup-hot fs-1 text-caramel"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-muted-ell">Total Kategori</div>
                        <div class="fs-2 fw-bold text-espresso">{{ $totalCategories }}</div>
                    </div>
                    <i class="bi bi-tags fs-1 text-caramel"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-muted-ell">Rata-rata Harga</div>
                        <div class="fs-3 fw-bold text-espresso">Rp {{ number_format($averagePrice, 0, ',', '.') }}</div>
                    </div>
                    <i class="bi bi-cash-stack fs-1 text-caramel"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Terbaru -->
    <div class="ell-card p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <h2 class="h5 fw-bold mb-0">Produk Terbaru</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-coffee">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Produk
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-caramel">
                    Lihat Semua
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-ellcoffee align-middle mb-0">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentProducts as $product)
                        <tr>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td><span class="badge badge-category rounded-pill px-3 py-1">{{ $product->category->name ?? '-' }}</span></td>
                            <td class="price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-coffee">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted-ell py-4">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
