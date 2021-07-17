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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvestController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StartupTagController;

use App\Http\Controllers\ValuationToolsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminResetPasswordController;

use App\Event\MyEvent;

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

//akun
Route::get('/akun', [HomeController::class, 'akun'])->name('akun');
Route::get('/akun/detailProfil', [HomeController::class, 'detailProfil'])->name('akun.detailProfil');
Route::post('/akun/updateAkun', [HomeController::class, 'updateAkun'])->name('akun.updateAkun'); 
Route::post('/akun/updateTentang', [HomeController::class, 'updateTentang'])->name('akun.updateTentang'); 

//upd global in inv and dev when event has passed
Route::get('/eventPassed', [HomeController::class, 'event_haspassed'])->name('eventPassed');

//upd global di investor dan dev -- update status transaction di header invests
Route::get('/updStatus', [HomeController::class, 'updStatusTrans'])->name('updStatus');

//upd global in inv and dev when event has passed
Route::get('/investPassed', [HomeController::class, 'invest_haspassed'])->name('investPassed');

//get detail transaksi invest
Route::get('/detailInvest/{id}', [HomeController::class, 'detailInvest'])->name('detailInvest');
Route::get('/detailStatusInvest/{id}', [HomeController::class, 'detailStatusInvest'])->name('detailStatusInvest');
Route::get('/projectdetailInvest/{id}', [HomeController::class, 'projectdetailInvest'])->name('projectdetailInvest');

