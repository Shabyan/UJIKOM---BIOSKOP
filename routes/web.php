<?php

use App\Http\Controllers\kursiR;
use App\Http\Controllers\logC;
use App\Http\Controllers\loginC;
use App\Http\Controllers\dashboardC;
use App\Http\Controllers\productR;
use App\Http\Controllers\studioR;
use App\Http\Controllers\transactionR;
use App\Http\Controllers\userR;
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

//pdf
Route::get('kursi/pdf', [kursiR::class, 'pdf']);
Route::get('studio/pdf', [studioR::class, 'pdf']);
Route::get('product/pdf', [productR::class, 'pdf']);
Route::get('transaction/pdf', [transactionR::class, 'pdf']);
Route::get('user/pdf', [userR::class, 'pdf']);
// routes/web.php
Route::get('transaction/filterPdf', [transactionR::class, 'filterPdf'])->name('transaction.filterPdf')->middleware('userAkses:owner');
Route::get('transaction/pdf2/{id}',  [transactionR::class, 'pdf2']);
Route::get('transaction/pdf',  [transactionR::class, 'pdf']);



Route::get('/', function () {
    $subtitle = 'Home Page';
    return view('dashboard', compact('subtitle'));
})->middleware('auth');

Route::get('/dashboard', function () {
    $subtittle = "halaman dashboard";
    return view('dashboard', compact('subtittle'));
})->middleware('auth');


//user
Route::resource('user', userR::class)->middleware('userAkses:admin,kasir,owner');
Route::get('user/changepassword/{id}', [userR::class, 'changepassword'])->name('user.changepassword')->middleware('userAkses:admin');
Route::put('user/change/{id}', [userR::class, 'change'])->name('user.change')->middleware('userAkses:admin');


//kursi
Route::resource('kursi', kursiR::class)->middleware('userAkses:admin,kasir,owner');
Route::get('/kursi/reset/{id}', [kursiR::class, 'reset'])->name('kursi.reset');
// Route::post('kursi/reset-all',  [kursiR::class, 'resetAllStatus'])->name('kursi.reset-all');

//dashboard
Route::get('dashboard', [dashboardC::class, 'index'])->name('dashboard.index')->middleware('auth');

//studio
Route::resource('studio', studioR::class)->middleware('userAkses:admin,kasir,owner');

//produk
Route::resource('product', productR::class)->middleware('userAkses:admin,kasir,owner');

//transaksi
Route::get('pertanggaltgl_awal}/{tgl_akhir}', [transactionR::class, 'pertanggal'])->name('transaction.pertanggal')->middleware('userAkses:owner');
Route::get('transaction/all', [transactionR::class, 'all'])->name('transaction.all')->middleware('userAkses:owner');
Route::resource('transaction', transactionR::class)->middleware('userAkses:admin,kasir,owner');


//Login
Route::get('/', [loginC::class, 'login'])->name('login');
Route::post('login', [loginC::class, 'login_action'])->name('login.action');
Route::get('logout', [loginC::class, 'logout'])->name('logout');

//Log
Route::get('log', [logC::class, 'index']);