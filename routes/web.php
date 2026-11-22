<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/belanja', [PageController::class, 'belanja'])->name('belanja');
Route::get('/pelayanan', [PageController::class, 'pelayanan'])->name('pelayanan');
Route::get('/keranjang', [PageController::class, 'keranjang'])->name('keranjang');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/tentang-kami', [PageController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