//cancle invest
Route::get('/cancleInvest/{id}', [HomeController::class, 'cancleInvest'])->name('cancleInvest');



Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/reset', [AdminResetPasswordController::class, 'reset']);
    Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
   
    //pengaturan akun
    Route::get('/akun', [AdminController::class, 'akun'])->name('admin.akun');

    //master kategori produk
    Route::get('/kategoriProduk', [CategoryproductController::class, 'kategoriProduk'])->name('admin.kategoriProduk');
    Route::post('/kategoriProduk/addNewCategoryProduct', [CategoryproductController::class, 'addNewCategoryProduct'])->name('admin.kategoriProduk.addNewCategoryProduct');
    Route::get('/kategoriProduk/detailKategori/{id}', [CategoryproductController::class, 'detailCategoryProduct'])->name('admin.kategoriProduk.detailKategori');
    Route::get('/kategoriProduk/editKategori/{id}', [CategoryproductController::class, 'editCategoryProduct'])->name('admin.kategoriProduk.editCategoryProduct');
    
    Route::post('/kategoriProduk/addNewDetailCategoryProduct', [CategoryproductController::class, 'addNewDetailCategoryProduct'])->name('admin.kategoriProduk.addNewDetailCategoryProduct');
    Route::get('/kategoriProduk/nonAktifKategori/{id}', [CategoryproductController::class, 'nonAktifKategori'])->name('admin.kategoriProduk.nonAktifKategori');
    Route::get('/kategoriProduk/aktifKategori/{id}', [CategoryproductController::class, 'aktifKategori'])->name('admin.kategoriProduk.aktifKategori');

    Route::get('/kategoriProduk/nonaktifDetailKategori/{id}', [CategoryproductController::class, 'nonaktifDetailKategori'])->name('admin.kategoriProduk.nonaktifDetailKategori');
    Route::get('/kategoriProduk/aktifDetailKategori/{id}', [CategoryproductController::class, 'aktifDetailKategori'])->name('admin.kategoriProduk.aktifDetailKategori');

    Route::post('/kategoriProduk/updateCategoryProduct', [CategoryproductController::class, 'updateCategoryProduct'])->name('admin.kategoriProduk.updateCategoryProduct');
    

    //tipe transaksi
        Route::get('/typeTrans', [TypeTransController::class, 'typeTrans'])->name('admin.typeTrans');
        Route::post('/typeTrans/addNewtypeTrans', [TypeTransController::class, 'addNewtypeTrans'])->name('admin.typeTrans.addNewtypeTrans');
        Route::get('/typeTrans/editTypeTrans/{id}', [TypeTransController::class, 'editTypeTrans'])->name('admin.typeTrans.editTypeTrans');
        Route::post('/typeTrans/updateTypeTrans', [TypeTransController::class, 'updateTypeTrans'])->name('admin.typeTrans.updateTypeTrans');
        Route::get('/typeTrans/nonAktifTypeTrans/{id}', [TypeTransController::class, 'nonAktifTypeTrans'])->name('admin.typeTrans.nonAktifTypeTrans');
        Route::get('/typeTrans/aktifTypeTrans/{id}', [TypeTransController::class, 'aktifTypeTrans'])->name('admin.typeTrans.aktifTypeTrans');

   
    //startup tags
    Route::get('/startupTags', [StartupTagController::class, 'startupTags'])->name('admin.startupTags');
    Route::post('/startupTags/addNewHStartupTag', [StartupTagController::class, 'addNewHStartupTag'])->name('admin.startupTags.addNewHStartupTag');
    Route::get('/startupTags/editHStartupTag/{id}', [StartupTagController::class, 'editHStartupTag'])->name('admin.startupTags.editHStartupTag');
    Route::post('/startupTags/updateHStartupTag', [StartupTagController::class, 'updateHStartupTag'])->name('admin.startupTags.updateHStartupTag');
    Route::get('/startupTags/nonAktifHStartupTag/{id}', [StartupTagController::class, 'nonAktifHStartupTag'])->name('admin.startupTags.nonAktifHStartupTag');
    Route::get('/startupTags/aktifHStartupTag/{id}', [StartupTagController::class, 'aktifHStartupTag'])->name('admin.startupTags.aktifHStartupTag');

    Route::get('/startupTags/showSubStartupTag/{id}', [StartupTagController::class, 'showSubStartupTag'])->name('admin.startupTags.showSubStartupTag');
    Route::post('/startupTags/addNewSubStartupTag', [StartupTagController::class, 'addNewSubStartupTag'])->name('admin.startupTags.addNewSubStartupTag');
    Route::get('/startupTags/nonAktifSubStartupTag/{id}', [StartupTagController::class, 'nonAktifSubStartupTag'])->name('admin.startupTags.nonAktifSubStartupTag');
    Route::get('/startupTags/aktifSubStartupTag/{id}', [StartupTagController::class, 'aktifSubStartupTag'])->name('admin.startupTags.aktifSubStartupTag');

    //tab nav - developer
        Route::get('/dev/daftarDeveloper', [AdminController::class, 'listdev'])->name('admin.dev.listDev');
        Route::get('/dev/detailDev/{id}', [AdminController::class, 'detailDev'])->name('admin.dev.detailDev');
        Route::get('/dev/produkDeveloper', [AdminController::class, 'produkdev'])->name('admin.dev.produkDev');
        Route::get('/dev/listProductDev', [AdminController::class, 'listProductDev'])->name('admin.dev.listProductDev'); 
        Route::get('/dev/listProductDev/detailProject/{id}', [AdminController::class, 'detailProject'])->name('admin.dev.listProductDev.detailProject'); 
        Route::get('/dev/listProductDev/confirmProject/{id}', [AdminController::class, 'confirmProject'])->name('admin.dev.listProductDev.confirmProject');
        Route::post('/dev/listProductDev/notConfirmProject', [AdminController::class, 'notConfirmProject'])->name('admin.dev.listProductDev.notConfirmProject');
        
        Route::get('/dev/listProductDev/getDetailKategori/{id}', [AdminController::class, 'getDetailKategori'])->name('admin.dev.listProductDev.getDetailKategori');
        Route::get('/dev/listProductDev/getDetailSubStartupTag/{id}', [AdminController::class, 'getDetailSubStartupTag'])->name('admin.dev.listProductDev.getDetailSubStartupTag');
        Route::get('/dev/listProductDev/detailProjectKas/{id}', [AdminController::class, 'detailProjectKas'])->name('admin.dev.listProductDev.detailProjectKas');
        Route::get('/dev/listProductDev/get_allReasonTdkDikonfirmasi/{id}', [AdminController::class, 'get_allReasonTdkDikonfirmasi'])->name('admin.dev.listProductDev.get_allReasonTdkDikonfirmasi');

    //tab nav- developer - produk terdata
    Route::get('/dev/allListProduct', [AdminController::class, 'allListProduct'])->name('admin.dev.allListProduct');
    Route::get('/dev/allListProduct/detail/{id}', [AdminController::class, 'detailProjectTerdata'])->name('admin.dev.allListProduct.detail');


    //pengguna - investor
    Route::get('/inv/daftarInvestor', [AdminController::class, 'listinv'])->name('admin.inv.listInv');
    Route::get('/inv/transaksiInv', [AdminController::class, 'transaksiInv'])->name('admin.inv.transaksiInv');
    Route::get('/inv/transaksiInv/confirmInvest/{id}', [AdminController::class, 'confirmInvest'])->name('admin.inv.transaksiInv.confirmInvest');
    Route::get('/inv/transaksiInv/notConfirmInvest/{id}', [AdminController::class, 'notConfirmInvest'])->name('admin.inv.transaksiInv.notConfirmInvest');

    //report
    Route::get('/report', [AdminController::class, 'report'])->name('admin.report');
    Route::get('/report/laporan/{dateawal}/{dateakhir}/{jenislap}', [ReportController::class, 'laporan'])->name('report.laporan');
});



