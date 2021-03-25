<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvController;
use App\Http\Controllers\EventController;

use App\Http\Controllers\DevController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryproductController;

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

    //master kategori produk
    Route::get('/kategoriProduk', [CategoryproductController::class, 'categoryProduct'])->name('admin.categoryProduct');
    Route::post('/kategoriProduk/new', [CategoryproductController::class, 'addNewCategoryProduct'])->name('admin.addNewCategoryProduct');
    Route::get('/kategoriProduk/detailKategori/{id}', [CategoryproductController::class, 'detailCategoryProduct'])->name('admin.categoryProduct.detailKategori');
    Route::post('/kategoriProduk/detail', [CategoryproductController::class, 'addNewDetailCategoryProduct'])->name('admin.addNewDetailCategoryProduct');
    Route::get('/kategoriProduk/deleteKategori/{id}', [CategoryproductController::class, 'deleteCategoryProduct'])->name('admin.categoryProduct.deleteCategoryProduct');
    Route::get('/kategoriProduk/deleteDetailKategori/{id}', [CategoryproductController::class, 'deleteDetailCategoryProduct'])->name('admin.categoryProduct.deleteDetailCategoryProduct');
    Route::get('/kategoriProduk/editKategori/{id}', [CategoryproductController::class, 'editCategoryProduct'])->name('admin.categoryProduct.editCategoryProduct');
    Route::post('/kategoriProduk/updateKategori', [CategoryproductController::class, 'updateCategoryProduct'])->name('admin.updateCategoryProduct');

    //pengguna - developer
    Route::get('/dev/daftarDeveloper', [AdminController::class, 'listdev'])->name('admin.dev.listDev');
    Route::get('/dev/produkDeveloper', [AdminController::class, 'produkdev'])->name('admin.dev.produkDev');

    //pengguna - investor
    Route::get('/dev/daftarInvestor', [AdminController::class, 'listinv'])->name('admin.inv.listInv');
    Route::get('/dev/transaksiInvestor', [AdminController::class, 'transaksiinv'])->name('admin.inv.transaksiInv');
});



//valuation tools -- all of can use it
Route::get('/valuation', [ValuationToolsController::class, 'valuation'])->name('valuation');

//-----------------------------INVESTOR-------------------
Route::get('/inv/akun', [InvController::class, 'akun'])->name('inv.akun');

//investor -- event
Route::get('/inv/event', [EventController::class, 'event'])->name('inv.event'); //show event view
Route::post('/inv/event', [EventController::class, 'buatEvent'])->name('inv.buatEvent'); //buat event
Route::get('/inv/listEvent', [EventController::class, 'listEvent'])->name('inv.listEvent'); //show list event
Route::get('/cities/{province_id}', [EventController::class, 'getCities']); //get all cities in buat event

Route::get('/inv/listEvent/editEvent/{id}', [EventController::class, 'editEvent'])->name('inv.listEvent.editEvent'); //get all cities in buat event
Route::post('/inv/listEvent/updateEvent', [EventController::class, 'updateEvent'])->name('inv.listEvent.updateEvent'); //get all cities in buat event
Route::get('/inv/listEvent/deleteEvent/{id}', [EventController::class, 'deleteEvent'])->name('inv.listEvent.deleteEvent'); //get all cities in buat event

Route::get('/inv/listEvent/detailEvent/{id}', [EventController::class, 'detailEvent'])->name('inv.listEvent.detailEvent'); //get all cities in buat event
//investor -- end of event

Route::get('/inv/startup', [InvController::class, 'startup'])->name('inv.startup');

//filter di menu startup
Route::get('/inv/startup/{id}', [InvController::class, 'detail_category_filter'])->name('inv.startup.detail_category_filter');

Route::get('/inv/detailstartup', [InvController::class, 'detailstartup'])->name('detailstartup');


//-----------------------------end of INVESTOR---------------------------



//Developer
Route::get('/dev/akun', [DevController::class, 'akun'])->name('dev.akun');

//event
Route::get('/dev/event', [EventController::class, 'devEvent'])->name('dev.event');
Route::get('/dev/event/detailsEvent/{id}', [EventController::class, 'detailsEvent'])->name('dev.event.detailsEvent');
Route::post('/dev/event/joinEvent', [EventController::class, 'joinEvent'])->name('dev.event.joinEvent');

//listjoinevent
Route::get('/dev/listJoinEvent', [EventController::class, 'listJoinEvent'])->name('dev.listJoinEvent');

Route::get('/dev/product', [DevController::class, 'product'])->name('dev.product');
Route::get('/dev/review', [DevController::class, 'review'])->name('dev.review');



