<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Public static & catalog pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/belanja', [PageController::class, 'belanja'])->name('belanja');
Route::get('/pelayanan', [PageController::class, 'pelayanan'])->name('pelayanan');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/tentang-kami', [PageController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Cart routes
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
Route::post('/keranjang', [CartController::class, 'add'])->name('cart.add');
Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/keranjang', [CartController::class, 'clear'])->name('cart.clear');
