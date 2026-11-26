<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    /**
     * Menampilkan daftar seluruh kategori.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori baru.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name'        => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string', 'max:500'],
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.max'      => 'Nama kategori maksimal 100 karakter.',
                'description.max' => 'Deskripsi maksimal 500 karakter.',
            ]
        );

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori "' . $validated['name'] . '" berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name'        => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string', 'max:500'],
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.max'      => 'Nama kategori maksimal 100 karakter.',
                'description.max' => 'Deskripsi maksimal 500 karakter.',
            ]
        );

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori "' . $category->name . '" berhasil diperbarui.');
    }

    /**
     * Menghapus kategori beserta produk terkait (cascade).
     */
    public function destroy(Category $category): RedirectResponse
    {
        $name = $category->name;
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori "' . $name . '" berhasil dihapus.');
    }
}
