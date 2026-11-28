<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/produk/{product:slug}', function (Product $product) {
    abort_unless($product->is_active, 404);

    return view('detail_produk', compact('product'));
})->name('produk.show');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('keranjang.add')->middleware('throttle:30,1');
Route::put('/keranjang/{cartItem}', [CartController::class, 'update'])->name('keranjang.update');
Route::delete('/keranjang/{cartItem}', [CartController::class, 'remove'])->name('keranjang.remove');

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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::middleware('role:admin,petani')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/panen', [DashboardController::class, 'panenIndex'])->name('dashboard.panen');
        Route::post('/dashboard/panen', [DashboardController::class, 'storePanen'])->name('dashboard.panen.store');
        Route::get('/dashboard/rekomendasi-tanam', [DashboardController::class, 'rekomendasiTanamIndex'])->name('dashboard.rekomendasi-tanam');
        Route::get('/dashboard/jadwal-tanam', [DashboardController::class, 'jadwalIndex'])->name('dashboard.jadwal');
        Route::post('/dashboard/jadwal-tanam', [DashboardController::class, 'storeJadwal'])->name('dashboard.jadwal.store');
        Route::put('/dashboard/jadwal-tanam/{jadwal}', [DashboardController::class, 'updateJadwal'])->name('dashboard.jadwal.update');
    });

    Route::middleware('role:admin')->group(function () {
        Route::delete('/dashboard/jadwal-tanam/{jadwal}', [DashboardController::class, 'deleteJadwal'])->name('dashboard.jadwal.delete');

        Route::get('/dashboard/petani', [DashboardController::class, 'petaniIndex'])->name('dashboard.petani');
        Route::post('/dashboard/petani', [DashboardController::class, 'storePetani'])->name('dashboard.petani.store');
        Route::put('/dashboard/petani/{petani}', [DashboardController::class, 'updatePetani'])->name('dashboard.petani.update');
        Route::delete('/dashboard/petani/{petani}', [DashboardController::class, 'deletePetani'])->name('dashboard.petani.delete');

        Route::get('/dashboard/stok', [DashboardController::class, 'stokIndex'])->name('dashboard.stok');
        Route::post('/dashboard/stok', [DashboardController::class, 'storeStok'])->name('dashboard.stok.store');
        Route::put('/dashboard/stok/{product}', [DashboardController::class, 'updateStok'])->name('dashboard.stok.update');
        Route::delete('/dashboard/stok/{product}', [DashboardController::class, 'deleteStok'])->name('dashboard.stok.delete');

        Route::get('/dashboard/katalog', [DashboardController::class, 'katalogIndex'])->name('dashboard.katalog');
        Route::post('/dashboard/katalog', [DashboardController::class, 'storeKatalog'])->name('dashboard.katalog.store');
        Route::put('/dashboard/katalog/{product}', [DashboardController::class, 'updateKatalog'])->name('dashboard.katalog.update');

        Route::get('/dashboard/transaksi', [DashboardController::class, 'transaksiIndex'])->name('dashboard.transaksi');
        Route::put('/dashboard/transaksi/{transaction}', [DashboardController::class, 'updateTransaksi'])->name('dashboard.transaksi.update');
        Route::post('/dashboard/transaksi/bank', [DashboardController::class, 'storeBank'])->name('dashboard.transaksi.bank.store');
        Route::put('/dashboard/transaksi/bank/{bankAccount}', [DashboardController::class, 'updateBank'])->name('dashboard.transaksi.bank.update');
        Route::delete('/dashboard/transaksi/bank/{bankAccount}', [DashboardController::class, 'deleteBank'])->name('dashboard.transaksi.bank.delete');
    });

    Route::middleware('role:customer')->group(function () {
        Route::redirect('/customer/dashboard', '/')->name('customer.dashboard');
        Route::get('/customer/transaksi', [CustomerTransactionController::class, 'index'])->name('customer.transaksi');
        Route::post('/customer/transaksi', [CustomerTransactionController::class, 'store'])->name('customer.transaksi.store');
        Route::get('/customer/transaksi/{transaction}', [CustomerTransactionController::class, 'show'])->name('customer.transaksi.show');
        Route::put('/customer/transaksi/{transaction}', [CustomerTransactionController::class, 'update'])->name('customer.transaksi.update');
        Route::put('/customer/transaksi/{transaction}/batal', [CustomerTransactionController::class, 'cancel'])->name('customer.transaksi.cancel');
    });
});