//valuation tools -- all of user can use it
Route::get('/valuation', [ValuationToolsController::class, 'valuation'])->name('valuation');
Route::post('/valuation/addnew', [ValuationToolsController::class, 'addnew'])->name('valuation.addnew');
Route::get('/valuation/cetak_hasilValuation/{email}', [ValuationToolsController::class, 'cetak_hasilValuation'])->name('valuation.cetak_hasilValuation');

//-----------------------------INVESTOR-------------------

//investor -- event
Route::get('/inv/event', [EventController::class, 'event'])->name('inv.event'); //show event view
Route::post('/inv/event', [EventController::class, 'buatEvent'])->name('inv.buatEvent'); //buat event
Route::get('/inv/listEvent', [EventController::class, 'listEvent'])->name('inv.listEvent'); //show list event
Route::get('/cities/{province_id}', [EventController::class, 'getCities']); //get all cities in buat event

Route::get('/inv/listEvent/editEvent/{id}', [EventController::class, 'editEvent'])->name('inv.listEvent.editEvent'); 
Route::post('/inv/listEvent/updateEvent', [EventController::class, 'updateEvent'])->name('inv.listEvent.updateEvent'); 
Route::get('/inv/listEvent/nonaktifEvent/{id}', [EventController::class, 'nonaktifEvent'])->name('inv.listEvent.nonaktifEvent'); 
Route::get('/inv/listEvent/aktifEvent/{id}', [EventController::class, 'aktifEvent'])->name('inv.listEvent.aktifEvent'); 
Route::get('/inv/listEvent/listParticipant/{id}', [EventController::class, 'listParticipant'])->name('inv.listEvent.listParticipant'); //get all cities in buat event
//investor -- end of event


//investor di page startup
Route::get('/inv/startup', [ProductController::class, 'startup'])->name('inv.startup');
Route::get('/inv/startup/detailstartup/{id}', [ProductController::class, 'detailstartup'])->name('inv.startup.detailstartup');

//Route::get('/inv/startup/{id}', [InvController::class, 'detail_category_filter'])->name('inv.startup.detail_category_filter');
//Route::get('/inv/startup/desc/financial/{id}', [InvController::class, 'listFinance'])->name('inv.detailstartup.financial');

//search
Route::get('/inv/startup/searchStartup/{id}', [ProductController::class, 'searchStartup'])->name('inv.startup.searchStartup');
Route::get('inv/get-more-startups', [ProductController::class, 'getMoreStartups'])->name('inv.get-more-startups');


//investor -- startup
Route::get('/inv/invest', [InvController::class, 'invest'])->name('inv.invest');

//investor saat tekan tombol Investasikan -- using Midtrans Payment
Route::get('/inv/investTo/{id}/{invest}', [InvestController::class, 'investTo'])->name('inv.investTo');
Route::get('/inv/invest/listInvestPending', [InvestController::class, 'listInvestPending'])->name('inv.invest.listInvestPending');
Route::get('/inv/invest/listInvestSettlement', [InvestController::class, 'listInvestSettlement'])->name('inv.invest.listInvestSettlement');
Route::get('/inv/invest/listInvestCancel', [InvestController::class, 'listInvestCancel'])->name('inv.invest.listInvestCancel');
Route::get('/inv/invest/listInvestFinished', [InvestController::class, 'listInvestFinished'])->name('inv.invest.listInvestFinished');

//detailLaporan Keuangan Startup
Route::get('/detailFinance/{id}', [InvestController::class, 'detailFinance'])->name('detailFinance');
Route::get('/totalpemasukkan/{id}', [InvestController::class, 'totalpemasukkan'])->name('totalpemasukkan');
Route::get('/totalpengeluaran/{id}', [InvestController::class, 'totalpengeluaran'])->name('totalpengeluaran');

//reviews - ulasan
Route::post('/inv/review', [ReviewController::class, 'beriReview'])->name('inv.beriReview'); //buat event
Route::get('/inv/review/refreshUlasan/{id}', [ReviewController::class, 'refreshUlasan'])->name('inv.review.refreshUlasan');

