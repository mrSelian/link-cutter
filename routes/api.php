<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get-qr-for/{id}', [ApiController::class, 'getQrByLinkId'])->name('api_get_qr_for_id');
Route::get('/get-qr', [ApiController::class, 'getQr'])->name('api_get_qr');
Route::get('/get-alias', [ApiController::class, 'getAlias'])->name('api_get_alias');
