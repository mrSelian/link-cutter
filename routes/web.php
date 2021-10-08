<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\QrController;
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
require __DIR__ . '/auth.php';

Route::group([
    'middleware' => 'set_locale'
], function () {
    Route::get('/rules', [PagesController::class, 'rulesPage'])->name('rules_page');

    Route::get('/about', [PagesController::class, 'aboutServicePage'])->name('about_page');

    Route::get('/thanks', [PagesController::class, 'donatePage'])->name('donate_page');

    Route::get('/my-links', [PagesController::class, 'userLinksPage'])->middleware(['auth'])->name('dashboard');

    Route::get('/qr-generator', [PagesController::class, 'qrGeneratorPage'])->name('qr_generator');

    Route::get('/', [LinkController::class, 'create'])->name('create_link');

    Route::post('/link/create', [LinkController::class, 'store'])->name('store_link');

    Route::post('/qr/generate', [QrController::class, 'generate'])->name('qr_generate');

    Route::get('/locale/{locale}', [PagesController::class, 'changeLocale'])->name('change_locale');

    Route::group([
        'middleware' => 'auth',
        'prefix' => '/link'
    ], function () {
        Route::get('/{id}/edit', [LinkController::class, 'edit'])->middleware(['auth'])->name('edit_link');

        Route::patch('/{id}/update', [LinkController::class, 'update'])->middleware(['auth'])->name('update_link');

        Route::delete('/{id}/delete', [LinkController::class, 'destroy'])->middleware(['auth'])->name('destroy_link');

        Route::get('/{id}/stats', [PagesController::class, 'linkStatsPage'])->middleware(['auth'])->name('link_stats');
    });
});

Route::get('/{alias}', [LinkController::class, 'redirectToLink'])->name('redirect_to_link');
