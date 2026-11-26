<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Halaman Publik
Route::get('/', function () {
    $products = Product::where('is_active', true)->take(6)->get();

    return view('landing', compact('products'));
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/produk', function () {
    $products = Product::where('is_active', true)->get();

    return view('produk', compact('products'));
})->name('produk');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('keranjang.add')->middleware('throttle:30,1');
Route::put('/keranjang/{cartItem}', [CartController::class, 'update'])->name('keranjang.update');
Route::delete('/keranjang/{cartItem}', [CartController::class, 'remove'])->name('keranjang.remove');

// Autentikasi Tamu (Dilindungi Rate Limiting Anti-Bruteforce)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');

    Route::get('/lupa-sandi', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/lupa-sandi', function (Request $request) {
        $request->validate(['email' => ['required', 'email']]);

        return back()->with('status', 'Tautan pemulihan kata sandi telah dikirim ke alamat email Anda.');
    })->middleware('throttle:5,1');
});

// Logout (Hanya User Login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Terproteksi Login
Route::middleware('auth')->group(function () {
    // Profil Pengguna (Semua Akun)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Dashboard Manajemen Sentra (Hanya Admin & Petani)
    Route::middleware('role:admin,petani')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Manajemen Petani (Hanya Admin)
    Route::middleware('role:admin')->group(function () {
        Route::post('/dashboard/petani', [DashboardController::class, 'storePetani'])->name('dashboard.petani.store');
        Route::delete('/dashboard/petani/{petani}', [DashboardController::class, 'deletePetani'])->name('dashboard.petani.delete');
    });
});
