<?php

use App\Models\CartItem;
use App\Models\Harvest;
use App\Models\PlantingSchedule;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('the home page returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('the tentang page returns a successful response', function () {
    $response = $this->get('/tentang');

    $response->assertStatus(200);
});

test('the produk page returns a successful response', function () {
    $response = $this->get('/produk');

    $response->assertStatus(200);
});

test('the kontak page returns a successful response', function () {
    $response = $this->get('/kontak');

    $response->assertStatus(200);
});

test('the login page returns a successful response with split-screen layout', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Masuk ke Akun Anda');
    $response->assertSee('Apakah anda belum punya akun?');
    $response->assertSee('Daftar sekarang');
});

test('the register page returns a successful response with split-screen layout', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
    $response->assertSee('Daftar Akun Baru');
    $response->assertSee('Sudah punya akun?');
    $response->assertSee('Masuk sekarang');
});

test('the forgot password page returns a successful response with split-screen layout', function () {
    $response = $this->get('/lupa-sandi');

    $response->assertStatus(200);
    $response->assertSee('Lupa Kata Sandi');
    $response->assertSee('Kirim Tautan Pemulihan');
});

test('security headers are present in web responses', function () {
    $response = $this->get('/');

    $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    $response->assertHeader('X-Content-Type-Options', 'nosniff');
    $response->assertHeader('X-XSS-Protection', '1; mode=block');
    $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
});

test('customer cannot access dashboard management and redirects to home', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
        'status' => 'active',
    ]);

    $response = $this->actingAs($customer)->get('/dashboard');
    $response->assertRedirect(route('home'));
});

test('customer dashboard url redirects to home landing page', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
        'status' => 'active',
    ]);

    $response = $this->actingAs($customer)->get('/customer/dashboard');
    $response->assertRedirect('/');
});

test('admin can access dashboard management', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'status' => 'active',
    ]);

    $response = $this->actingAs($admin)->get('/dashboard');
    $response->assertStatus(200);
});

test('petani can access dashboard panel', function () {
    $petani = User::factory()->create([
        'role' => 'petani',
        'status' => 'active',
    ]);

    $response = $this->actingAs($petani)->get('/dashboard');
    $response->assertStatus(200);
    $response->assertSee('Sentra Petani');
});

test('petani can view and update account profile', function () {
    $petani = User::factory()->create([
        'role' => 'petani',
        'name' => 'Petani Asli',
        'email' => 'petani.asli@sereantobacco.com',
        'status' => 'active',
    ]);

    $response = $this->actingAs($petani)->get('/profile');
    $response->assertStatus(200);
    $response->assertSee('Petani Asli');

    $updateResponse = $this->actingAs($petani)->put('/profile', [
        'name' => 'Petani Diperbarui',
        'email' => 'petani.asli@sereantobacco.com',
        'phone' => '081234567890',
        'farm_location' => 'Ladang Krajan, Situbondo',
        'address' => 'Desa Besuki RT 01 RW 02',
    ]);

    $updateResponse->assertRedirect();
    expect($petani->fresh()->name)->toBe('Petani Diperbarui');
    expect($petani->fresh()->farm_location)->toBe('Ladang Krajan, Situbondo');
});

test('petani can create and view harvest data', function () {
    $petani = User::factory()->create([
        'role' => 'petani',
        'name' => 'Pak Tani Tembakau',
        'status' => 'active',
    ]);

    $createResponse = $this->actingAs($petani)->post('/dashboard/panen', [
        'variety' => 'Tembakau Opot (Besuki Na-Oogst)',
        'grade' => 'Super',
        'harvest_weight_kg' => 600,
        'moisture_content' => 'Rajang Halus',
        'harvest_date' => now()->toDateString(),
        'farm_location' => 'Kebun Krajan',
        'quality_notes' => 'Aroma harum getah pekat',
    ]);

    $createResponse->assertRedirect();
    $createResponse->assertSessionHas('status');

    expect(Harvest::where('farmer_id', $petani->id)->count())->toBe(1);

    $viewResponse = $this->actingAs($petani)->get('/dashboard/panen');
    $viewResponse->assertStatus(200);
    $viewResponse->assertSee('Tembakau Opot (Besuki Na-Oogst)');
    $viewResponse->assertSee('600 Kg');
});