//history review
Route::get('/inv/riwayatReview', [ReviewController::class, 'riwayatReview'])->name('inv.riwayatReview');
Route::get('/inv/riwayatReview/listReviews', [ReviewController::class, 'listReviews'])->name('inv.riwayatReview.listReviews');

//report
Route::get('/inv/report/cetak_keuanganStartup/{id}', [ReportController::class, 'cetak_keuanganStartup'])->name('inv.report.cetak_keuanganStartup');
Route::get('/inv/report/cetak_riwayatInv/{dateawal}/{dateakhir}/{jenislap}', [ReportController::class, 'cetak_riwayatInv'])->name('inv.report.cetak_riwayatInv');
Route::get('/inv/report/cetak_riwayatEvent/{dateawal}/{dateakhir}/{jenisEvent}/{statusEvent}', [ReportController::class, 'cetak_riwayatEvent'])->name('inv.report.cetak_riwayatEvent');
Route::get('/inv/report/cetak_participantEvent/{id}', [ReportController::class, 'cetak_participantEvent'])->name('inv.report.cetak_participantEvent');

//-----------------------------end of INVESTOR---------------------------



//-----------------------------Developer---------------------------

//event
Route::get('/dev/event', [EventController::class, 'devEvent'])->name('dev.event');
Route::get('/dev/event/detailsEvent/{id}', [EventController::class, 'detailsEvent'])->name('dev.event.detailsEvent');
Route::get('/dev/event/joinEvent/{id}', [EventController::class, 'joinEvent'])->name('dev.event.joinEvent');
Route::get('/dev/event/cancleEvent/{id}', [EventController::class, 'cancleEvent'])->name('dev.event.cancleEvent');

//listjoinevent
Route::get('/dev/listJoinEvent', [EventController::class, 'listJoinEvent'])->name('dev.listJoinEvent');
Route::get('/dev/listCancleEvent', [EventController::class, 'listCancleEvent'])->name('dev.listCancleEvent');
Route::get('/dev/listHistoryEvent', [EventController::class, 'listHistoryEvent'])->name('dev.listHistoryEvent');

//product
Route::get('/dev/product', [DevController::class, 'product'])->name('dev.product');
Route::get('/dev/product/{id}', [DevController::class, 'detail_category_filter'])->name('dev.product.detail_category_filter');
Route::get('/dev/product/subTag/{id}', [DevController::class, 'subTag'])->name('dev.product.subTag');
Route::post('/dev/product', [ProductController::class, 'addNewProduct'])->name('dev.product.addNewProduct'); 
Route::get('/dev/listProject/select', [ProductController::class, 'listProject_select'])->name('dev.listProject.select');
Route::get('/dev/listProduct', [ProductController::class, 'listProduct'])->name('dev.listProduct'); //show list product in daftar product
Route::get('/dev/listProduct/get_Status/{id}', [ProductController::class, 'get_Status'])->name('dev.listProduct.get_Status');
Route::get('/dev/listProduct/get_allReasonTdkDikonfirmasi/{id}', [ProductController::class, 'get_allReasonTdkDikonfirmasi'])->name('dev.listProduct.get_allReasonTdkDikonfirmasi');

Route::get('/dev/laporan', [DevController::class, 'laporan'])->name('dev.laporan');

//ulasan di tab ulasan
Route::get('/dev/reviews', [ReviewController::class, 'reviews'])->name('dev.reviews'); 
Route::get('/dev/reviews/getResponse/{id}', [ReviewController::class, 'getResponse'])->name('dev.reviews.getResponse'); 
Route::post('/dev/reviews/postResponse', [ReviewController::class, 'postResponse'])->name('dev.reviews.postResponse'); 

//jenisproduct/project
Route::get('/dev/listProduct/get_categoryID/{id}', [ProductController::class, 'get_categoryID'])->name('dev.listProduct.get_categoryID'); 
Route::get('/dev/listProduct/jenisProject', [ProductController::class, 'jenisProject'])->name('dev.listProduct.jenisProject'); 
Route::get('/dev/listProduct/detailKategori/{id}', [ProductController::class, 'detailKategori'])->name('dev.listProduct.detailKategori'); 
Route::get('/dev/listProduct/get_substartupTagID/{id}', [ProductController::class, 'get_substartupTagID'])->name('dev.listProduct.get_substartupTagID'); 
Route::get('/dev/listProduct/detailsubstartupTag/{id}', [ProductController::class, 'detailsubstartupTag'])->name('dev.listProduct.detailsubstartupTag'); 

