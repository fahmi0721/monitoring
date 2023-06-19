<?php

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
    return view('pages.home.detail');
});

Route::get("grafik-pbl/{tahun}",function () {
    return view('pages.grafikpbl.detail');
});

Route::get("grafik-arus-kas/{tahun}",function () {
    return view('pages.grafikaruskas.detail');
});

