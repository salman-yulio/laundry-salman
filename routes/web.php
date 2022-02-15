<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;

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

Route::group(['prefix' =>'a','middleware'=>['isAdmin','auth']], function(){
    Route::get('dashboard', [HomeController::class, 'index'])->name('a.dashboard');
    Route::resource('member', MemberController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('outlet', OutletController::class);
    Route::resource('user', UserController::class);
    Route::get('transaksi', [TransaksiController::class, 'index']);
    Route::get('laporan', [LaporanController::class, 'index']);
});

Route::group(['prefix' =>'k','middleware'=>['isKasir','auth']], function(){
    Route::get('dashboard', [HomeController::class, 'index'])->name('k.dashboard');
    Route::resource('member', MemberController::class);
    Route::resource('paket', PaketController::class);
    Route::get('transaksi', [TransaksiController::class, 'index']);
    Route::get('laporan', [LaporanController::class, 'index']);
});

Route::group(['prefix' =>'o','middleware'=>['isOwner','auth']], function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('o.dashboard');
    Route::get('laporan', [LaporanController::class, 'index']);
});
