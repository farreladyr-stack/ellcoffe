<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman Home publik dengan hero, produk unggulan, tentang kami, dan kontak.
     */
    public function home(): View
    {
        $featuredProducts = Product::with('category')->latest()->take(3)->get();
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('public.home', compact('featuredProducts', 'categories'));
    }

    /**
     * Menampilkan halaman katalog produk lengkap dengan filter kategori.
     */
    public function products(Request $request): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        $activeCategoryId = $request->query('category');

        $productsQuery = Product::with('category')->latest();

        if ($activeCategoryId) {
            $productsQuery->where('category_id', $activeCategoryId);
        }

        $products = $productsQuery->get();

        return view('public.products', compact('categories', 'products', 'activeCategoryId'));
    }

    /**
     * Menampilkan halaman detail produk berdasarkan ID.
     */
    public function show(int $id): View
    {
        $product = Product::with('category')->findOrFail($id);

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.detail', compact('product', 'relatedProducts'));
    }
}
