<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel — Ellcoffee')</title>

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
    <div class="admin-wrapper">
        <!-- Sidebar Desktop -->
        <aside class="admin-sidebar d-none d-lg-flex p-4">
            <a class="ellcoffee-logo mb-1" href="{{ route('admin.dashboard') }}">
                <span class="ellcoffee-logo-mark" aria-hidden="true"></span>
                <span>Ellcoffee</span>
            </a>
            <div class="small mb-4" style="color: var(--latte);">Admin Management</div>

            <nav class="nav flex-column gap-1 flex-grow-1">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.edit') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                    <i class="bi bi-cup-hot"></i> Data Produk
                </a>
                <a class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}" href="{{ route('admin.products.create') }}">
                    <i class="bi bi-plus-circle"></i> Tambah Produk
                </a>
                <a class="nav-link {{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.categories.edit') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags"></i> Data Kategori
                </a>
                <a class="nav-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}" href="{{ route('admin.categories.create') }}">
                    <i class="bi bi-folder-plus"></i> Tambah Kategori
                </a>
            </nav>

            <hr style="border-color: rgba(216, 195, 165, 0.2);">

            <div class="d-flex flex-column gap-2">
                <a href="{{ route('public.home') }}" class="btn btn-sm btn-outline-caramel w-100">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Website
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light w-100 rounded-pill">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Offcanvas Sidebar Mobile -->
        <div class="offcanvas offcanvas-start admin-sidebar text-white" tabindex="-1" id="adminMobileSidebar">
            <div class="offcanvas-header">
                <span class="ellcoffee-logo">
                    <span class="ellcoffee-logo-mark" aria-hidden="true"></span>
                    <span>Ellcoffee</span>
                </span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <nav class="nav flex-column gap-1 flex-grow-1">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-cup-hot"></i> Data Produk
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}" href="{{ route('admin.products.create') }}">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-tags"></i> Data Kategori
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}" href="{{ route('admin.categories.create') }}">
                        <i class="bi bi-folder-plus"></i> Tambah Kategori
                    </a>
                </nav>
                <div class="mt-3 d-flex flex-column gap-2">
                    <a href="{{ route('public.home') }}" class="btn btn-sm btn-outline-caramel w-100">Lihat Website</a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light w-100 rounded-pill">Keluar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Area Konten -->
        <div class="admin-content d-flex flex-column">
            <header class="admin-topbar px-4 py-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-sm btn-outline-coffee d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminMobileSidebar">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <h6 class="mb-0 fw-semibold text-espresso">@yield('page_title', 'Dashboard Admin')</h6>
                </div>
                <div class="small text-muted-ell">
                    <i class="bi bi-person-circle me-1 text-caramel"></i>
                    {{ auth()->user()->name ?? 'Admin' }}
                </div>
            </header>

            <main class="p-4 flex-grow-1">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
