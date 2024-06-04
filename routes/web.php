<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\BangsaController;
use App\Http\Controllers\GelaranController;
use App\Http\Controllers\GkategoriController;
use App\Http\Controllers\GcutiController;
use App\Http\Controllers\GkcutiController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);

    // Agama routes
    Route::get('agama', [AgamaController::class, 'index']);
    Route::post('store-agama', [AgamaController::class, 'store']);
    Route::post('edit-agama', [AgamaController::class, 'edit']);
    Route::post('delete-agama', [AgamaController::class, 'destroy']);
    Route::post('view-agama', [AgamaController::class, 'view']);

    // Bangsa routes
    Route::get('bangsa', [BangsaController::class, 'index']);
    Route::post('store-bangsa', [BangsaController::class, 'store']);
    Route::post('edit-bangsa', [BangsaController::class, 'edit']);
    Route::post('delete-bangsa', [BangsaController::class, 'destroy']);
    Route::post('view-bangsa', [BangsaController::class, 'view']);

    // Gelaran routes
    Route::get('gelaran', [GelaranController::class, 'index']);
    Route::post('store-gelaran', [GelaranController::class, 'store']);
    Route::post('edit-gelaran', [GelaranController::class, 'edit']);
    Route::post('delete-gelaran', [GelaranController::class, 'destroy']);
    Route::post('view-gelaran', [GelaranController::class, 'view']);

    // Kumpulan Kategori routes
    Route::get('gkategori', [GkategoriController::class, 'index']);
    Route::post('store-gkategori', [GkategoriController::class, 'store']);
    Route::post('edit-gkategori', [GkategoriController::class, 'edit']);
    Route::post('delete-gkategori', [GkategoriController::class, 'destroy']);
    Route::post('view-gkategori', [GkategoriController::class, 'view']);

    // Kumpulan Cuti routes
    Route::get('gcuti', [GcutiController::class, 'index']);
    Route::post('store-gcuti', [GcutiController::class, 'store']);
    Route::post('edit-gcuti', [GcutiController::class, 'edit']);
    Route::post('delete-gcuti', [GcutiController::class, 'destroy']);
    Route::post('view-gcuti', [GcutiController::class, 'view']);

    // Category Kumpulan Cuti routes
    Route::get('/gkcuti', [GkcutiController::class, 'index'])->name('gkcuti.index');
    Route::post('/gkcuti', [GkcutiController::class, 'store'])->name('gkcuti.store');
    Route::get('/gkcuti/{id}/edit', [GkcutiController::class, 'edit'])->name('gkcuti.edit');
    Route::delete('/gkcuti/{id}', [GkcutiController::class, 'destroy'])->name('gkcuti.destroy');
    Route::get('/gkcuti/{id}', [GkcutiController::class, 'view'])->name('gkcuti.view');

    Route::post('view-agama', [AgamaController::class, 'view']);
    Route::post('view-bangsa', [BangsaController::class, 'view']);
    Route::post('view-gelaran', [GelaranController::class, 'view']);
    Route::post('view-gkategori', [GkategoriController::class, 'view']);
    Route::post('view-gcuti', [GcutiController::class, 'view']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