test('petani can view planting recommendation page', function () {
    $petani = User::factory()->create([
        'role' => 'petani',
        'status' => 'active',
    ]);

    $response = $this->actingAs($petani)->get('/dashboard/rekomendasi-tanam');
    $response->assertStatus(200);
    $response->assertSee('Kalender Musim Tanam Tembakau Jawa Timur');
    $response->assertSee('Persemaian Bibit');
    $response->assertSee('Tembakau Opot (Besuki Na-Oogst)');
});

test('petani can create, view, and update planting schedule', function () {
    $petani = User::factory()->create([
        'role' => 'petani',
        'name' => 'Petani Jadwal',
        'status' => 'active',
    ]);

    $createResponse = $this->actingAs($petani)->post('/dashboard/jadwal-tanam', [
        'variety' => 'Tembakau Samporis',
        'land_area_ha' => 0.75,
        'location' => 'Blok Selatan, Situbondo',
        'planting_date' => now()->toDateString(),
        'estimated_harvest_date' => now()->addDays(70)->toDateString(),
        'target_yield_kg' => 750,
        'phase' => 'persemaian',
        'notes' => 'Bibit disemai di naungan 50%',
    ]);

    $createResponse->assertRedirect();
    $createResponse->assertSessionHas('status');

    $jadwal = PlantingSchedule::where('user_id', $petani->id)->first();
    expect($jadwal)->not->toBeNull();
    expect($jadwal->variety)->toBe('Tembakau Samporis');

    $viewResponse = $this->actingAs($petani)->get('/dashboard/jadwal-tanam');
    $viewResponse->assertStatus(200);
    $viewResponse->assertSee('Tembakau Samporis');
    $viewResponse->assertSee('0.75 Hektar');

    $updateResponse = $this->actingAs($petani)->put('/dashboard/jadwal-tanam/'.$jadwal->id, [
        'variety' => 'Tembakau Samporis',
        'land_area_ha' => 0.75,
        'location' => 'Blok Selatan, Situbondo',
        'planting_date' => now()->toDateString(),
        'estimated_harvest_date' => now()->addDays(70)->toDateString(),
        'target_yield_kg' => 800,
        'phase' => 'penanaman',
        'notes' => 'Pindah tanam selesai dilakukan',
    ]);

    $updateResponse->assertRedirect();
    expect($jadwal->fresh()->phase)->toBe('penanaman');
    expect($jadwal->fresh()->target_yield_kg)->toBe(800);
});

test('unauthorized user cannot update another user cart item (idor prevention)', function () {
    $user1 = User::factory()->create(['role' => 'customer']);
    $user2 = User::factory()->create(['role' => 'customer']);

    $product = Product::create([
        'name' => 'Tembakau Test',
        'slug' => 'tembakau-test',
        'variety' => 'Virginia',
        'category' => 'Temanggung',
        'origin' => 'Temanggung',
        'price_per_kg' => 150000,
        'stock_kg' => 100,
        'is_active' => true,
    ]);

    $cartItem = CartItem::create([
        'user_id' => $user1->id,
        'product_id' => $product->id,
        'quantity_kg' => 2,
    ]);

    $response = $this->actingAs($user2)->put('/keranjang/'.$cartItem->id, [
        'quantity_kg' => 99,
    ]);

    $response->assertStatus(403);
    expect($cartItem->fresh()->quantity_kg)->toBe(2);
});

