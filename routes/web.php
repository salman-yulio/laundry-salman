<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
// use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
// use App\Http\Controllers\Transaksi2Controller;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\TBarangController;
// use App\Http\Controllers\AksesorisController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PenjemputanController;
use App\Http\Controllers\PenggunaanController;

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
    return view('dashboard.index');
});

// Route::get('/transaksi2', function () {
//     return view('dashboard.transaksi2.index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route::resource('/dashboard/user', UserController::class)->middleware('auth');
// Route::resource('/dashboard/member', MemberController::class)->middleware('auth');
// Route::resource('/dashboard/outlet', OutletController::class)->middleware('auth');
// Route::resource('/dashboard/paket', PaketController::class)->middleware('auth');

Route::group(['prefix' => 'a', 'middleware' => ['isAdmin', 'auth']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('a.dashboard');
    Route::resource('member', MemberController::class);
    Route::get('export/member', [MemberController::class, 'exportMember'])->name('export-member');
    Route::post('member/import', [MemberController::class, 'import'])->name('import-member');
    Route::resource('paket', PaketController::class);
    Route::get('export/paket', [PaketController::class, 'exportPaket'])->name('export-paket');
    Route::post('paket/import', [PaketController::class, 'import'])->name('import-paket');
    Route::resource('outlet', OutletController::class);
    Route::get('export/outlet', [OutletController::class, 'exportOutlet'])->name('export-outlet');
    Route::post('import/outlet', [OutletController::class, 'import'])->name('import-outlet');
    Route::resource('user', UserController::class);
    Route::get('export/user', [UserController::class, 'exportData'])->name('export-user');
    Route::post('import/user', [UserController::class, 'importData'])->name('import-user');
    Route::resource('transaksi', TransaksiController::class);
    Route::get('transaksi/faktur/{id}', [TransaksiController::class, 'fakturPDF'])->name('faktur');
    Route::get('{id}/faktur', [TransaksiController::class, 'fakturPDF'])->name('faktur');
    Route::resource('inventaris', BarangInventarisController::class);
    // Route::get('laporan', [LaporanController::class, 'index']);
    Route::get('/laporan', [TransaksiController::class, 'laporan']);
    Route::get('/laporan/pdf', [TransaksiController::class, 'laporanPDF'])->name('laporanPDF');
    Route::get('export/laporan', [TransaksiController::class, 'exportData'])->name('export-laporan');
    Route::get('simulasi', [SimulasiController::class, 'index']);
    Route::get('simulasi_gaji', [GajiController::class, 'index']);
    Route::get('simulasi_transaksi', [TBarangController::class, 'index']);
    // Route::get('penjualan_aksesoris', [AksesorisController::class, 'index']);
    Route::resource('penjemputan', PenjemputanController::class);
    Route::post('status', [PenjemputanController::class, 'status'])->name('status');
    Route::get('export/penjemputan', [PenjemputanController::class, 'exportData'])->name('export-penjemputan');
    Route::post('import/penjemputan', [penjemputanController::class, 'importData'])->name('import-penjemputan');
    Route::resource('penggunaan', PenggunaanController::class);
    Route::post('status', [PenggunaanController::class, 'status'])->name('status');
    Route::get('export/penggunaan', [PenggunaanController::class, 'exportData'])->name('export-penggunaan');
    Route::post('import/penggunaan', [PenggunaanController::class, 'importData'])->name('import-penggunaan');
    Route::resource('absensi', AbsensiController::class);
    Route::post('status', [AbsensiController::class, 'status'])->name('status');
    Route::get('export/absensi', [AbsensiController::class, 'exportData'])->name('export-absensi');
    Route::post('import/absensi', [AbsensiController::class, 'importData'])->name('import-absensi');
});

Route::group(['prefix' => 'k', 'middleware' => ['isKasir', 'auth']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('k.dashboard');
    Route::resource('member', MemberController::class);
    // Route::resource('paket', PaketController::class);
    // Route::resource('user', UserController::class);
    Route::get('transaksi', [TransaksiController::class, 'index']);
    // Route::get('laporan', [LaporanController::class, 'index']);
    Route::get('/laporan', [TransaksiController::class, 'laporan']);
});

Route::group(['prefix' => 'o', 'middleware' => ['isOwner', 'auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('o.dashboard');
    // Route::get('laporan', [LaporanController::class, 'index']);
    Route::get('/laporan', [TransaksiController::class, 'laporan']);
});
