@extends('layouts.app')

@section('title', 'EllCoffe — Warm Artisan Cafe & Roastery | PT EllCoffe Nusantara')

@section('content')
    <!-- Hero & Profil Usaha -->
    <section class="py-5 border-bottom" style="background: linear-gradient(180deg, #EFE6DD 0%, #FAF6F1 100%); border-color: rgba(74, 44, 24, 0.12) !important;">
        <div class="container py-lg-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7">
                    <span class="badge badge-caramel rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-award me-1"></i> PT EllCoffe Nusantara &bull; UMKM Kopi Lokal
                    </span>
                    <h1 class="display-5 fw-bold mb-3" style="color: var(--espresso-dark);">
                        Kehangatan Biji Kopi Nusantara dalam Setiap Seduhan
                    </h1>
                    <p class="lead text-muted-cafe mb-4" style="line-height: 1.75;">
                        <strong>EllCoffe</strong> adalah UMKM kopi lokal di bawah naungan <strong>PT EllCoffe Nusantara</strong> yang berkomitmen mengangkat cita rasa biji kopi terbaik dari petani Gayo, Toraja, hingga Jawa Timur. Melalui proses sangrai yang presisi dan teknik seduh artisan, kami menghadirkan pengalaman menikmati kopi yang hangat, bersahabat, dan berkesan.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#daftar-menu" class="btn btn-roasted btn-lg px-4 rounded-pill">
                            <i class="bi bi-cup-hot me-2"></i> Jelajahi Menu
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-roasted btn-lg px-4 rounded-pill">
                            <i class="bi bi-gear me-2"></i> Kelola Produk
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cafe-card p-4 p-lg-5 text-center shadow-sm">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 76px; height: 76px; background-color: var(--espresso-dark);">
                            <i class="bi bi-cup-hot-fill fs-2" style="color: var(--caramel-gold);"></i>
                        </div>
                        <h3 class="h4 fw-bold section-title mb-2">Filosofi Seduhan Kami</h3>
                        <p class="small text-muted-cafe mb-4">
                            Setiap cangkir diracik segar saat dipesan menggunakan biji kopi sangrai pilihan untuk menjaga aroma karamel, cokelat, dan rempah khas Nusantara.
                        </p>
                        <div class="row g-2 text-start">
                            <div class="col-6">
                                <div class="p-3 rounded-3" style="background-color: var(--cream-paper);">
                                    <div class="fw-bold price-caramel fs-5">{{ $categories->count() }}</div>
                                    <div class="small text-muted-cafe">Kategori Pilihan</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded-3" style="background-color: var(--cream-paper);">
                                    <div class="fw-bold price-caramel fs-5">{{ $products->count() }}</div>
                                    <div class="small text-muted-cafe">Menu Tersedia</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Kategori & Daftar Menu -->
    <section id="daftar-menu" class="py-5">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
                <div>
                    <span class="text-uppercase fw-bold small" style="color: var(--caramel-gold); letter-spacing: 0.08em;">
                        Katalog Minuman &amp; Kopi
                    </span>
                    <h2 class="h2 fw-bold section-title mb-0 mt-1">Menu Pilihan EllCoffe</h2>
                </div>
                <p class="text-muted-cafe mb-0 small">
                    Pilih kategori di bawah untuk menyaring menu sesuai selera Anda.
                </p>
            </div>

            <!-- Chip Filter Kategori -->
            <div class="d-flex flex-wrap gap-2 mb-4 pb-2">
                <a href="{{ route('public.home') }}#daftar-menu"
                   class="category-chip {{ empty($activeCategoryId) ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Semua Menu
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('public.home', ['category' => $category->id]) }}#daftar-menu"
                       class="category-chip {{ (string) $activeCategoryId === (string) $category->id ? 'active' : '' }}">
                        <i class="bi bi-cup-straw"></i>
                        <span>{{ $category->name }}</span>
                        <span class="badge rounded-pill {{ (string) $activeCategoryId === (string) $category->id ? 'bg-light text-dark' : 'badge-caramel' }}">
                            {{ $category->products_count }}
                        </span>
                    </a>
                @endforeach
            </div>

            <!-- Grid Produk -->
            @if ($products->isEmpty())
                <div class="cafe-card p-5 text-center">
                    <i class="bi bi-cup fs-1 mb-3 d-block" style="color: var(--caramel-gold);"></i>
                    <h3 class="h5 fw-bold section-title">Belum Ada Menu pada Kategori Ini</h3>
                    <p class="text-muted-cafe mb-3">Silakan pilih kategori lain atau tambahkan menu baru melalui panel admin.</p>
                    <a href="{{ route('public.home') }}" class="btn btn-roasted rounded-pill px-4">Lihat Semua Menu</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <article class="cafe-card h-100 d-flex flex-column">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-100 object-fit-cover"
                                         style="height: 230px;">
                                @else
                                    <div class="coffee-placeholder w-100" style="height: 230px;">
                                        <i class="bi bi-cup-hot fs-1 mb-2"></i>
                                        <span class="small fw-semibold">{{ $product->category->name ?? 'EllCoffe' }}</span>
                                    </div>
                                @endif

                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                        <span class="badge badge-caramel rounded-pill px-3 py-1">
                                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                                        </span>
                                        <span class="price-caramel fs-5 text-nowrap">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <h3 class="h5 fw-bold mb-2" style="color: var(--espresso-dark);">
                                        {{ $product->name }}
                                    </h3>

                                    <p class="small text-muted-cafe mb-4 flex-grow-1">
                                        {{ \Illuminate\Support\Str::limit($product->description, 110) }}
                                    </p>

                                    <a href="{{ route('public.detail', $product->id) }}" class="btn btn-roasted w-100 rounded-pill">
                                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
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
