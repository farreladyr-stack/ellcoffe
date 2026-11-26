@extends('layouts.public')

@section('title', $product->name . ' — Ellcoffee')

@section('content')
    <section class="py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('public.home') }}" class="text-coffee text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('public.products') }}" class="text-coffee text-decoration-none">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="ell-card p-3 p-md-4 p-lg-5 mb-5">
                <div class="row g-4 g-lg-5 align-items-center">
                    <div class="col-lg-6">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-100 rounded-4 object-fit-cover"
                                 style="max-height: 430px;">
                        @else
                            <div class="ell-placeholder rounded-4" style="height: 360px;">
                                <i class="bi bi-cup-hot" style="font-size: 3.5rem;"></i>
                                <span class="mt-2 small">{{ $product->category->name ?? 'Ellcoffee' }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        <span class="badge badge-category rounded-pill px-3 py-2 mb-3">
                            {{ $product->category->name ?? 'Menu Ellcoffee' }}
                        </span>

                        <h1 class="display-6 fw-bold mb-2">{{ $product->name }}</h1>

                        <div class="fs-3 fw-bold text-caramel mb-4">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <div class="p-3 rounded-3 mb-4" style="background-color: var(--cream); border: 1px solid var(--latte);">
                            <h2 class="h6 fw-bold text-coffee mb-2">Deskripsi Produk</h2>
                            <p class="mb-0 text-muted-ell">{{ $product->description }}</p>
                        </div>

                        <a href="{{ route('public.products') }}" class="btn btn-coffee">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Katalog
                        </a>
                    </div>
                </div>
            </div>

            @if ($relatedProducts->isNotEmpty())
                <h2 class="h4 fw-bold mb-4">Menu Lainnya di {{ $product->category->name ?? 'Kategori Ini' }}</h2>
                <div class="row g-4">
                    @foreach ($relatedProducts as $related)
                        <div class="col-12 col-md-4">
                            <div class="ell-card p-3 h-100 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h3 class="h6 fw-bold mb-0">{{ $related->name }}</h3>
                                    <span class="price-tag small">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                </div>
                                <p class="small text-muted-ell mb-3 flex-grow-1">
                                    {{ \Illuminate\Support\Str::limit($related->description, 80) }}
                                </p>
                                <a href="{{ route('public.detail', $related->id) }}" class="btn btn-sm btn-outline-caramel">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
