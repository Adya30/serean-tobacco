<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Tembakau Opot (Besuki Na-Oogst)',
                'slug' => 'tembakau-opot-besuki-na-oogst',
                'variety' => 'Besuki Na-Oogst',
                'grade' => 'Super',
                'category' => 'rajang',
                'origin' => 'Banyuglugur, Situbondo',
                'description' => 'Daun tembakau petikan pilihan dengan getah pekat alami, aroma harum khas Na-Oogst, dan pembakaran merata.',
                'price_per_kg' => 95000,
                'stock_kg' => 450,
                'moisture_content' => 'Rajang Halus',
                'image' => 'images/products/besuki-na-oogst.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Tembakau Samporis Pilihan',
                'slug' => 'tembakau-samporis-pilihan',
                'variety' => 'Samporis',
                'grade' => 'Super Gudang',
                'category' => 'rajang',
                'origin' => 'Sentra Tapal Kuda, Situbondo',
                'description' => 'Rajangan seragam dengan warna cokelat keemasan, rasa gurih legit, dan asap tebal tanpa rasa pahit.',
                'price_per_kg' => 85000,
                'stock_kg' => 380,
                'moisture_content' => 'Rajang Halus',
                'image' => 'images/products/temanggung-dark.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Tembakau Marakot Gudang',
                'slug' => 'tembakau-marakot-gudang',
                'variety' => 'Marakot',
                'grade' => 'Gudangan',
                'category' => 'rajang',
                'origin' => 'Kalisari, Situbondo',
                'description' => 'Hasil sortiran daun pilihan gudang dengan karakter hisapan mantap dan aroma khas tembakau Jawa Timur.',
                'price_per_kg' => 75000,
                'stock_kg' => 520,
                'moisture_content' => 'Rajang Kasar',
                'image' => 'images/products/kasturi-madura.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Tembakau Baleno Standar',
                'slug' => 'tembakau-baleno-standar',
                'variety' => 'Baleno',
                'grade' => 'CW',
                'category' => 'rajang',
                'origin' => 'Besuki, Situbondo',
                'description' => 'Campuran daun bagian tengah dan bawah dengan getah gurih stabil dan harga terjangkau untuk kebutuhan harian maupun partai.',
                'price_per_kg' => 58000,
                'stock_kg' => 600,
                'moisture_content' => 'Rajang Kasar',
                'image' => 'images/products/virginia-flue-cured.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }

        if ($this->command) {
            $this->command->info('4 produk tembakau berhasil di-seed!');
        }
    }
}
