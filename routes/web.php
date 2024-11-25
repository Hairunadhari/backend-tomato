<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori/submit', [KategoriController::class, 'submit']);
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'delete']);

Route::get('/produk', [ProdukController::class, 'index']);
Route::post('/produk/submit', [ProdukController::class, 'submit']);
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
Route::put('/produk/update/{id}', [ProdukController::class, 'update']);
Route::delete('/produk/delete/{id}', [ProdukController::class, 'delete']);
