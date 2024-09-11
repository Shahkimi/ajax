<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('products', Controllers\ProductController::class);

    //Controller Section
    Route::prefix('agama')->name('agama.')->group(function () {
        Route::get('/', [Controllers\AgamaController::class, 'index'])->name('index');
        Route::post('store', [Controllers\AgamaController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\AgamaController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\AgamaController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\AgamaController::class, 'view'])->name('view');
    });

    Route::prefix('bangsa')->name('bangsa.')->group(function () {
        Route::get('/', [Controllers\BangsaController::class, 'index'])->name('index');
        Route::post('store', [Controllers\BangsaController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\BangsaController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\BangsaController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\BangsaController::class, 'view'])->name('view');
    });

    Route::prefix('gelaran')->name('gelaran.')->group(function () {
        Route::get('/', [Controllers\GelaranController::class, 'index'])->name('index');
        Route::post('store', [Controllers\GelaranController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\GelaranController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\GelaranController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\GelaranController::class, 'view'])->name('view');
    });

    Route::prefix('gkategori')->name('gkategori.')->group(function () {
        Route::get('/', [Controllers\GkategoriController::class, 'index'])->name('index');
        Route::post('store', [Controllers\GkategoriController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\GkategoriController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\GkategoriController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\GkategoriController::class, 'view'])->name('view');
    });

    Route::prefix('gcuti')->name('gcuti.')->group(function () {
        Route::get('/', [Controllers\GcutiController::class, 'index'])->name('index');
        Route::post('store', [Controllers\GcutiController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\GcutiController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\GcutiController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\GcutiController::class, 'view'])->name('view');
    });

    Route::resource('gkcuti', Controllers\GkcutiController::class);

    Route::prefix('kesalahan')->name('kesalahan.')->group(function () {
        Route::get('/', [Controllers\KesalahanController::class, 'index'])->name('index');
        Route::post('store', [Controllers\KesalahanController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\KesalahanController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\KesalahanController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\KesalahanController::class, 'view'])->name('view');
    });

    Route::prefix('akta')->name('akta.')->group(function () {
        Route::get('/', [Controllers\AktaController::class, 'index'])->name('index');
        Route::post('store', [Controllers\AktaController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\AktaController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\AktaController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\AktaController::class, 'view'])->name('view');
    });

    Route::prefix('status')->name('status.')->group(function () {
        Route::get('/', [Controllers\StatusController::class, 'index'])->name('index');
        Route::post('store', [Controllers\StatusController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\StatusController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\StatusController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\StatusController::class, 'view'])->name('view');
    });

    Route::prefix('hukuman')->name('hukuman.')->group(function () {
        Route::get('/', [Controllers\HukumanController::class, 'index'])->name('index');
        Route::post('store', [Controllers\HukumanController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\HukumanController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\HukumanController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\HukumanController::class, 'view'])->name('view');
    });

    Route::prefix('panel')->name('panel.')->group(function () {
        Route::get('/', [Controllers\PanelController::class, 'index'])->name('index');
        Route::post('store', [Controllers\PanelController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\PanelController::class, 'edit'])->name('edit');
        Route::post('view', [Controllers\PanelController::class, 'view'])->name('view');
    });

    Route::prefix('gred')->name('gred.')->group(function () {
        Route::get('/', [Controllers\GredController::class, 'index'])->name('index');
        Route::post('search', [Controllers\GredController::class, 'search'])->name('search');
        Route::post('store', [Controllers\GredController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\GredController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\GredController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('jawatan')->name('jawatan.')->group(function () {
        Route::get('/', [Controllers\JawatanController::class, 'index'])->name('index');
        Route::post('search', [Controllers\JawatanController::class, 'search'])->name('search');
        Route::post('store', [Controllers\JawatanController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\JawatanController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\JawatanController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('ptj')->name('ptj.')->group(function () {
        Route::get('/', [Controllers\PtjController::class, 'index'])->name('index');
        Route::post('search', [Controllers\PtjController::class, 'search'])->name('search');
        Route::post('store', [Controllers\PtjController::class, 'store'])->name('store');
        Route::post('edit', [Controllers\PtjController::class, 'edit'])->name('edit');
        Route::post('delete', [Controllers\PtjController::class, 'destroy'])->name('destroy');
        Route::post('view', [Controllers\PtjController::class, 'view'])->name('view');
    });
});
