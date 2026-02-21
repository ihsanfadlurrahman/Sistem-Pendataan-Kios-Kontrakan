<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('login');
Route::post('/', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Route::middleware(['guest'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// });

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Unit
Route::resource('units', UnitController::class)->middleware('auth');;

// Penyewa
Route::resource('penyewa', PenyewaController::class)->middleware('auth');;

// Sewa
Route::resource('sewa', SewaController::class)->middleware('auth');

Route::patch('sewa/{sewa}/bayar', [SewaController::class, 'bayar'])
    ->middleware('auth')
    ->name('sewa.bayar');
Route::patch('/sewa/{sewa}/refund', [SewaController::class, 'refund'])->name('sewa.refund');
Route::patch('sewa/{sewa}/perpanjang', [SewaController::class, 'perpanjang'])->name('sewa.perpanjang');
Route::patch('sewa/{sewa}/selesai', [SewaController::class, 'selesai'])
    ->middleware('auth')
    ->name('sewa.selesai');


// Pembayaran
Route::resource('pembayaran', PembayaranController::class)->middleware('auth');;

// Pengeluaran
Route::resource('pengeluaran', PengeluaranController::class)->middleware('auth');

// Laporan
Route::get('laporan', [LaporanController::class, 'index'])
    ->middleware('auth')
    ->name('laporan.index');
Route::get('laporan/pdf', [LaporanController::class, 'exportPdf'])
    ->middleware('auth')
    ->name('laporan.pdf');
