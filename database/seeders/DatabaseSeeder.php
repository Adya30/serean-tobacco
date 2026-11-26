<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin (Diinput langsung dari Seeder)
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Serean',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0878-5532-0286',
                'address' => 'Sentra Gudang Sortir Banyuglugur, Situbondo',
                'status' => 'active',
            ]
        );

        // 2. Akun Petani Mitra 1
        $petani1 = User::updateOrCreate(
            ['email' => 'petani@sereantobacco.com'],
            [
                'name' => 'Pak Slamet (Petani Mitra)',
                'password' => Hash::make('password'),
                'role' => 'petani',
                'phone' => '0812-3456-7890',
                'address' => 'Desa Kalisari, Kec. Banyuglugur, Situbondo',
                'farm_location' => 'Ladang Kalisari Blok A (Kapasitas 5 Ton)',
                'status' => 'active',
            ]
        );

        // 3. Akun Petani Mitra 2
        User::updateOrCreate(
            ['email' => 'pak.hadi@sereantobacco.com'],
            [
                'name' => 'H. Hadi Wibowo',
                'password' => Hash::make('password'),
                'role' => 'petani',
                'phone' => '0813-9876-5432',
                'address' => 'Lereng Sumbing, Temanggung',
                'farm_location' => 'Kebun Tembakau Kemloko (Kapasitas 8 Ton)',
                'status' => 'active',
            ]
        );

        // 4. Akun Customer Awal
        $customer = User::updateOrCreate(
            ['email' => 'customer@sereantobacco.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => '0821-4321-8765',
                'address' => 'Jl. Pemuda No. 45, Surabaya, Jawa Timur',
                'status' => 'active',
            ]
        );

        // 5. Produk Tembakau di Database (Model Product dengan UUID)
        $productsData = [
            [
                'name' => 'Virginia Flue-Cured Super',
                'slug' => 'virginia-flue-cured',
                'variety' => 'Virginia Oven-Dry Pilihan',
                'category' => 'temanggung',
                'origin' => 'Temanggung & Lereng Sumbing',
                'description' => 'Tembakau Virginia dengan sistem pengeringan flue-cured modern. Warna kuning keemasan merata, aroma manis lembut alami, dan kadar gula daun terjaga sempurna.',
                'price_per_kg' => 95000,
                'stock_kg' => 350,
                'moisture_content' => '12–14%',
                'image' => 'images/products/virginia-flue-cured.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Temanggung Dark Kemloko (Grade A)',
                'slug' => 'temanggung-dark-kemloko',
                'variety' => 'Kemloko Asli Gunung Sumbing',
                'category' => 'temanggung',
                'origin' => 'Kemloko, Temanggung',
                'description' => 'Varietas legendaris lereng Gunung Sumbing. Memiliki warna cokelat gelap berkilau getah, aroma nikotin gurih tebal, dan menjadi bahan baku racikan rokok linting premium.',
                'price_per_kg' => 125000,
                'stock_kg' => 200,
                'moisture_content' => '12–13%',
                'image' => 'images/products/temanggung-dark.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Besuki Na-Oogst Export Quality',
                'slug' => 'besuki-na-oogst',
                'variety' => 'Besuki NO Pilihan Daun Lebar',
                'category' => 'jatim',
                'origin' => 'Besuki & Situbondo, Jatim',
                'description' => 'Tembakau kebanggaan Jawa Timur berstandar ekspor cerutu dunia. Elastisitas daun luar biasa, pembakaran sempurna, dan rasa halus seimbang.',
                'price_per_kg' => 110000,
                'stock_kg' => 450,
                'moisture_content' => '13–14%',
                'image' => 'images/products/besuki-na-oogst.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Kasturi Madura Wangi Alami',
                'slug' => 'kasturi-madura',
                'variety' => 'Kasturi Sun-Cured',
                'category' => 'jatim',
                'origin' => 'Madura & Pantai Situbondo',
                'description' => 'Tembakau aromatik dengan wangi getah khas pesisir garam. Rajangan lembut dan seragam, sangat cocok sebagai aroma booster alami racikan tembakau Nusantara.',
                'price_per_kg' => 85000,
                'stock_kg' => 500,
                'moisture_content' => '12–14%',
                'image' => 'images/products/kasturi-madura.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Srintil Sumbing Mahakarya',
                'slug' => 'srintil-sumbing',
                'variety' => 'Srintil Hitam Fermentasi Alami',
                'category' => 'eksklusif',
                'origin' => 'Puncak Sumbing, Temanggung',
                'description' => 'Tembakau termahal dan terlangka di Nusantara dengan getah pekat alami. Dipanen dari daun teratas pada kondisi iklim khusus dengan proses fermentasi alamiah bermutu tinggi.',
                'price_per_kg' => 275000,
                'stock_kg' => 80,
                'moisture_content' => '11–13%',
                'image' => 'images/products/srintil-super.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Tembakau Rajangan Gurih Banyuglugur',
                'slug' => 'tembakau-banyuglugur',
                'variety' => 'Rajangan Halus Situbondo',
                'category' => 'jatim',
                'origin' => 'Kalisari, Situbondo',
                'description' => 'Tembakau rajangan asli Desa Kalisari, Kec. Banyuglugur. Dikeringkan di bawah sinar matahari pantai utara yang menghasilkan rasa gurih mantap dan getah melimpah.',
                'price_per_kg' => 90000,
                'stock_kg' => 600,
                'moisture_content' => '12–14%',
                'image' => 'images/hero/daun-tembakau.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        $createdProducts = [];
        foreach ($productsData as $data) {
            $createdProducts[] = Product::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // 6. Data Keranjang Pelanggan di Database (Model CartItem dengan UUID)
        CartItem::where('user_id', $customer->id)->delete();

        if (count($createdProducts) >= 3) {
            CartItem::create([
                'user_id' => $customer->id,
                'product_id' => $createdProducts[0]->id,
                'quantity_kg' => 5,
            ]);

            CartItem::create([
                'user_id' => $customer->id,
                'product_id' => $createdProducts[1]->id,
                'quantity_kg' => 2,
            ]);

            CartItem::create([
                'user_id' => $customer->id,
                'product_id' => $createdProducts[2]->id,
                'quantity_kg' => 3,
            ]);
        }
    }
}
