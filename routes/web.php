<?php

use App\Http\Controllers\LaporanController;
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

Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('menu', [LaporanController::class, 'get_menu'])->name('laporan.menu');
Route::get('transaksi/{tahun}', [LaporanController::class, 'get_trans'])->name('laporan.transaksi');

