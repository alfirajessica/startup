<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ValuationToolsController;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//valuation tools -- all of can use it
Route::get('/valuation', [ValuationToolsController::class, 'valuation'])->name('valuation');

//INVESTOR
Route::get('/akun', [InvController::class, 'akun'])->name('akun');
Route::get('/event', [InvController::class, 'event'])->name('event');
Route::get('/startup', [InvController::class, 'startup'])->name('startup');

//Developer
Route::get('/akun', [DevController::class, 'akun'])->name('akun');
Route::get('/produk', [DevController::class, 'produk'])->name('produk');


