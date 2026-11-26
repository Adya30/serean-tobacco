<?php

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

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

test('customer cannot access dashboard management', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
        'status' => 'active',
    ]);

    $response = $this->actingAs($customer)->get('/dashboard');
    $response->assertRedirect(route('home'));
});

test('admin can access dashboard management', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'status' => 'active',
    ]);

    $response = $this->actingAs($admin)->get('/dashboard');
    $response->assertStatus(200);
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

    // User 2 attempts to tamper with User 1's cart item
    $response = $this->actingAs($user2)->put('/keranjang/'.$cartItem->id, [
        'quantity_kg' => 99,
    ]);

    $response->assertStatus(403);
    expect($cartItem->fresh()->quantity_kg)->toBe(2);
});
