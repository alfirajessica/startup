<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvController;
use App\Http\Controllers\EventController;

use App\Http\Controllers\DevController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryproductController;
use App\Http\Controllers\TypeTransController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\ValuationToolsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('reg/cities/{province_id}', [RegisterController::class, 'getCities']); //get all cities in buat event

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/users/logout', [LoginController::class, 'userLogout'])->name('users.logout');

//upd global in inv and dev when event has passed
Route::get('/eventPassed', [HomeController::class, 'event_haspassed'])->name('eventPassed');
 
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

    //tipe transaksi
    Route::get('/typetrans', [TypeTransController::class, 'typeTrans'])->name('admin.typeTrans');
    Route::post('/typetrans/new', [TypeTransController::class, 'addNewtypeTrans'])->name('admin.addNewtypeTrans');
    Route::get('/typetrans/editTypeTrans/{id}', [TypeTransController::class, 'editTypeTrans'])->name('admin.typeTrans.editTypeTrans');
    Route::post('/typetrans/updateTypeTrans', [TypeTransController::class, 'updateTypeTrans'])->name('admin.updateTypeTrans');

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
Route::get('/inv/listEvent/listParticipant/{id}', [EventController::class, 'listParticipant'])->name('inv.listEvent.listParticipant'); //get all cities in buat event
//investor -- end of event


//investor di page startup
Route::get('/inv/startup', [ProductController::class, 'startup'])->name('inv.startup');
Route::get('/inv/startup/{id}', [InvController::class, 'detail_category_filter'])->name('inv.startup.detail_category_filter');
Route::get('/inv/detailstartup/{id}', [InvController::class, 'detailstartup'])->name('inv.detailstartup');

//search
Route::get('/inv/startup/searchStartup/{id}', [ProductController::class, 'searchStartup'])->name('inv.startup.searchStartup');
Route::get('inv/get-more-users', [ProductController::class, 'getMoreUsers'])->name('inv.get-more-users');

//-----------------------------end of INVESTOR---------------------------



//Developer
Route::get('/dev/akun', [DevController::class, 'akun'])->name('dev.akun');
Route::post('/dev/akun/updateAkun', [DevController::class, 'updateAkun'])->name('dev.akun.updateAkun'); 
Route::post('/dev/akun/updateTentang', [DevController::class, 'updateTentang'])->name('dev.akun.updateTentang'); 
Route::get('/dev/cities/{province_id}', [DevController::class, 'getCities']); //get all cities in buat event

//event
Route::get('/dev/event', [EventController::class, 'devEvent'])->name('dev.event');
Route::get('/dev/event/detailsEvent/{id}', [EventController::class, 'detailsEvent'])->name('dev.event.detailsEvent');
Route::post('/dev/event/joinEvent', [EventController::class, 'joinEvent'])->name('dev.event.joinEvent');
//Route::get('/inv/listEvent', [EventController::class, 'listEvent'])->name('inv.listEvent'); //show list event
Route::get('/dev/event/cancleEvent/{id}', [EventController::class, 'cancleEvent'])->name('dev.event.cancleEvent');

//listjoinevent
Route::get('/dev/listJoinEvent', [EventController::class, 'listJoinEvent'])->name('dev.listJoinEvent');
Route::get('/dev/listCancleEvent', [EventController::class, 'listCancleEvent'])->name('dev.listCancleEvent');
Route::get('/dev/listHistoryEvent', [EventController::class, 'listHistoryEvent'])->name('dev.listHistoryEvent');

//product
Route::get('/dev/product', [DevController::class, 'product'])->name('dev.product');
Route::get('/dev/product/{id}', [DevController::class, 'detail_category_filter'])->name('dev.product.detail_category_filter');
Route::post('/dev/product', [ProductController::class, 'addNewProduct'])->name('dev.product.addNewProduct'); 
Route::get('/dev/listProject/select', [ProductController::class, 'listProject_select'])->name('dev.listProject.select');
Route::get('/dev/listProduct', [ProductController::class, 'listProduct'])->name('dev.listProduct'); //show list product in daftar product
Route::get('/dev/listProduct/detailProject/{id}', [ProductController::class, 'detailProject'])->name('dev.listProduct.detailProject'); 
Route::get('/dev/listProduct/detailProjectKas/{id}', [ProductController::class, 'detailProjectKas'])->name('dev.listProduct.detailProjectKas'); 
Route::get('/dev/listProduct/deleteProject/{id}', [ProductController::class, 'deleteProject'])->name('dev.listProduct.deleteProject'); //show list product

//product -- ubah
Route::get('/dev/listProduct/ubahProject', [ProductController::class, 'ubahProject'])->name('dev.listProduct.ubahProject'); 

//product-pemasukan
Route::get('/dev/product/listPemasukkan/{id}', [ProductController::class, 'listPemasukkan'])->name('dev.product.listPemasukkan'); //show list product
Route::post('/dev/listPemasukkan/addNewPemasukkan', [ProductController::class, 'addNewPemasukkan'])->name('dev.listPemasukkan.addNewPemasukkan'); //show list product


//product-pengeluaran
Route::get('/dev/product/listPengeluaran/{id}', [ProductController::class, 'listPengeluaran'])->name('dev.product.listPengeluaran'); //show list product
Route::post('/dev/listPengeluaran/addNewPengeluaran', [ProductController::class, 'addNewPengeluaran'])->name('dev.listPengeluaran.addNewPengeluaran'); //show list product

Route::get('/dev/product/deletePemasukkan/{id}', [ProductController::class, 'deletePemasukkan'])->name('dev.product.deletePemasukkan');
Route::get('/dev/product/deletePengeluaran/{id}', [ProductController::class, 'deletePengeluaran'])->name('dev.product.deletePengeluaran'); 

Route::get('/dev/product/detailPemasukkan/{id}', [ProductController::class, 'detailPemasukkan'])->name('dev.product.detailPemasukkan'); 
Route::post('/dev/product/updatePemasukkan', [ProductController::class, 'updatePemasukkan'])->name('dev.product.updatePemasukkan'); //show list product




Route::get('/dev/review', [DevController::class, 'review'])->name('dev.review');

//search
Route::get('/dev/event/searchEvent/{id}', [EventController::class, 'searchEvent'])->name('dev.event.searchEvent');
Route::get('get-more-users', [EventController::class, 'getMoreUsers'])->name('users.get-more-users');


