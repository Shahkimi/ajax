<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\BangsaController;
use App\Http\Controllers\GelaranController;
use App\Http\Controllers\GkategoriController;
use App\Http\Controllers\GcutiController;
use App\Http\Controllers\GkcutiController;
use App\Http\Controllers\KumpulanKategoriControllers;
use App\Http\Controllers\ProductController;
use App\Models\KumpulanKategori;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Product Controller
Route::get('products', [ProductController::class, 'index'])->middleware('auth');
Route::post('store-product', [ProductController::class, 'store'])->middleware('auth');
Route::post('edit-product', [ProductController::class, 'edit'])->middleware('auth');
Route::post('delete-product', [ProductController::class, 'destroy'])->middleware('auth');

// Agama Controller
Route::get('agama', [AgamaController::class, 'index'])->middleware('auth');
Route::post('store-agama', [AgamaController::class, 'store'])->middleware('auth');
Route::post('edit-agama', [AgamaController::class, 'edit'])->middleware('auth');
Route::post('delete-agama', [AgamaController::class, 'destroy'])->middleware('auth');
Route::post('view-agama', [AgamaController::class, 'view'])->middleware('auth');

// Bangsa Controller
Route::get('bangsa', [BangsaController::class, 'index'])->middleware('auth');
Route::post('store-bangsa', [BangsaController::class, 'store'])->middleware('auth');
Route::post('edit-bangsa', [BangsaController::class, 'edit'])->middleware('auth');
Route::post('delete-bangsa', [BangsaController::class, 'destroy'])->middleware('auth');
Route::post('view-bangsa', [BangsaController::class, 'view'])->middleware('auth');

// Gelaran Controller
Route::get('gelaran', [GelaranController::class, 'index'])->middleware('auth');
Route::post('store-gelaran', [GelaranController::class, 'store'])->middleware('auth');
Route::post('edit-gelaran', [GelaranController::class, 'edit'])->middleware('auth');
Route::post('delete-gelaran', [GelaranController::class, 'destroy'])->middleware('auth');
Route::post('view-gelaran', [GelaranController::class, 'view'])->middleware('auth');

// Kumpulan Kategori Controller
Route::get('gkategori', [GkategoriController::class, 'index'])->middleware('auth');
Route::post('store-gkategori', [GkategoriController::class, 'store'])->middleware('auth');
Route::post('edit-gkategori', [GkategoriController::class, 'edit'])->middleware('auth');
Route::post('delete-gkategori', [GkategoriController::class, 'destroy'])->middleware('auth');
Route::post('view-gkategori', [GkategoriController::class, 'view'])->middleware('auth');

// Kumpulan Cuti Controller
Route::get('gcuti', [GcutiController::class, 'index'])->middleware('auth');
Route::post('store-gcuti', [GcutiController::class, 'store'])->middleware('auth');
Route::post('edit-gcuti', [GcutiController::class, 'edit'])->middleware('auth');
Route::post('delete-gcuti', [GcutiController::class, 'destroy'])->middleware('auth');
Route::post('view-gcuti', [GcutiController::class, 'view'])->middleware('auth');

Route::get('gkcuti', [GkcutiController::class, 'index'])->middleware('auth');
Route::post('store-gkcuti', [GkcutiController::class, 'store'])->middleware('auth');
Route::post('edit-gkcuti', [GkcutiController::class, 'edit'])->middleware('auth');
Route::post('delete-gkcuti', [GkcutiController::class, 'destroy'])->middleware('auth');
Route::post('view-gkcuti', [GkcutiController::class, 'view'])->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
