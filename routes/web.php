<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ValuationToolsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminResetPasswordController;

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
Route::post('/users/logout', [LoginController::class, 'userLogout'])->name('users.logout');

 
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    //Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    Route::get('/password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');

    Route::post('/password/reset', [AdminResetPasswordController::class, 'reset']);

    Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
   
    //pengaturan akun
    Route::get('/akun', [AdminController::class, 'akun'])->name('admin.akun');

    //pengguna - developer
    Route::get('/dev/daftarDeveloper', [AdminController::class, 'listdev'])->name('admin.dev.listDev');
    Route::get('/dev/produkDeveloper', [AdminController::class, 'produkdev'])->name('admin.dev.produkDev');

    //pengguna - investor
    Route::get('/dev/daftarInvestor', [AdminController::class, 'listinv'])->name('admin.inv.listInv');
    Route::get('/dev/transaksiInvestor', [AdminController::class, 'transaksiinv'])->name('admin.inv.transaksiInv');
});


//valuation tools -- all of can use it
Route::get('/valuation', [ValuationToolsController::class, 'valuation'])->name('valuation');

//INVESTOR
Route::get('/inv/akun', [InvController::class, 'akun'])->name('inv.akun');
Route::get('/event', [InvController::class, 'event'])->name('event');
Route::get('/inv/startup', [InvController::class, 'startup'])->name('inv.startup');
Route::get('/inv/detailstartup', [InvController::class, 'detailstartup'])->name('detailstartup');

//Developer
Route::get('/dev/akun', [DevController::class, 'akun'])->name('dev.akun');
Route::get('/dev/product', [DevController::class, 'product'])->name('dev.product');
Route::get('/dev/review', [DevController::class, 'review'])->name('dev.review');



