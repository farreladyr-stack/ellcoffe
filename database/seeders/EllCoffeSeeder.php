<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EllCoffeSeeder extends Seeder
{
    /**
     * Jalankan seeder admin, kategori, dan produk Ellcoffee.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ellcoffee.id'],
            [
                'name' => 'Admin Ellcoffee',
                'password' => Hash::make('ellcoffee123'),
            ]
        );

        $coffee = Category::create([
            'name' => 'Coffee',
            'description' => 'Racikan kopi klasik berbasis biji Arabika & Robusta Nusantara pilihan yang diseduh hangat maupun dingin.',
        ]);

        $signature = Category::create([
            'name' => 'Signature',
            'description' => 'Menu andalan khas Ellcoffee dengan sentuhan gula aren, karamel panggang, dan krim lembut.',
        ]);

        $nonCoffee = Category::create([
            'name' => 'Non Coffee',
            'description' => 'Pilihan minuman bebas kopi berbahan matcha premium, cokelat hitam Nusantara, dan susu segar.',
        ]);

        $products = [
            [
                'category_id' => $signature->id,
                'name' => 'Ell Latte',
                'price' => 26000,
                'description' => 'Perpaduan espresso Arabika Gayo yang lembut dengan susu segar dan gula aren organik. Menghadirkan rasa manis karamel yang hangat dan seimbang.',
                'image' => 'products/aren-latte.jpg',
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'Classic Americano',
                'price' => 22000,
                'description' => 'Double shot espresso house blend diseduh bersama air panas atau es untuk cita rasa kopi hitam yang bersih, ringan, dan aromatik.',
                'image' => 'products/toraja-filter.jpg',
            ],
            [
                'category_id' => $signature->id,
                'name' => 'Caramel Cloud',
                'price' => 32000,
                'description' => 'Espresso lembut berlapis susu creamy dan saus karamel panggang racikan sendiri dengan busa susu tebal di atasnya.',
                'image' => 'products/caramel-macchiato.jpg',
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'V60 Aceh Gayo Wine',
                'price' => 30000,
                'description' => 'Seduhan tangan pour-over V60 menggunakan biji single-origin Aceh Gayo dengan aroma buah beri dan aftertaste cokelat manis.',
                'image' => 'products/v60-gayo.jpg',
            ],
            [
                'category_id' => $nonCoffee->id,
                'name' => 'Matcha Ell',
                'price' => 29000,
                'description' => 'Bubuk matcha ceremonial grade yang dikocok halus bersama susu oat creamy, cocok dinikmati hangat maupun dingin.',
                'image' => 'products/matcha-oat.jpg',
            ],
            [
                'category_id' => $nonCoffee->id,
                'name' => 'Chocolate Cream',
                'price' => 27000,
                'description' => 'Cokelat hitam murni asal perkebunan Jawa Timur yang dilelehkan bersama susu hangat, menghadirkan cita rasa pekat dan menenangkan.',
                'image' => 'products/dark-chocolate.jpg',
            ],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }
    }
}
