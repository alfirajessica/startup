<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\DetailUser;
use App\Models\DetailProductKas;
use App\Models\HeaderProduct;
use App\Models\HeaderInvest;
use App\Models\DetailInvest;
use Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
        //investor
        public function cetak_keuanganStartup($id)
        {
            // $headerinvest = HeaderInvest::all();
            // $pdf = PDF::loadview('investor.report.cetak_keuanganStartup',['headerinvest' => $headerinvest]);
            // return $pdf->stream();
    
            $data = HeaderInvest::find($id);
            $projectID = $data->project_id;
    
            $dataProduk = HeaderProduct::find($projectID);
            $date_created = $dataProduk->created_at;
    
            $date_inv_awal = $data->created_at->format('Y-m-01') ." 00:00:00";
            $date_inv_exp = \Carbon\Carbon::parse($data->invest_expire)->format('Y-m-01'). " 23:59:59";
    
            $list_kas = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','detail_product_kas.tanggal','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$projectID)
                    ->whereBetween('detail_product_kas.tanggal', [$date_inv_awal, $date_inv_exp])
                    ->orderBy('detail_product_kas.tanggal','asc')
                    ->get();
    
    
            $table_pemasukkan_inv = 
                    DB::table('detail_product_kas')
                    ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_masuk'))
                    ->where('detail_product_kas.id_headerproduct','=',$projectID)
                    ->whereBetween('detail_product_kas.tanggal', [$date_inv_awal, $date_inv_exp])
                    ->where('detail_product_kas.tipe','=','1')
                    ->groupBy(\DB::raw('detail_product_kas.tipe'))
                    ->orderBy('detail_product_kas.tanggal','asc')
                    ->get();
    
            $table_pengeluaran_inv = 
                    DB::table('detail_product_kas')
                    ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_keluar'))
                    ->where('detail_product_kas.id_headerproduct','=',$projectID)
                    ->whereBetween('detail_product_kas.tanggal', [$date_inv_awal, $date_inv_exp])
                    ->where('detail_product_kas.tipe','=','2')
                    ->groupBy(\DB::raw('detail_product_kas.tipe'))
                    ->orderBy('detail_product_kas.tanggal','asc')
                    ->get();
            
            $detail = DB::table('header_products')
                    ->leftJoin('detail_category_products', 'detail_category_products.id','=','header_products.id_detailcategory')
                    ->leftJoin('header_invests','header_invests.project_id','=','header_products.id')
                    ->leftJoin('users','users.id','=','header_products.user_id')
                    ->select('header_products.id','header_products.name_product','detail_category_products.name', 'users.name as nama_dev', 'users.email','header_invests.created_at', 'header_invests.invest_expire','header_invests.jumlah_invest', 'header_invests.jumlah_final')
                    ->where('header_products.id', '=', $projectID)
                    ->where('header_invests.id','=',$id)
                    ->get();
    
            $pdf = PDF::loadview('investor.report.cetak_keuanganStartup', ['list_kas' => $list_kas, 'table_pemasukkan_inv' => $table_pemasukkan_inv, 'table_pengeluaran_inv' => $table_pengeluaran_inv, 'detail' => $detail]);
            return $pdf->stream();
        }
    
        public function cetak_riwayatInv($dateawal, $dateakhir, $jenislap)
        {
            //ada 4 pilihan cetak
            //semua investasi 
            //investasi aktif
            //investasi gagal/cancel
            //investasi selesai
            //semua berdasarkan date awal dan date akhir
    
            $user = auth()->user();
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            //semua investasi
            if ($jenislap == 0) {
                    $list_inv = 
                    DB::table('header_invests')
                    ->join('header_products', 'header_products.id','=','header_invests.project_id')
                    ->select('header_invests.invest_id','header_invests.jumlah_invest','header_invests.jumlah_final','header_invests.status_transaction','header_invests.status_invest','header_invests.created_at','header_invests.invest_expire','header_products.id','header_products.name_product')
                    ->where('header_invests.user_id','=',$user->id)
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->get();
    
                    $countdata =
                    DB::table('header_invests')
                    ->select(\DB::raw('COUNT(header_invests.id) as total'))
                    ->where('header_invests.user_id','=',$user->id)
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->get();
            }
    
            //investasi aktif
            else if ($jenislap == 1) {
                   $list_inv = 
                    DB::table('header_invests')
                    ->join('header_products', 'header_products.id','=','header_invests.project_id')
                    ->select('header_invests.invest_id','header_invests.jumlah_invest','header_invests.jumlah_final','header_invests.status_transaction','header_invests.status_invest','header_invests.created_at','header_invests.invest_expire','header_products.id','header_products.name_product')
                    ->where('header_invests.user_id','=',$user->id)
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->where('header_invests.status_invest','=',1)
                    ->get();
    
                    $countdata =
                    DB::table('header_invests')
                    ->select(\DB::raw('COUNT(header_invests.id) as total'))
                    ->where('header_invests.user_id','=',$user->id)
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->where('header_invests.status_invest','=',1)
                    ->get();
            }
    
            //investasi gagal/cancel
            else if ($jenislap == 2) {
                    $list_inv = 
                     DB::table('header_invests')
                     ->join('header_products', 'header_products.id','=','header_invests.project_id')
                     ->select('header_invests.invest_id','header_invests.jumlah_invest','header_invests.jumlah_final','header_invests.status_transaction','header_invests.status_invest','header_invests.created_at','header_invests.invest_expire','header_products.id','header_products.name_product')
                     ->where('header_invests.user_id','=',$user->id)
                     ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                     ->where('header_invests.status_invest','=',4)
                     ->get();
    
                    $countdata =
                    DB::table('header_invests')
                    ->select(\DB::raw('COUNT(header_invests.id) as total'))
                    ->where('header_invests.user_id','=',$user->id)
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->where('header_invests.status_invest','=',4)
                    ->get();
            }
    
            //investasi selesai
            else if ($jenislap == 3) {
                    $list_inv = 
                     DB::table('header_invests')
                     ->join('header_products', 'header_products.id','=','header_invests.project_id')
                     ->select('header_invests.invest_id','header_invests.jumlah_invest','header_invests.jumlah_final','header_invests.status_transaction','header_invests.status_invest','header_invests.created_at','header_invests.invest_expire','header_products.id','header_products.name_product')
                     ->where('header_invests.user_id','=',$user->id)
                     ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                     ->where('header_invests.status_invest','=',5)
                     ->get();
    
                    $countdata =
                     DB::table('header_invests')
                     ->select(\DB::raw('COUNT(header_invests.id) as total'))
                     ->where('header_invests.user_id','=',$user->id)
                     ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                     ->where('header_invests.status_invest','=',5)
                     ->get();
            }
            
            $date = Carbon::now();
            //$date->toDateTimeString();
            
            $pdf = PDF::loadview('investor.report.cetak_riwayatInv', ['date' => $date, 'list_inv' => $list_inv, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir, 'jenislap' => $jenislap, 'countdata'=>$countdata]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream();
        }
    
        public function cetak_riwayatEvent($dateawal, $dateakhir, $jenisEvent, $statusEvent)
        {
            //ada 3 pilihan cetak jenisevent
            //semua //online //offline
    
            //ada 3 pilihan status event
            //semua //aktif //tidak aktif //selesai
    
            //semua berdasarkan date awal dan date akhir
    
            $user = auth()->user();
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            //semua
            if ($jenisEvent == 0) {
                   $jenisEvent = "Semua";
                    //semua
                    if ($statusEvent == 0) {
                            $list_event =
                            DB::table('header_events')
                            ->where('user_id','=',$user->id)
                            ->whereBetween('created_at', [$date_awal, $date_akhir])
                            ->get();
    
                            $countdata =
                            DB::table('header_events')
                            ->select(\DB::raw('COUNT(id) as total'))
                            ->where('user_id','=',$user->id)
                            ->whereBetween('created_at', [$date_awal, $date_akhir])
                            ->get();
                    }else{
                            $list_event =
                            DB::table('header_events')
                            ->where('header_events.user_id','=',$user->id)
                            ->whereBetween('header_events.created_at', [$date_awal, $date_akhir])
                            ->where('header_events.status','=',$statusEvent)
                            ->get();
    
                            $countdata =
                            DB::table('header_events')
                            ->select(\DB::raw('COUNT(id) as total'))
                            ->where('user_id','=',$user->id)
                            ->whereBetween('created_at', [$date_awal, $date_akhir])
                            ->where('status','=',$statusEvent)
                            ->get();
                    }
            }
            else{
                 if ($jenisEvent == 1) {
                    $jenisEvent = "Online";
                 }else if($jenisEvent == 2){
                    $jenisEvent = "Offline";
                 }
    
                    //semua
                    if ($statusEvent == 0) {
                            $list_event =
                            DB::table('header_events')
                            ->where('header_events.user_id','=',$user->id)
                            ->where('header_events.held','=',$jenisEvent)
                            ->whereBetween('header_events.created_at', [$date_awal, $date_akhir])
                            ->get();
    
                            $countdata =
                            DB::table('header_events')
                            ->select(\DB::raw('COUNT(id) as total'))
                            ->where('header_events.user_id','=',$user->id)
                            ->where('header_events.held','=',$jenisEvent)
                            ->whereBetween('header_events.created_at', [$date_awal, $date_akhir])
                            ->get();
                    }
                    else{
                            $list_event =
                            DB::table('header_events')
                            ->where('header_events.user_id','=',$user->id)
                            ->where('header_events.held','=',$jenisEvent)
                            ->whereBetween('header_events.created_at', [$date_awal, $date_akhir])
                            ->where('header_events.status','=',$statusEvent)
                            ->get();
    
                            $countdata =
                            DB::table('header_events')
                            ->select(\DB::raw('COUNT(id) as total'))
                            ->where('header_events.user_id','=',$user->id)
                            ->where('header_events.held','=',$jenisEvent)
                            ->whereBetween('header_events.created_at', [$date_awal, $date_akhir])
                            ->where('header_events.status','=',$statusEvent)
                            ->get();
                    }
    
            }
    
            $date = Carbon::now();
            $pdf = PDF::loadview('investor.report.cetak_riwayatEvent',['date' => $date, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir, 'list_event' => $list_event, 'countdata' => $countdata, 'jenisEvent'=> $jenisEvent, 'statusEvent'=>$statusEvent]);
            return $pdf->stream();
        }
    
        public function cetak_participantEvent($id)
        {   
            $list_participant = 
            DB::table('detail_events')
            ->select('users.name', 'users.email', 'users.province_name', 'users.city_name', 'detail_events.status')
            ->join('users','users.id','=','detail_events.id_participant')
            ->where('detail_events.id_header_events','=',$id)
            ->whereBetween('detail_events.status', ['1', '2'])
            ->get();
    
            $detail =
            DB::table('header_events')
            ->where('id','=',$id)
            ->get();
    
            $count_join =  
            DB::table('detail_events')
            ->select(\DB::raw('COUNT(id) as total_join'))
            ->whereBetween('detail_events.status', ['1', '2'])
            ->where('detail_events.id_header_events','=',$id)
            ->get();
    
            // $count_bataljoin =  
            // DB::table('detail_events')
            // ->select(\DB::raw('COUNT(id) as total_bataljoin'))
            // ->where('status','=','0')
            // ->where('detail_events.id_header_events','=',$id)
            // ->get();
    
    
            $pdf = PDF::loadview('investor.report.cetak_participantEvent', ['list_participant'=>$list_participant, 'detail'=>$detail, 'count_join'=>$count_join]);
            return $pdf->stream();
        }
    
        //developer
        public function cetak_semuaProyek($dateawal, $dateakhir, $statusproyek)
        {
            //0- blm dikonfirmasi, 1-aktif/sdh dikonfirmasi, 2-project memiliki investor, 3-dinonaktifkan, 4-project tidk dikonfirmasi
    
            $user = auth()->user();
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            if ($statusproyek == 0) {
                    $listproyek =  
                    DB::table('header_products')
                    ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.created_at', 'header_products.status')
                    ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
                    ->join('category_products','category_products.id','=','detail_category_products.category_id')
                    ->where('header_products.user_id','=',$user->id)
                    ->where('header_products.status','!=','0')
                    ->where('header_products.status','!=','4')
                    ->whereBetween('header_products.created_at', [$date_awal, $date_akhir])
                    ->get();
            }
            else{
                    $listproyek =  
                    DB::table('header_products')
                    ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.created_at', 'header_products.status')
                    ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
                    ->join('category_products','category_products.id','=','detail_category_products.category_id')
                    ->where('header_products.user_id','=',$user->id)
                    ->where('header_products.status','=',$statusproyek)
                    ->whereBetween('header_products.created_at', [$date_awal, $date_akhir])
                    ->get();
            }
    
            $pdf = PDF::loadview('developer.report.cetak_semuaProyek',['listproyek'=>$listproyek, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir, 'statusproyek'=>$statusproyek]);
            return $pdf->stream();
        }
    
        public function cetak_detailProyek($idproyek)
        {
            $detailproyek =
            DB::table('header_products')
            ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.url', 'header_products.rilis', 'header_products.image', 'header_products.created_at', 'header_products.status', 'header_products.desc', 'header_products.team', 'header_products.benefit', 'header_products.reason', 'header_products.solution')
            ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
            ->join('category_products','category_products.id','=','detail_category_products.category_id')
            ->where('header_products.id','=',$idproyek)
            ->get();
    
            $pdf = PDF::loadview('developer.report.cetak_detailProyek',['detailproyek'=>$detailproyek]);
            return $pdf->stream();
        }
    
        public function cetak_allDetailProyek($idproyek)
        {
          
            $detailproyek =
                    DB::table('header_products')
                    ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.url', 'header_products.rilis', 'header_products.image', 'header_products.created_at', 'header_products.status', 'header_products.desc', 'header_products.team', 'header_products.benefit', 'header_products.reason', 'header_products.solution')
                    ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
                    ->join('category_products','category_products.id','=','detail_category_products.category_id')
                    ->where('header_products.id','=',$idproyek)
                    ->get();
    
            $list_kas = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$idproyek)
                    ->orderBy('detail_product_kas.created_at','asc')
                    ->get();
    
            $table_pemasukkan_inv = 
                    DB::table('detail_product_kas')
                    ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_masuk'))
                    ->where('detail_product_kas.id_headerproduct','=',$idproyek)
                    ->where('detail_product_kas.tipe','=','1')
                    ->groupBy(\DB::raw('detail_product_kas.tipe'))
                    ->orderBy('detail_product_kas.created_at','asc')
                    ->get();
    
            $table_pengeluaran_inv = 
                    DB::table('detail_product_kas')
                    ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_keluar'))
                    ->where('detail_product_kas.id_headerproduct','=',$idproyek)
                    ->where('detail_product_kas.tipe','=','2')
                    ->groupBy(\DB::raw('detail_product_kas.tipe'))
                    ->orderBy('detail_product_kas.created_at','asc')
                    ->get();
    
            $listInvestor = DB::table('header_invests')
                    ->leftJoin('users', 'users.id', '=', 'header_invests.user_id')
                    ->select('header_invests.id','users.name','header_invests.invest_id','header_invests.jumlah_final','header_invests.status_invest','header_invests.invest_expire')
                    ->where('header_invests.project_id','=',$idproyek)
                    ->get();
    
            $listreviews = 
                    DB::table('reviews')
                    ->join('users', 'users.id','=','reviews.user_id')
                    ->select('reviews.id','users.name','reviews.rating','reviews.isi_review', 'reviews.created_at')
                    ->where('reviews.project_id','=',$idproyek)
                    ->get();
    
    
            $pdf = PDF::loadview('developer.report.cetak_allDetailProyek',['detailproyek'=>$detailproyek, 'list_kas'=>$list_kas, 'table_pemasukkan_inv'=>$table_pemasukkan_inv, 'table_pengeluaran_inv'=>$table_pengeluaran_inv, 'listreviews'=>$listreviews, 'listInvestor'=>$listInvestor]);
            return $pdf->stream();
        }
    
        public function cetak_invProyek($dateawal, $dateakhir, $idproyek)
        {
            $user = auth()->user();
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            $listInvestor = DB::table('header_invests')
            ->leftJoin('users', 'users.id', '=', 'header_invests.user_id')
            ->select('header_invests.id','users.name','header_invests.invest_id','header_invests.jumlah_final','header_invests.status_invest','header_invests.invest_expire')
            ->where('header_invests.project_id','=',$idproyek)
            ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
            ->get();
    
    
            $detailproyek =
            DB::table('header_products')
            ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.url', 'header_products.rilis', 'header_products.image', 'header_products.created_at', 'header_products.status', 'header_products.desc', 'header_products.team', 'header_products.benefit', 'header_products.reason', 'header_products.solution')
            ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
            ->join('category_products','category_products.id','=','detail_category_products.category_id')
            ->where('header_products.id','=',$idproyek)
            ->get();
    
            $pdf = PDF::loadview('developer.report.cetak_invProyek',['detailproyek'=>$detailproyek, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir, 'listInvestor'=>$listInvestor]);
            return $pdf->stream();
        }
    
        public function cetak_transProyek($dateawal, $dateakhir, $idproyek)
        {
            $user = auth()->user();
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            $list_kas = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$idproyek)
                    ->whereBetween('detail_product_kas.created_at', [$date_awal, $date_akhir])
                    ->orderBy('detail_product_kas.created_at','asc')
                    ->get();
    
    
            $table_pemasukkan_inv = 
                    DB::table('detail_product_kas')
                    ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_masuk'))
                    ->where('detail_product_kas.id_headerproduct','=',$idproyek)
                    ->whereBetween('detail_product_kas.created_at', [$date_awal, $date_akhir])
                    ->where('detail_product_kas.tipe','=','1')
                    ->groupBy(\DB::raw('detail_product_kas.tipe'))
                    ->orderBy('detail_product_kas.created_at','asc')
                    ->get();
    
            $table_pengeluaran_inv = 
                    DB::table('detail_product_kas')
                    ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_keluar'))
                    ->where('detail_product_kas.id_headerproduct','=',$idproyek)
                    ->whereBetween('detail_product_kas.created_at', [$date_awal, $date_akhir])
                    ->where('detail_product_kas.tipe','=','2')
                    ->groupBy(\DB::raw('detail_product_kas.tipe'))
                    ->orderBy('detail_product_kas.created_at','asc')
                    ->get();
    
            $detailproyek =
                    DB::table('header_products')
                    ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.url', 'header_products.rilis', 'header_products.image', 'header_products.created_at', 'header_products.status', 'header_products.desc', 'header_products.team', 'header_products.benefit', 'header_products.reason', 'header_products.solution')
                    ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
                    ->join('category_products','category_products.id','=','detail_category_products.category_id')
                    ->where('header_products.id','=',$idproyek)
                    ->get();
    
            $pdf = PDF::loadview('developer.report.cetak_transProyek', ['list_kas' => $list_kas, 'table_pemasukkan_inv' => $table_pemasukkan_inv, 'table_pengeluaran_inv' => $table_pengeluaran_inv, 'detailproyek'=>$detailproyek, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir]);
            return $pdf->stream();
        }
    
        public function cetak_reviewProyek($dateawal, $dateakhir, $idproyek)
        {
            $user = auth()->user();
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            $listreviews = 
            DB::table('reviews')
            ->join('users', 'users.id','=','reviews.user_id')
            ->select('reviews.id','users.name','reviews.rating','reviews.isi_review', 'reviews.created_at')
            ->where('reviews.project_id','=',$idproyek)
            ->whereBetween('reviews.created_at', [$date_awal, $date_akhir])
            ->get();
    
            $detailproyek =
                    DB::table('header_products')
                    ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.url', 'header_products.rilis', 'header_products.image', 'header_products.created_at', 'header_products.status', 'header_products.desc', 'header_products.team', 'header_products.benefit', 'header_products.reason', 'header_products.solution')
                    ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
                    ->join('category_products','category_products.id','=','detail_category_products.category_id')
                    ->where('header_products.id','=',$idproyek)
                    ->get();
    
            $pdf = PDF::loadview('developer.report.cetak_reviewProyek', ['detailproyek'=>$detailproyek, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir, 'listreviews'=>$listreviews]);
            return $pdf->stream();
        }
    
        public function cetak_penilaianInv($dateawal, $dateakhir, $idproyek)
        {
            $user = auth()->user();
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            $listreviews = 
            DB::table('rating_invests')
            ->join('header_invests','rating_invests.id_headerinvest','=','header_invests.id')
            ->join('users', 'users.id','=','header_invests.user_id')
            ->join('header_products', 'header_products.id','=','header_invests.project_id')
            ->select('header_invests.id as id_Hinvest','rating_invests.id','users.name','users.name_company','rating_invests.rating','rating_invests.review', 'rating_invests.created_at', 'header_products.name_product')
            ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
            ->where('header_invests.project_id','=',$idproyek)
            ->orderBy('rating_invests.rating')
            ->get();
    
            $detailproyek =
                    DB::table('header_products')
                    ->select('header_products.id','header_products.name_product','category_products.name_category', 'detail_category_products.name', 'header_products.url', 'header_products.rilis', 'header_products.image', 'header_products.created_at', 'header_products.status', 'header_products.desc', 'header_products.team', 'header_products.benefit', 'header_products.reason', 'header_products.solution')
                    ->join('detail_category_products','detail_category_products.id','=','header_products.id_detailcategory')
                    ->join('category_products','category_products.id','=','detail_category_products.category_id')
                    ->where('header_products.id','=',$idproyek)
                    ->get();
    
            $pdf = PDF::loadview('developer.report.cetak_penilaianInv', ['detailproyek'=>$detailproyek, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir, 'listreviews'=>$listreviews]);
            return $pdf->stream();
        }
    
        public function laporan($dateawal, $dateakhir, $jenislap)
        {
            //-- status_invest -- 0(Menunggu konfirmasi admin), (1-aktif invst/dikonfirmasi), (2-tdk aktif oleh inv), 4(tdk aktif krna gagal byr/cancle/expire), 5 (investasi sudah expire) --}}
    
            $date_awal = \Carbon\Carbon::parse($dateawal)->format('Y-m-d'). " 00:00:00";
            $date_akhir = \Carbon\Carbon::parse($dateakhir)->format('Y-m-d'). " 23:59:59";
    
            if ($jenislap == 0) {
                    //laporan pemasukkan
                    $detailTransInv = 
                    DB::table('header_invests')
                    ->select('header_invests.invest_id','users.name','header_invests.jumlah_invest','header_invests.jumlah_final','header_invests.status_transaction','header_invests.status_invest','header_invests.invest_expire','header_invests.created_at','header_products.name_product','sum(header_invests.jumlah_invest-header_invests.jumlah_final) as total')
                    ->join('users','users.id','=','header_invests.user_id')
                    ->join('header_products','header_products.id','=','header_invests.project_id')
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->where('header_invests.status_transaction', '=','settlement')
                    ->orderBy('header_invests.created_at')
                    ->get();

                    $get_pendapatan = 
                    DB::table('header_invests')
                    ->select(\DB::raw('SUM((jumlah_invest)-(jumlah_final)) as total_masuk'))
                    ->whereBetween('created_at', [$date_awal, $date_akhir])
                    ->where('status_transaction','=','settlement')
                    ->get();
                    
                    
                $pdf = PDF::loadview('admin.report.lap_Pemasukkan',['detailTransInv'=>$detailTransInv, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir, 'getPendapatan'=>$get_pendapatan]);
            }
        
            else if ($jenislap == 1) {
                    //laporan Transaksi investasi
                    $detailTransInv = 
                    DB::table('header_invests')
                    ->select('header_invests.invest_id','users.name','header_invests.jumlah_invest','header_invests.jumlah_final','header_invests.status_transaction','header_invests.status_invest','header_invests.invest_expire','header_invests.created_at','header_products.name_product')
                    ->join('users','users.id','=','header_invests.user_id')
                    ->join('header_products','header_products.id','=','header_invests.project_id')
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->orderBy('header_invests.created_at')
                    ->get();
                    
                    $pdf = PDF::loadview('admin.report.lap_TransInv',['detailTransInv'=>$detailTransInv, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir]);
                    $pdf->setPaper('A4', 'landscape');
            }
    
            else if ($jenislap == 2) {
                    //laporan Developer dan Startup Terbaik
                    $detailbestDev =
                    DB::table('reviews')
                    ->select('users.name','header_products.id','header_products.name_product', 
                    \DB::raw('round(avg(reviews.rating)) as rate, count(reviews.id) as ulasan'))
                    ->join('header_products','header_products.id','=','reviews.project_id')
                    ->join('users','users.id','=','header_products.user_id')
                    ->whereBetween('reviews.created_at', [$date_awal, $date_akhir])
                    ->groupBy('users.name','header_products.id','header_products.name_product')
                    ->orderBy('ulasan','desc')->orderBy('rate','desc')
                    ->get();
                    $pdf = PDF::loadview('admin.report.lap_BestDev',['detailbestDev'=>$detailbestDev, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir]);
            }
            
            else if ($jenislap == 3) {
                    //laporan Event Terdaftar
                    $detaiListEvent = 
                    DB::table('header_events')
                    ->select('users.email','users.name_company','header_events.id','header_events.name','header_events.event_schedule','header_events.event_time','header_events.held','header_events.link','header_events.province_name','header_events.city_name','header_events.status')
                    ->join('users','users.id','=','header_events.user_id')
                    ->whereBetween('header_events.created_at', [$date_awal, $date_akhir])
                    ->orderBy('header_events.created_at')
                    ->get();
                    $pdf = PDF::loadview('admin.report.lap_Event',['detaiListEvent'=>$detaiListEvent, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir]);
                    $pdf->setPaper('A4', 'landscape');
            }
    
            else if ($jenislap == 4) {
                    //laporan Penilaian Investasi
                    $detaiListRatingInv = 
                    DB::table('rating_invests')
                    ->join('header_invests','rating_invests.id_headerinvest','=','header_invests.id')
                    ->join('users', 'users.id','=','header_invests.user_id')
                    ->join('header_products', 'header_products.id','=','header_invests.project_id')
                    ->select('header_invests.id as id_Hinvest','rating_invests.id','users.name','users.name_company','rating_invests.rating','rating_invests.review', 'rating_invests.created_at', 'header_products.name_product')
                    ->whereBetween('header_invests.created_at', [$date_awal, $date_akhir])
                    ->orderBy('rating_invests.created_at','asc')
                    ->orderBy('rating_invests.rating','desc')
                    ->get();
    
                    $pdf = PDF::loadview('admin.report.lap_ReviewInv',['detaiListRatingInv'=>$detaiListRatingInv, 'dateawal'=>$dateawal, 'dateakhir'=>$dateakhir]);
                    $pdf->setPaper('A4', 'potrait');
            }
            
            
            return $pdf->stream();
        }


    public function downloadfile1($pathfile)
    {
        $filePath = public_path('/uploads/files/proposal/'.$pathfile);
        $headers = ['Content-Type: application/pdf'];
        $fileName = time().'.pdf';

        return response()->download($filePath, $fileName, $headers);

    }

    public function downloadfile2($pathfile)
    {
        $filePath = public_path('/uploads/files/contracts/'.$pathfile);
        $headers = ['Content-Type: application/pdf'];
        $fileName = time().'.pdf';

        return response()->download($filePath, $fileName, $headers);

    }
    
}
