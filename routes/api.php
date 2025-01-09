<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
// use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\Api\ApiProdukController;
use App\Http\Controllers\Api\ApiKategoriController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/province',[RajaOngkirController::class, 'getProvince']);
// Route::get('/cityByProvince/{id}',[RajaOngkirController::class, 'getCity']);
// Route::post('/cost',[RajaOngkirController::class, 'cost']);

Route::get('/kategori',[ApiKategoriController::class, 'index']);
Route::get('/kategori/{id}/produk',[ApiKategoriController::class, 'getProdukByKategori']);

Route::get('/produk',[ApiProdukController::class, 'index']);
Route::get('/produk/{id}',[ApiProdukController::class, 'detail']);

Route::get('/tes', function () {
    return response()->json(['status' => 'success']);
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/cekAuth',[AuthController::class, 'cekAuth']);
    Route::get('/order', [OrderController::class, 'orderByUser']);
    Route::post('/order/create', [OrderController::class, 'submitOrder']);
    Route::post('/logout',[AuthController::class, 'logout']);
});