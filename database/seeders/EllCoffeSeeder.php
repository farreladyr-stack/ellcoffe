<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class EllCoffeSeeder extends Seeder
{
    /**
     * Jalankan seeder data kategori dan menu kopi EllCoffe Nusantara.
     */
    public function run(): void
    {
        $signature = Category::create([
            'name' => 'Signature Espresso',
            'description' => 'Racikan espresso berbasis biji Arabika Nusantara dengan karakter rasa khas, seimbang, dan kaya aroma.',
        ]);

        $manualBrew = Category::create([
            'name' => 'Manual Brew Nusantara',
            'description' => 'Seduhan tangan (V60, Kalita, Tubruk Artisan) dari biji single-origin pilihan petani kopi Indonesia.',
        ]);

        $nonCoffee = Category::create([
            'name' => 'Non-Coffee & Artisan Tea',
            'description' => 'Pilihan minuman hangat dan dingin bebas kopi berbahan cokelat lokal, matcha, dan rempah Nusantara.',
        ]);

        $products = [
            [
                'category_id' => $signature->id,
                'name' => 'EllCoffe Aren Latte',
                'price' => 26000,
                'description' => 'Perpaduan espresso Arabika Gayo yang lembut dengan susu segar dan gula aren organik Nusantara. Memberikan rasa manis karamel yang hangat dan seimbang.',
                'image' => null,
            ],
            [
                'category_id' => $signature->id,
                'name' => 'Caramel Macchiato Roasted',
                'price' => 32000,
                'description' => 'Double shot espresso house blend dipadukan dengan steamed milk creamy dan saus karamel panggang racikan sendiri.',
                'image' => null,
            ],
            [
                'category_id' => $manualBrew->id,
                'name' => 'V60 Aceh Gayo Wine',
                'price' => 30000,
                'description' => 'Diseduh perlahan menggunakan metode pour-over V60 untuk menonjolkan aroma buah beri, keasaman cerah, dan aftertaste cokelat manis.',
                'image' => null,
            ],
            [
                'category_id' => $manualBrew->id,
                'name' => 'Toraja Sapan Filter',
                'price' => 28000,
                'description' => 'Single-origin dataran tinggi Toraja dengan karakter body medium, sentuhan rempah hangat, serta rasa kacang panggang yang bersih.',
                'image' => null,
            ],
            [
                'category_id' => $nonCoffee->id,
                'name' => 'Artisan Dark Chocolate Nusantara',
                'price' => 27000,
                'description' => 'Cokelat hitam murni asal perkebunan Jawa Timur yang dilelehkan bersama susu hangat, menghadirkan cita rasa pekat dan menenangkan.',
                'image' => null,
            ],
            [
                'category_id' => $nonCoffee->id,
                'name' => 'Matcha Cream Oat',
                'price' => 29000,
                'description' => 'Bubuk matcha premium yang dikocok halus bersama susu oat creamy, cocok dinikmati hangat maupun dingin untuk suasana santai.',
                'image' => null,
            ],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }
    }
}
