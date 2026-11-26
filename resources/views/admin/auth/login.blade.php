<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Ellcoffee</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/ellcoffee.css') }}" rel="stylesheet">
</head>
<body class="justify-content-center align-items-center p-3" style="background-color: var(--espresso);">

    <div class="ell-card p-4 p-md-5 shadow" style="width: 100%; max-width: 430px;">
        <div class="text-center mb-4">
            <span class="ellcoffee-logo justify-content-center mb-1" style="color: var(--espresso) !important;">
                <span class="ellcoffee-logo-mark" aria-hidden="true"></span>
                <span>Ellcoffee</span>
            </span>
            <p class="small text-muted-ell mb-0">Masuk ke Dashboard Admin</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success small border-0 mb-3">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger small border-0 mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold">Email Admin</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="admin@ellcoffee.id" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small fw-semibold">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small text-muted-ell" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-coffee w-100 mb-3">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Admin
            </button>

            <div class="text-center">
                <a href="{{ route('public.home') }}" class="small text-caramel text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Website
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
