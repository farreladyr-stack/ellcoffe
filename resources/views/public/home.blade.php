@extends('layouts.public')

@section('title', 'Ellcoffee — A Little Coffee, A Lot of Comfort.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <span class="badge badge-category rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-cup-hot me-1 text-caramel"></i> Ellcoffee Coffee Shop
                    </span>
                    <h1 class="display-5 fw-bold mb-3">
                        A Little Coffee, A Lot of Comfort.
                    </h1>
                    <p class="lead text-muted-ell mb-4">
                        Selamat datang di <strong>Ellcoffee</strong>. Kami menyajikan minuman kopi dan non-kopi pilihan dari biji kopi lokal Nusantara, diracik dengan penuh kehangatan untuk menemani setiap aktivitas Anda.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('public.products') }}" class="btn btn-coffee">
                            <i class="bi bi-cup-hot me-2"></i>Lihat Menu
                        </a>
                        <a href="#tentang" class="btn btn-outline-caramel">
                            Tentang Kami
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-frame">
                        <img src="{{ asset('images/hero-coffee.jpg') }}"
                             alt="Ellcoffee Artisan Latte"
                             class="w-100 object-fit-cover"
                             style="max-height: 410px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Unggulan -->
    <section class="py-5">
        <div class="container py-lg-2">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
                <div>
                    <span class="text-uppercase small fw-semibold text-caramel" style="letter-spacing: 0.08em;">Pilihan Favorit</span>
                    <h2 class="h2 fw-bold mb-0 mt-1">Produk Unggulan Ellcoffee</h2>
                </div>
                <a href="{{ route('public.products') }}" class="btn btn-sm btn-outline-caramel px-3">
                    Lihat Semua Menu <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse ($featuredProducts as $product)
                    <div class="col-12 col-md-6 col-lg-4">
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
                                <h3 class="h5 fw-bold mb-2">{{ $product->name }}</h3>
                                <p class="small text-muted-ell mb-4 flex-grow-1">
                                    {{ \Illuminate\Support\Str::limit($product->description, 95) }}
                                </p>
                                <a href="{{ route('public.detail', $product->id) }}" class="btn btn-coffee w-100 btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="ell-card p-5 text-center text-muted-ell">
                            Belum ada produk unggulan yang tersedia.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tentang Usaha Ellcoffee -->
    <section id="tentang" class="about-section py-5">
        <div class="container py-lg-3">
            <div class="row align-items-center gy-4">
                <div class="col-lg-5">
                    <div class="hero-image-frame">
                        <img src="{{ asset('storage/products/v60-gayo.jpg') }}"
                             alt="Suasana Seduh Kopi Ellcoffee"
                             class="w-100 object-fit-cover"
                             style="max-height: 360px;">
                    </div>
                </div>
                <div class="col-lg-7 ps-lg-5">
                    <span class="text-uppercase small fw-semibold text-caramel" style="letter-spacing: 0.08em;">Tentang Usaha</span>
                    <h2 class="h2 fw-bold mt-1 mb-3">Cerita di Balik Setiap Cangkir Ellcoffee</h2>
                    <p class="text-muted-ell mb-3">
                        <strong>Ellcoffee</strong> lahir sebagai usaha coffee shop UMKM yang ingin menghadirkan pengalaman ngopi yang hangat, tenang, dan terjangkau bagi semua kalangan.
                    </p>
                    <p class="text-muted-ell mb-4">
                        Kami bekerja sama dengan petani kopi lokal untuk memilih biji kopi terbaik dari Aceh Gayo hingga Toraja, serta menghadirkan pilihan minuman non-kopi seperti Matcha Ell dan Chocolate Cream yang diracik segar setiap hari.
                    </p>
                    <div class="row g-3">
                        @foreach ($categories as $cat)
                            <div class="col-4">
                                <div class="p-3 rounded-3 bg-white border text-center" style="border-color: var(--latte) !important;">
                                    <div class="fw-bold text-coffee fs-5">{{ $cat->products_count }}</div>
                                    <div class="small text-muted-ell">{{ $cat->name }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5">
        <div class="container py-lg-2">
            <div class="ell-card p-4 p-lg-5">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-7">
                        <span class="text-uppercase small fw-semibold text-caramel" style="letter-spacing: 0.08em;">Kunjungi Kami</span>
                        <h2 class="h3 fw-bold mt-1 mb-2">Ruang Nyaman untuk Bercerita &amp; Menikmati Kopi</h2>
                        <p class="text-muted-ell mb-0">
                            Datang langsung ke kedai Ellcoffee atau hubungi kami untuk pemesanan acara dan kolaborasi UMKM.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex flex-column gap-2 small">
                            <div><i class="bi bi-geo-alt-fill text-caramel me-2"></i><strong>Alamat:</strong> Jl. Kopi Nusantara No. 24, Yogyakarta</div>
                            <div><i class="bi bi-clock-fill text-caramel me-2"></i><strong>Jam Buka:</strong> Setiap Hari, 08.00 – 22.00 WIB</div>
                            <div><i class="bi bi-envelope-fill text-caramel me-2"></i><strong>Email:</strong> halo@ellcoffee.id</div>
                            <div><i class="bi bi-whatsapp text-caramel me-2"></i><strong>WhatsApp:</strong> +62 812-3456-7890</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
