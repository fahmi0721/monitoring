<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\LabaRugiController;
use  App\Http\Controllers\Api\PendapatanController;
use  App\Http\Controllers\Api\BebanController;
use  App\Http\Controllers\Api\GrafikController;
use  App\Http\Controllers\Api\GrafikPblController;
use  App\Http\Controllers\Api\ArusKasController;
use  App\Http\Controllers\Api\PiutangController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resources([
    'labarugi' => LabaRugiController::class,
    'pendapatan'=> PendapatanController::class,
    'beban'=> BebanController::class,
]);

Route::get("/grafik",[GrafikController::class, "index"]);
Route::post("/grafikpbl",[GrafikPblController::class, "index"]);
Route::get("/aruskas",[ArusKasController::class, "index"]);
Route::get("/piutang",[PiutangController::class, "index"]);
Route::post("/grafikaruskas",[ArusKasController::class, "get_grafik"]);
