<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EllCoffe — Warm Artisan Cafe & Roastery')</title>

    <!-- Google Fonts: Playfair Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --cream-paper: #FAF6F1;
            --espresso-dark: #1E130C;
            --roasted-coffee: #4A2C18;
            --warm-latte: #EFE6DD;
            --caramel-gold: #C68B59;
            --caramel-hover: #b37847;
            --text-muted-cafe: #6b5647;
        }

        body {
            background-color: var(--cream-paper);
            color: var(--espresso-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, h4, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar-ellcoffe {
            background-color: var(--espresso-dark);
            border-bottom: 2px solid rgba(198, 139, 89, 0.25);
        }

        .navbar-ellcoffe .nav-link {
            color: #f3ebe2;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .navbar-ellcoffe .nav-link:hover,
        .navbar-ellcoffe .nav-link.active {
            color: var(--caramel-gold);
        }

        /* Buttons */
        .btn-roasted {
            background-color: var(--roasted-coffee);
            color: #FAF6F1;
            border: 1px solid var(--roasted-coffee);
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn-roasted:hover,
        .btn-roasted:focus {
            background-color: var(--caramel-gold);
            border-color: var(--caramel-gold);
            color: var(--espresso-dark);
        }

        .btn-outline-roasted {
            color: var(--roasted-coffee);
            border: 1.5px solid var(--roasted-coffee);
            background-color: transparent;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn-outline-roasted:hover {
            background-color: var(--roasted-coffee);
            color: var(--cream-paper);
        }

        /* Warm Latte Surface & Cards */
        .bg-warm-latte {
            background-color: var(--warm-latte);
        }

        .cafe-card {
            background-color: var(--warm-latte);
            border: 1px solid rgba(74, 44, 24, 0.12);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .cafe-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(30, 19, 12, 0.1);
            border-color: var(--caramel-gold);
        }

        /* Filter Chips */
        .category-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 1.15rem;
            border-radius: 999px;
            background-color: var(--warm-latte);
            color: var(--espresso-dark);
            border: 1px solid rgba(74, 44, 24, 0.18);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .category-chip:hover {
            border-color: var(--caramel-gold);
            color: var(--roasted-coffee);
            background-color: #e7dacd;
        }

        .category-chip.active {
            background-color: var(--roasted-coffee);
            color: var(--cream-paper);
            border-color: var(--roasted-coffee);
        }

        /* Badges & Price */
        .badge-caramel {
            background-color: rgba(198, 139, 89, 0.2);
            color: var(--roasted-coffee);
            border: 1px solid rgba(198, 139, 89, 0.45);
            font-weight: 600;
        }

        .price-caramel {
            color: var(--caramel-gold);
            font-weight: 700;
        }

        .section-title {
            color: var(--roasted-coffee);
        }

        .text-muted-cafe {
            color: var(--text-muted-cafe);
        }

        /* Placeholder Image Box */
        .coffee-placeholder {
            background: linear-gradient(135deg, #e7dacb 0%, #d8c3ae 100%);
            color: var(--roasted-coffee);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Admin Table */
        .table-ellcoffe thead th {
            background-color: var(--espresso-dark);
            color: var(--cream-paper);
            border-color: var(--espresso-dark);
            font-weight: 600;
            padding: 0.9rem 1rem;
        }

        .table-ellcoffe tbody tr {
            border-color: rgba(74, 44, 24, 0.12);
        }

        .table-ellcoffe tbody tr:hover {
            background-color: rgba(239, 230, 221, 0.6);
        }

        /* Footer */
        .footer-ellcoffe {
            background-color: var(--espresso-dark);
            color: #e6dcd2;
            margin-top: auto;
            border-top: 3px solid var(--caramel-gold);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-ellcoffe sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('public.home') }}">
                <!-- Custom SVG Logo Cangkir Kopi & Uap Hangat -->
                <svg width="38" height="38" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M17 12C17 9.5 19 8.5 19 6" stroke="#C68B59" stroke-width="2.4" stroke-linecap="round"/>
                    <path d="M23.5 11C23.5 8 25.5 7 25.5 4.5" stroke="#C68B59" stroke-width="2.4" stroke-linecap="round"/>
                    <path d="M30 12C30 9.5 32 8.5 32 6" stroke="#C68B59" stroke-width="2.4" stroke-linecap="round"/>
                    <path d="M10 18H35V28C35 34.6274 29.6274 40 23 40H22C15.3726 40 10 34.6274 10 28V18Z" fill="#FAF6F1"/>
                    <path d="M13 21H32V23.5C32 24.8807 27.7467 26 22.5 26C17.2533 26 13 24.8807 13 23.5V21Z" fill="#4A2C18"/>
                    <path d="M35 20H37.5C39.9853 20 42 22.0147 42 24.5C42 26.9853 39.9853 29 37.5 29H35" stroke="#C68B59" stroke-width="2.6" stroke-linecap="round"/>
                    <path d="M8 42H37" stroke="#C68B59" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
                <div class="d-flex flex-column lh-1">
                    <span class="font-serif fs-4 fw-bold text-white tracking-wide">EllCoffe</span>
                    <small style="font-size: 0.65rem; color: #C68B59; letter-spacing: 0.08em;">ARTISAN CAFE & ROASTERY</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarEllCoffe" aria-controls="navbarEllCoffe" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarEllCoffe">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.home') ? 'active' : '' }}" href="{{ route('public.home') }}">
                            <i class="bi bi-cup-hot me-1"></i> Beranda & Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                            <i class="bi bi-sliders me-1"></i> Kelola Menu (Admin)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-ellcoffe py-5 mt-5">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <svg width="34" height="34" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M17 12C17 9.5 19 8.5 19 6" stroke="#C68B59" stroke-width="2.4" stroke-linecap="round"/>
                            <path d="M23.5 11C23.5 8 25.5 7 25.5 4.5" stroke="#C68B59" stroke-width="2.4" stroke-linecap="round"/>
                            <path d="M30 12C30 9.5 32 8.5 32 6" stroke="#C68B59" stroke-width="2.4" stroke-linecap="round"/>
                            <path d="M10 18H35V28C35 34.6274 29.6274 40 23 40H22C15.3726 40 10 34.6274 10 28V18Z" fill="#FAF6F1"/>
                            <path d="M13 21H32V23.5C32 24.8807 27.7467 26 22.5 26C17.2533 26 13 24.8807 13 23.5V21Z" fill="#4A2C18"/>
                            <path d="M35 20H37.5C39.9853 20 42 22.0147 42 24.5C42 26.9853 39.9853 29 37.5 29H35" stroke="#C68B59" stroke-width="2.6" stroke-linecap="round"/>
                            <path d="M8 42H37" stroke="#C68B59" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                        <span class="font-serif fs-4 fw-bold text-white">EllCoffe</span>
                    </div>
                    <p class="mb-1 fw-semibold text-white">PT EllCoffe Nusantara</p>
                    <p class="small mb-0" style="color: #cfc2b5;">
                        UMKM Kopi Lokal &amp; Roastery yang menghadirkan biji kopi pilihan Nusantara dengan sentuhan seduhan hangat dan penuh cerita di setiap cangkir.
                    </p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="d-flex flex-wrap justify-content-lg-end gap-3 mb-2 small">
                        <a href="{{ route('public.home') }}" class="text-decoration-none" style="color: #C68B59;">Katalog Menu</a>
                        <a href="{{ route('admin.products.index') }}" class="text-decoration-none" style="color: #C68B59;">Panel Admin</a>
                    </div>
                    <p class="small mb-0" style="color: #a99888;">
                        &copy; {{ date('Y') }} PT EllCoffe Nusantara. Dibuat dengan hangat untuk pecinta kopi Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
