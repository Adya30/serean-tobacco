<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
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

        $petani = User::updateOrCreate(
            ['email' => 'petani@sereantobacco.com'],
            [
                'name' => 'Pak Slamet',
                'password' => Hash::make('password'),
                'role' => 'petani',
                'phone' => '0812-3456-7890',
                'address' => 'Desa Kalisari, Kec. Banyuglugur, Situbondo',
                'farm_location' => 'Ladang Kalisari Blok A (Kapasitas 5 Ton)',
                'status' => 'active',
            ]
        );

        $customer = User::updateOrCreate(
            ['email' => 'customer@sereantobacco.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => '0821-4321-8765',
                'address' => 'Jl. Pemuda No. 45',
                'kabupaten' => 'Surabaya',
                'kecamatan' => 'Genteng',
                'desa' => 'Embong Kaliasin',
                'status' => 'active',
            ]
        );

        $this->call(ProductSeeder::class);

        if ($this->command) {
            $this->command->info('Database berhasil di-seed! 1 akun admin, 1 akun petani, 1 akun customer, dan 4 produk siap digunakan.');
        }
    }
}
