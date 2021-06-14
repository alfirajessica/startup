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
    public function cetak_keuanganStartup($id)
    {
        // $headerinvest = HeaderInvest::all();
        // $pdf = PDF::loadview('investor.report.cetak_keuanganStartup',['headerinvest' => $headerinvest]);
        // return $pdf->stream();

        $data = HeaderInvest::find($id);
        $projectID = $data->project_id;
        $date_inv_awal = $data->created_at->format('Y-m-01') ." 00:00:00";
        $date_inv_exp = \Carbon\Carbon::parse($data->invest_expire)->format('Y-m-01'). " 23:59:59";

        $list_kas = DB::table('detail_product_kas')
                ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                ->where('detail_product_kas.id_headerproduct','=',$projectID)
                ->whereBetween('detail_product_kas.created_at', [$date_inv_awal, $date_inv_exp])
                ->orderBy('detail_product_kas.created_at','asc')
                ->get();


        $table_pemasukkan_inv = 
                DB::table('detail_product_kas')
                ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_masuk'))
                ->where('detail_product_kas.id_headerproduct','=',$projectID)
                ->whereBetween('detail_product_kas.created_at', [$date_inv_awal, $date_inv_exp])
                ->where('detail_product_kas.tipe','=','1')
                ->groupBy(\DB::raw('detail_product_kas.tipe'))
                ->orderBy('detail_product_kas.created_at','asc')
                ->get();

        $table_pengeluaran_inv = 
                DB::table('detail_product_kas')
                ->select(\DB::raw('SUM(detail_product_kas.jumlah) as total_keluar'))
                ->where('detail_product_kas.id_headerproduct','=',$projectID)
                ->whereBetween('detail_product_kas.created_at', [$date_inv_awal, $date_inv_exp])
                ->where('detail_product_kas.tipe','=','2')
                ->groupBy(\DB::raw('detail_product_kas.tipe'))
                ->orderBy('detail_product_kas.created_at','asc')
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
        return $pdf->stream();
    }
}
