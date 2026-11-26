<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ellcoffee — A Little Coffee, A Lot of Comfort.')</title>

    <!-- Google Fonts: Playfair Display & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Ellcoffee CSS -->
    <link href="{{ asset('css/ellcoffee.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Navbar Publik -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-ellcoffee sticky-top py-3">
        <div class="container">
            <a class="ellcoffee-logo" href="{{ route('public.home') }}">
                <span class="ellcoffee-logo-mark" aria-hidden="true"></span>
                <span>Ellcoffee</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#publicNav" aria-controls="publicNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="publicNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.home') ? 'active' : '' }}" href="{{ route('public.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.products') || request()->routeIs('public.detail') ? 'active' : '' }}" href="{{ route('public.products') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.home') }}#tentang">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.home') }}#kontak">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-sm btn-outline-caramel px-3" href="{{ auth()->check() ? route('admin.dashboard') : route('login') }}">
                            <i class="bi bi-person-lock me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-ellcoffee py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <a class="ellcoffee-logo mb-2" href="{{ route('public.home') }}">
                        <span class="ellcoffee-logo-mark" aria-hidden="true"></span>
                        <span>Ellcoffee</span>
                    </a>
                    <p class="small mb-2" style="color: var(--latte);">"A Little Coffee, A Lot of Comfort."</p>
                    <p class="small mb-0" style="color: rgba(247, 240, 230, 0.78);">
                        Coffee shop UMKM yang menghadirkan minuman kopi dan non-kopi berkualitas dengan cita rasa hangat dan nyaman untuk setiap momen Anda.
                    </p>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="font-serif text-white mb-3">Navigasi</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('public.home') }}">Home</a></li>
                        <li><a href="{{ route('public.products') }}">Katalog Produk</a></li>
                        <li><a href="{{ route('public.home') }}#tentang">Tentang Kami</a></li>
                        <li><a href="{{ route('public.home') }}#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-4">
                    <h6 class="font-serif text-white mb-3">Informasi Kontak</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0" style="color: var(--latte);">
                        <li><i class="bi bi-geo-alt me-2"></i>Jl. Kopi Nusantara No. 24, Yogyakarta</li>
                        <li><i class="bi bi-clock me-2"></i>Setiap Hari: 08.00 – 22.00 WIB</li>
                        <li><i class="bi bi-envelope me-2"></i>halo@ellcoffee.id</li>
                        <li><i class="bi bi-instagram me-2"></i>@ellcoffee.id</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(216, 195, 165, 0.2);">
            <div class="text-center small" style="color: rgba(216, 195, 165, 0.75);">
                &copy; {{ date('Y') }} Ellcoffee. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