Route::get('/dev/listProduct/detailProject/{id}', [ProductController::class, 'detailProject'])->name('dev.listProduct.detailProject'); 
Route::get('/dev/listProduct/detailProjectKas/{id}', [ProductController::class, 'detailProjectKas'])->name('dev.listProduct.detailProjectKas'); 
Route::get('/dev/listProduct/detailProjectReview/{id}', [ReviewController::class, 'detailProjectReview'])->name('dev.listProduct.detailProjectReview'); 

Route::post('/dev/listProduct/updDetailProject', [ProductController::class, 'updDetailProject'])->name('dev.listProduct.updDetailProject'); 

Route::get('/dev/listProduct/deleteProject/{id}', [ProductController::class, 'deleteProject'])->name('dev.listProduct.deleteProject'); 
Route::get('/dev/listProduct/activeProject/{id}', [ProductController::class, 'activeProject'])->name('dev.listProduct.activeProject'); 
Route::get('/dev/listProduct/nonactiveProject/{id}', [ProductController::class, 'nonactiveProject'])->name('dev.listProduct.nonactiveProject'); 
Route::get('/dev/listProduct/konfirmasiUlang/{id}', [ProductController::class, 'konfirmasiUlang'])->name('dev.listProduct.konfirmasiUlang'); 


//product -- ubah
Route::get('/dev/listProduct/ubahProject', [ProductController::class, 'ubahProject'])->name('dev.listProduct.ubahProject'); 

//product-pemasukan
Route::get('/dev/product/listPemasukkan/{id}', [ProductController::class, 'listPemasukkan'])->name('dev.product.listPemasukkan'); //show list product
Route::post('/dev/listPemasukkan/addNewPemasukkan', [ProductController::class, 'addNewPemasukkan'])->name('dev.listPemasukkan.addNewPemasukkan'); //show list product

//cek pemasukkan pada product per id
Route::get('/dev/listProduct/cek_pemasukan/{id}', [ProductController::class, 'cek_pemasukan'])->name('dev.listProduct.cek_pemasukan'); //show list product

//product-pengeluaran
Route::get('/dev/product/listPengeluaran/{id}', [ProductController::class, 'listPengeluaran'])->name('dev.product.listPengeluaran'); //show list product
Route::post('/dev/listPengeluaran/addNewPengeluaran', [ProductController::class, 'addNewPengeluaran'])->name('dev.listPengeluaran.addNewPengeluaran'); //show list product

Route::get('/dev/product/deletePemasukkan/{id}', [ProductController::class, 'deletePemasukkan'])->name('dev.product.deletePemasukkan');
Route::get('/dev/product/deletePengeluaran/{id}', [ProductController::class, 'deletePengeluaran'])->name('dev.product.deletePengeluaran'); 

Route::get('/dev/product/detailPemasukkan/{id}', [ProductController::class, 'detailPemasukkan'])->name('dev.product.detailPemasukkan'); 
Route::post('/dev/product/updatePemasukkan', [ProductController::class, 'updatePemasukkan'])->name('dev.product.updatePemasukkan'); //show list product

//Route::get('/dev/review', [DevController::class, 'review'])->name('dev.review'); //gk dipakai



//search
Route::get('/dev/event/searchEvent/{id}', [EventController::class, 'searchEvent'])->name('dev.event.searchEvent');
Route::get('get-more-users', [EventController::class, 'getMoreUsers'])->name('users.get-more-users');

//report
Route::get('/dev/report/cetak_semuaProyek/{dateawal}/{dateakhir}/{statusproyek}', [ReportController::class, 'cetak_semuaProyek'])->name('dev.report.cetak_semuaProyek');
Route::get('/dev/report/cetak_detailProyek/{idproyek}', [ReportController::class, 'cetak_detailProyek'])->name('dev.report.cetak_detailProyek');
Route::get('/dev/report/cetak_allDetailProyek/{idproyek}', [ReportController::class, 'cetak_allDetailProyek'])->name('dev.report.cetak_allDetailProyek');
Route::get('/dev/report/cetak_invProyek/{dateawal}/{dateakhir}/{idproyek}', [ReportController::class, 'cetak_invProyek'])->name('dev.report.cetak_invProyek');
Route::get('/dev/report/cetak_transProyek/{dateawal}/{dateakhir}/{idproyek}', [ReportController::class, 'cetak_transProyek'])->name('dev.report.cetak_transProyek');
Route::get('/dev/report/cetak_reviewProyek/{dateawal}/{dateakhir}/{idproyek}', [ReportController::class, 'cetak_reviewProyek'])->name('dev.report.cetak_reviewProyek');
