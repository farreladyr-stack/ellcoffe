@extends('layouts.admin')

@section('title', 'Data Produk — Admin Ellcoffee')
@section('page_title', 'Data Produk')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Data Produk Ellcoffee</h1>
            <p class="small text-muted-ell mb-0">Kelola seluruh menu kopi &amp; non-kopi yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-coffee btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="ell-card">
        <div class="table-responsive">
            <table class="table table-ellcoffee align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 55px;">No</th>
                        <th style="width: 85px;">Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th class="text-end" style="width: 190px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        <tr>
                            <td class="fw-semibold">{{ $index + 1 }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="rounded-3 object-fit-cover border"
                                         style="width: 60px; height: 60px;">
                                @else
                                    <div class="ell-placeholder rounded-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-cup-hot"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-espresso">{{ $product->name }}</div>
                                <div class="small text-muted-ell">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</div>
                            </td>
                            <td>
                                <span class="badge badge-category rounded-pill px-3 py-1">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="price-tag text-nowrap">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-coffee">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteProductModal"
                                            data-action="{{ route('admin.products.destroy', $product->id) }}"
                                            data-name="{{ $product->name }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted-ell">
                                Belum ada data produk. Klik <strong>Tambah Produk</strong> untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Produk -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--latte);">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-espresso">Konfirmasi Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus produk <strong id="deleteProductName"></strong>? Gambar produk terkait juga akan dihapus.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-outline-caramel" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteProductForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-4">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const deleteProductModal = document.getElementById('deleteProductModal');
    if (deleteProductModal) {
        deleteProductModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('deleteProductName').textContent = button.getAttribute('data-name');
            document.getElementById('deleteProductForm').setAttribute('action', button.getAttribute('data-action'));
        });
    }
</script>
@endpush
