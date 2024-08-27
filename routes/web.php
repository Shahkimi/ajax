<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AgamaController,
    BangsaController,
    GelaranController,
    GkategoriController,
    GcutiController,
    GkcutiController,
    ProductController,
    HomeController,
    KesalahanController
};

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);

    Route::prefix('agama')->name('agama.')->group(function () {
        Route::get('/', [AgamaController::class, 'index'])->name('index');
        Route::post('store', [AgamaController::class, 'store'])->name('store');
        Route::post('edit', [AgamaController::class, 'edit'])->name('edit');
        Route::post('delete', [AgamaController::class, 'destroy'])->name('destroy');
        Route::post('view', [AgamaController::class, 'view'])->name('view');
    });

    Route::prefix('bangsa')->name('bangsa.')->group(function () {
        Route::get('/', [BangsaController::class, 'index'])->name('index');
        Route::post('store', [BangsaController::class, 'store'])->name('store');
        Route::post('edit', [BangsaController::class, 'edit'])->name('edit');
        Route::post('delete', [BangsaController::class, 'destroy'])->name('destroy');
        Route::post('view', [BangsaController::class, 'view'])->name('view');
    });

    Route::prefix('gelaran')->name('gelaran.')->group(function () {
        Route::get('/', [GelaranController::class, 'index'])->name('index');
        Route::post('store', [GelaranController::class, 'store'])->name('store');
        Route::post('edit', [GelaranController::class, 'edit'])->name('edit');
        Route::post('delete', [GelaranController::class, 'destroy'])->name('destroy');
        Route::post('view', [GelaranController::class, 'view'])->name('view');
    });

    Route::prefix('gkategori')->name('gkategori.')->group(function () {
        Route::get('/', [GkategoriController::class, 'index'])->name('index');
        Route::post('store', [GkategoriController::class, 'store'])->name('store');
        Route::post('edit', [GkategoriController::class, 'edit'])->name('edit');
        Route::post('delete', [GkategoriController::class, 'destroy'])->name('destroy');
        Route::post('view', [GkategoriController::class, 'view'])->name('view');
    });

    Route::prefix('gcuti')->name('gcuti.')->group(function () {
        Route::get('/', [GcutiController::class, 'index'])->name('index');
        Route::post('store', [GcutiController::class, 'store'])->name('store');
        Route::post('edit', [GcutiController::class, 'edit'])->name('edit');
        Route::post('delete', [GcutiController::class, 'destroy'])->name('destroy');
        Route::post('view', [GcutiController::class, 'view'])->name('view');
    });

    Route::resource('gkcuti', GkcutiController::class);

    Route::prefix('kesalahan')->name('kesalahan.')->group(function () {
        Route::get('/', [KesalahanController::class, 'index'])->name('index');
        Route::post('store', [KesalahanController::class, 'store'])->name('store');
        Route::post('edit', [KesalahanController::class, 'edit'])->name('edit');
        Route::post('delete', [KesalahanController::class, 'destroy'])->name('destroy');
        Route::post('view', [KesalahanController::class, 'view'])->name('view');
    });

});
