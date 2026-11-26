<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan halaman ringkasan dashboard admin.
     */
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $averagePrice = (int) Product::avg('price');
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'averagePrice',
            'recentProducts'
        ));
    }
}
