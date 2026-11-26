@extends('layouts.admin')

@section('title', 'Data Kategori — Admin Ellcoffee')
@section('page_title', 'Data Kategori')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Data Kategori</h1>
            <p class="small text-muted-ell mb-0">Kelola kategori produk Ellcoffee.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-coffee btn-sm">
            <i class="bi bi-folder-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    <div class="ell-card">
        <div class="table-responsive">
            <table class="table table-ellcoffee align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 55px;">No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Produk</th>
                        <th class="text-end" style="width: 190px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td class="fw-semibold">{{ $index + 1 }}</td>
                            <td class="fw-semibold text-espresso">{{ $category->name }}</td>
                            <td class="small text-muted-ell">{{ $category->description ?? '-' }}</td>
                            <td>
                                <span class="badge badge-category rounded-pill px-3 py-1">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-coffee">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteCategoryModal"
                                            data-action="{{ route('admin.categories.destroy', $category->id) }}"
                                            data-name="{{ $category->name }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted-ell">
                                Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Kategori -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--latte);">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-espresso">Konfirmasi Hapus Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus kategori <strong id="deleteCategoryName"></strong>? Seluruh produk di kategori ini juga akan ikut terhapus.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-outline-caramel" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteCategoryForm" method="POST">
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
    const deleteCategoryModal = document.getElementById('deleteCategoryModal');
    if (deleteCategoryModal) {
        deleteCategoryModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('deleteCategoryName').textContent = button.getAttribute('data-name');
            document.getElementById('deleteCategoryForm').setAttribute('action', button.getAttribute('data-action'));
        });
    }
</script>
@endpush
