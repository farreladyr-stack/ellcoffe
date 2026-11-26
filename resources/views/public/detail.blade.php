@extends('layouts.app')

@section('title', $product->name . ' — EllCoffe Nusantara')

@section('content')
    <section class="py-5">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('public.home') }}" class="text-decoration-none" style="color: var(--roasted-coffee);">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('public.home', ['category' => $product->category_id]) }}" class="text-decoration-none" style="color: var(--roasted-coffee);">
                            {{ $product->category->name ?? 'Menu' }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            <!-- Detail Produk -->
            <div class="cafe-card p-3 p-md-4 p-lg-5 shadow-sm mb-5">
                <div class="row g-4 g-lg-5 align-items-center">
                    <div class="col-lg-6">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-100 rounded-4 object-fit-cover shadow-sm"
                                 style="max-height: 440px;">
                        @else
                            <div class="coffee-placeholder w-100 rounded-4 shadow-sm" style="height: 380px;">
                                <i class="bi bi-cup-hot-fill" style="font-size: 4rem;"></i>
                                <span class="mt-2 fw-semibold">{{ $product->category->name ?? 'EllCoffe Nusantara' }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <span class="badge badge-caramel rounded-pill px-3 py-2 mb-3">
                            <i class="bi bi-tag me-1"></i> {{ $product->category->name ?? 'Menu EllCoffe' }}
                        </span>

                        <h1 class="display-6 fw-bold mb-3" style="color: var(--espresso-dark);">
                            {{ $product->name }}
                        </h1>

                        <div class="fs-2 fw-bold price-caramel mb-4">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <div class="p-3 rounded-3 mb-4" style="background-color: var(--cream-paper); border: 1px solid rgba(74,44,24,0.1);">
                            <h2 class="h6 fw-bold section-title mb-2">
                                <i class="bi bi-journal-text me-1"></i> Catatan Rasa &amp; Deskripsi
                            </h2>
                            <p class="mb-0 text-muted-cafe" style="line-height: 1.75;">
                                {{ $product->description }}
                            </p>
                        </div>

                        @if ($product->category && $product->category->description)
                            <p class="small text-muted-cafe mb-4">
                                <strong>Tentang Kategori:</strong> {{ $product->category->description }}
                            </p>
                        @endif

                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('public.home') }}#daftar-menu" class="btn btn-roasted px-4 py-2 rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Menu
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-roasted px-4 py-2 rounded-pill">
                                <i class="bi bi-pencil-square me-2"></i> Ubah Menu Ini
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Terkait -->
            @if ($relatedProducts->isNotEmpty())
                <div class="pt-3">
                    <h2 class="h4 fw-bold section-title mb-4">Menu Lainnya di {{ $product->category->name ?? 'Kategori Ini' }}</h2>
                    <div class="row g-4">
                        @foreach ($relatedProducts as $related)
                            <div class="col-12 col-md-4">
                                <div class="cafe-card h-100 d-flex flex-column p-3">
                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                        <h3 class="h6 fw-bold mb-0">{{ $related->name }}</h3>
                                        <span class="price-caramel small text-nowrap">
                                            Rp {{ number_format($related->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <p class="small text-muted-cafe mb-3 flex-grow-1">
                                        {{ \Illuminate\Support\Str::limit($related->description, 85) }}
                                    </p>
                                    <a href="{{ route('public.detail', $related->id) }}" class="btn btn-sm btn-outline-roasted rounded-pill">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
