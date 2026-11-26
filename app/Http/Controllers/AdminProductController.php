<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    /**
     * Menampilkan daftar seluruh produk di panel admin.
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->get();
        $totalCategories = Category::count();

        return view('admin.products.index', compact('products', 'totalCategories'));
    }

    /**
     * Menampilkan form tambah produk baru.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke database beserta upload gambar.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Menu "' . $validated['name'] . '" berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk dan mengganti gambar lama jika ada gambar baru.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Menu "' . $product->name . '" berhasil diperbarui.');
    }

    /**
     * Menghapus produk beserta file gambarnya dari storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Menu "' . $name . '" berhasil dihapus.');
    }

    /**
     * Validasi sisi server untuk form tambah dan ubah produk.
     */
    private function validateProduct(Request $request): array
    {
        return $request->validate(
            [
                'category_id' => ['required', 'exists:categories,id'],
                'name'        => ['required', 'string', 'max:100'],
                'price'       => ['required', 'integer', 'min:0'],
                'description' => ['required', 'string', 'max:1000'],
                'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ],
            [
                'category_id.required' => 'Kategori menu wajib dipilih.',
                'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
                'name.required'        => 'Nama produk wajib diisi.',
                'name.max'             => 'Nama produk maksimal 100 karakter.',
                'price.required'       => 'Harga produk wajib diisi.',
                'price.integer'        => 'Harga harus berupa angka bulat.',
                'price.min'            => 'Harga minimal adalah Rp 0.',
                'description.required' => 'Deskripsi menu wajib diisi.',
                'description.max'      => 'Deskripsi maksimal 1.000 karakter.',
                'image.image'          => 'File yang diunggah harus berupa gambar.',
                'image.mimes'          => 'Format gambar yang didukung: JPG, JPEG, PNG, atau WEBP.',
                'image.max'            => 'Ukuran gambar maksimal 2 MB.',
            ]
        );
    }
}
