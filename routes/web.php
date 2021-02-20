<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ValuationToolsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;


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
//Route::get('/admin', [AdminController::class, 'index'])->name('home');


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});


//valuation tools -- all of can use it
Route::get('/valuation', [ValuationToolsController::class, 'valuation'])->name('valuation');

//INVESTOR
Route::get('/inv/akun', [InvController::class, 'akun'])->name('inv.akun');
Route::get('/event', [InvController::class, 'event'])->name('event');
Route::get('/startup', [InvController::class, 'startup'])->name('startup');

//Developer
Route::get('/dev/akun', [DevController::class, 'akun'])->name('dev.akun');
Route::get('/dev/product', [DevController::class, 'product'])->name('dev.product');