test('guest is redirected to login when attempting to add product to cart', function () {
    $product = Product::create([
        'name' => 'Tembakau Tamu Test',
        'slug' => 'tembakau-tamu-test',
        'variety' => 'Baleno',
        'category' => 'Situbondo',
        'origin' => 'Situbondo',
        'price_per_kg' => 60000,
        'stock_kg' => 50,
        'is_active' => true,
    ]);

    $response = $this->post('/keranjang/tambah', [
        'product_id' => $product->id,
        'quantity_kg' => 1,
    ]);

    $response->assertRedirect('/login');
    $response->assertSessionHas('error');
});

test('authenticated customer can add product to cart', function () {
    $customer = User::factory()->create(['role' => 'customer']);
    $product = Product::create([
        'name' => 'Tembakau Pelanggan Test',
        'slug' => 'tembakau-pelanggan-test',
        'variety' => 'Opot',
        'category' => 'Besuki',
        'origin' => 'Situbondo',
        'price_per_kg' => 75000,
        'stock_kg' => 50,
        'is_active' => true,
    ]);

    $response = $this->actingAs($customer)->post('/keranjang/tambah', [
        'product_id' => $product->id,
        'quantity_kg' => 2,
    ]);

    $response->assertRedirect('/keranjang');
    expect(CartItem::where('user_id', $customer->id)->where('product_id', $product->id)->first()->quantity_kg)->toBe(2);
});

test('guest can see active catalog products on produk page', function () {
    $product = Product::create([
        'name' => 'Tembakau Katalog Publik',
        'slug' => 'tembakau-katalog-publik',
        'variety' => 'Samporis',
        'category' => 'Bondowoso',
        'origin' => 'Bondowoso',
        'price_per_kg' => 80000,
        'stock_kg' => 40,
        'is_active' => true,
    ]);

    $response = $this->get('/produk');
    $response->assertStatus(200);
    $response->assertSee('Tembakau Katalog Publik');
});

test('customer admin and petani can upload profile photo', function () {
    Storage::fake('public');

    foreach (['customer', 'admin', 'petani'] as $role) {
        $user = User::factory()->create([
            'role' => $role,
            'status' => 'active',
        ]);

        $file = UploadedFile::fake()->image("avatar-{$role}.jpg");

        $response = $this->actingAs($user)->put('/profile', [
            'name' => $user->name,
            'email' => $user->email,
            'profile_photo' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $user->refresh();
        expect($user->profile_photo)->not->toBeNull();
        Storage::disk('public')->assertExists($user->profile_photo);
    }
});

test('admin sees incoming harvest and transaction notifications in dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => 'active']);
    $petani = User::factory()->create(['role' => 'petani', 'status' => 'active', 'name' => 'Pak Tani Notif']);
    $customer = User::factory()->create(['role' => 'customer', 'status' => 'active']);

    Harvest::create([
        'farmer_id' => $petani->id,
        'farmer_name' => $petani->name,
        'variety' => 'Tembakau Opot',
        'grade' => 'Super',
        'harvest_weight_kg' => 250,
        'moisture_content' => 'Rajang Halus',
        'harvest_date' => now()->toDateString(),
        'farm_location' => 'Situbondo',
        'status' => 'diterima_gudang',
    ]);

    Transaction::create([
        'invoice_code' => 'INV-NOTIF-001',
        'user_id' => $customer->id,
        'customer_name' => 'Pembeli Notif',
        'customer_phone' => '08123456789',
        'kabupaten' => 'Surabaya',
        'kecamatan' => 'Genteng',
        'desa' => 'Embong',
        'customer_address' => 'Jl. Pemuda',
        'total_weight_kg' => 100,
        'items_subtotal' => 5000000,
        'shipping_cost' => 0,
        'total_price' => 5000000,
        'fleet_type' => 'pick_up',
        'fleet_name' => 'Armada Standar Pick Up (< 300 Kg)',
        'shipping_status' => 'menunggu_konfirmasi',
        'payment_status' => 'menunggu_pembayaran',
    ]);

    $response = $this->actingAs($admin)->get('/dashboard');
    $response->assertStatus(200);
    $response->assertSee('Transaksi Masuk: INV-NOTIF-001');
    $response->assertSee('Hasil Panen Masuk: Tembakau Opot');
});
