@extends('layouts.public')

@section('title', 'Katalog Produk — Ellcoffee')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <span class="text-uppercase small fw-semibold text-caramel" style="letter-spacing: 0.08em;">Menu Kami</span>
                <h1 class="display-6 fw-bold mt-1 mb-2">Katalog Minuman Ellcoffee</h1>
                <p class="text-muted-ell mx-auto" style="max-width: 580px;">
                    Temukan racikan kopi dan non-kopi favorit Anda. Pilih kategori di bawah untuk menyaring daftar menu.
                </p>
            </div>

            <!-- Filter Kategori -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                <a href="{{ route('public.products') }}"
                   class="filter-chip {{ empty($activeCategoryId) ? 'active' : '' }}">
                    Semua Menu
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('public.products', ['category' => $category->id]) }}"
                       class="filter-chip {{ (string) $activeCategoryId === (string) $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                        <span class="badge rounded-pill {{ (string) $activeCategoryId === (string) $category->id ? 'bg-light text-dark' : 'badge-category' }}">
                            {{ $category->products_count }}
                        </span>
                    </a>
                @endforeach
            </div>

            <!-- Daftar Produk -->
            @if ($products->isEmpty())
                <div class="ell-card p-5 text-center">
                    <i class="bi bi-cup fs-1 text-caramel d-block mb-2"></i>
                    <h2 class="h5 fw-bold">Belum Ada Produk pada Kategori Ini</h2>
                    <p class="text-muted-ell mb-3">Silakan pilih kategori lain untuk melihat menu yang tersedia.</p>
                    <a href="{{ route('public.products') }}" class="btn btn-coffee btn-sm">Lihat Semua Produk</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <article class="ell-card h-100 d-flex flex-column">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="ell-card-img">
                                @else
                                    <div class="ell-placeholder">
                                        <i class="bi bi-cup-hot fs-1 mb-2"></i>
                                        <span class="small">{{ $product->category->name ?? 'Ellcoffee' }}</span>
                                    </div>
                                @endif

                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge badge-category rounded-pill px-3 py-1">
                                            {{ $product->category->name ?? 'Menu' }}
                                        </span>
                                        <span class="price-tag">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <h2 class="h5 fw-bold mb-2">{{ $product->name }}</h2>

                                    <p class="small text-muted-ell mb-4 flex-grow-1">
                                        {{ \Illuminate\Support\Str::limit($product->description, 100) }}
                                    </p>

                                    <a href="{{ route('public.detail', $product->id) }}" class="btn btn-coffee btn-sm w-100">
                                        Detail Produk <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
