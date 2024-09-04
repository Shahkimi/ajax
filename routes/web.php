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
    KesalahanController,
    AktaController,
    StatusController,
    HukumanController,
    PanelController,
    GredController,
    JawatanController
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

    //Kawalan Section
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

    Route::prefix('akta')->name('akta.')->group(function () {
        Route::get('/', [AktaController::class, 'index'])->name('index');
        Route::post('store', [AktaController::class, 'store'])->name('store');
        Route::post('edit', [AktaController::class, 'edit'])->name('edit');
        Route::post('delete', [AktaController::class, 'destroy'])->name('destroy');
        Route::post('view', [AktaController::class, 'view'])->name('view');
    });

    Route::prefix('status')->name('status.')->group(function () {
        Route::get('/', [StatusController::class, 'index'])->name('index');
        Route::post('store', [StatusController::class, 'store'])->name('store');
        Route::post('edit', [StatusController::class, 'edit'])->name('edit');
        Route::post('delete', [StatusController::class, 'destroy'])->name('destroy');
        Route::post('view', [StatusController::class, 'view'])->name('view');
    });

    Route::prefix('hukuman')->name('hukuman.')->group(function () {
        Route::get('/', [hukumanController::class, 'index'])->name('index');
        Route::post('store', [hukumanController::class, 'store'])->name('store');
        Route::post('edit', [hukumanController::class, 'edit'])->name('edit');
        Route::post('delete', [hukumanController::class, 'destroy'])->name('destroy');
        Route::post('view', [hukumanController::class, 'view'])->name('view');
    });

    Route::prefix('panel')->name('panel.')->group(function () {
        Route::get('/', [PanelController::class, 'index'])->name('index');
        Route::post('store', [PanelController::class, 'store'])->name('store');
        Route::post('edit', [PanelController::class, 'edit'])->name('edit');
        Route::post('view', [PanelController::class, 'view'])->name('view');
    });

    Route::prefix('gred')->name('gred.')->group(function () {
        Route::get('/', [GredController::class, 'index'])->name('index');
        Route::post('search', [GredController::class, 'search'])->name('search');
        Route::post('store', [GredController::class, 'store'])->name('store');
        Route::post('edit', [GredController::class, 'edit'])->name('edit');
        Route::post('delete', [GredController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('jawatan')->name('jawatan.')->group(function () {
        Route::get('/', [JawatanController::class, 'index'])->name('index');
        Route::post('search', [JawatanController::class, 'search'])->name('search');
        Route::post('store', [JawatanController::class, 'store'])->name('store');
        Route::post('edit', [JawatanController::class, 'edit'])->name('edit');
        Route::post('delete', [JawatanController::class, 'destroy'])->name('destroy');
    });

});
