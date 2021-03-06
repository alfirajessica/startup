<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use DataTables;
use App\Models\User;
use App\Models\CategoryProduct;
use App\Models\detailCategoryProduct;
use App\Models\HeaderProduct;
use App\Models\NotConfirmProduct;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('admin.dashboard');
    }

    public function akun(){
        return view('admin.akun');
    }

    // public function typeTrans()
    // {
    //     $type_trans['type_trans'] = DB::table('type_trans')->get();
    //     return view('admin.typeTrans',$type_trans);
    // }

    

    //DEVELOPER
    public function listdev(Request $request){

        //$list_dev = User::all();
        $list_dev = DB::table('users')
                    ->where('role', '=', 1)
                    ->get();
        if($request->ajax()){
            return datatables()->of($list_dev)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailDev" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailDev">Detail</a>';

                    $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Nonaktifkan</a>';

                    return $btn;

                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('admin.dev.listDev');
    }

    public function produkdev(){
        return view('admin.dev.produkDev');
    }

    public function listProductDev(Request $req)
    {
        $list_project = 
        DB::table('header_products')
        ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
        ->join('users', 'users.id','=','header_products.user_id')
        ->select('header_products.id','header_products.name_product','detail_category_products.name', 'users.email', 'header_products.status')
        ->where('header_products.status','=','0')
        ->orwhere('header_products.status','=','4')
        ->get();

        if($req->ajax()){
            return datatables()->of($list_project)
                ->addColumn('action', function($data){
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="table_listProductConfirmYet">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.dev.listProductDev');
    }

    public function detailDev($id, Request $req)
    {
        if($req->ajax()){
            
            //semua produk terdaftar pada developer dengan id tsb
            $list_proyek0 = DB::table('header_products')
                ->select('header_products.id','header_products.name_product','header_products.status','header_products.created_at')
                ->where('header_products.user_id','=',$id)
                ->whereBetween('header_products.status',[1,3])
                ->get();

                return datatables()->of($list_proyek0)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

        }
    }

    public function detailProject($id)
    {
         $HeaderProduct = HeaderProduct::find($id);
         return response()->json($HeaderProduct);
    }

    public function getDetailKategori($id)
    {
        $DHeaderProduct = DB::table('detail_category_products')
        ->select('category_products.name_category','detail_category_products.name')
        ->join('category_products','category_products.id','=','detail_category_products.category_id')
        ->where('detail_category_products.id','=',$id)
        ->get();
        return response()->json($DHeaderProduct);
    }

    public function getDetailSubStartupTag($id)
    {
        $DHeaderProduct = DB::table('sub_startup_tags')
        ->select('h_startup_tags.name_startup_tag','sub_startup_tags.name_subtag')
        ->join('h_startup_tags','h_startup_tags.id','=','sub_startup_tags.startuptag_id')
        ->where('sub_startup_tags.id','=',$id)
        ->get();
        return response()->json($DHeaderProduct);
    }

    public function confirmProject($id)
    {
        DB::table('header_products')->
        where('id',$id)->
        update([
            'status' => '1',
        ]);
        return response()->json(['success'=>"Berhasil mengaktifkan", 'tr'=>'tr_'.$id]);
    }

    public function notConfirmProject(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'reason_tdkdikonfirmasi'=>'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else
        {
            
            $isExist = NotConfirmProduct::where('id_headerproduct', '=',$req->productID)->first();

            if (NotConfirmProduct::where('id_headerproduct', '=',$req->productID)->exists()) {
                DB::table('not_confirm_products')->
                where('id_headerproduct',$req->productID)->
                update([
                    'reason' => $req->reason_tdkdikonfirmasi,
                ]);
            }

            else if ($isExist == null)
            {
                $newNotConfirmProduct = new NotConfirmProduct;
                $newNotConfirmProduct->id_headerproduct = $req->productID;             
                $newNotConfirmProduct->reason = $req->reason_tdkdikonfirmasi;
                $query = $newNotConfirmProduct->save();
            }

            DB::table('header_products')->
            where('id',$req->productID)->
            update([
                'status' => '4',
            ]);
            return 1;
        }
    }

    public function allListProduct(Request $req)
    {
        $list_project = 
        DB::table('header_products')
        ->select('header_products.id','header_products.user_id','header_products.name_product','header_products.status','users.name','users.email')
        ->join('users','users.id','=','header_products.user_id')
        ->where('status','!=','0')
        ->where('status','!=','4')
        ->get();

        if($req->ajax()){
            return datatables()->of($list_project)
                ->addColumn('action', function($data){
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.dev.allListProduct');
    }

    /*public function allproduct(Request $req)
    {
        $list_project = 
        DB::table('header_products')
        ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
        ->join('users', 'users.id','=','header_products.user_id')
        ->select('header_products.id','header_products.name_product','detail_category_products.name', 'users.email')
        ->where('header_products.status','=','0')
        ->get();

        if($req->ajax()){
            return datatables()->of($list_project)
                ->addColumn('action', function($data){
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-info btn-sm detailProject">Detail</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Confirm" class="btn btn-danger btn-sm confirmProject" data-tr="tr_{{$product->id}}">Confirm</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="notConfirm" class="btn btn-danger btn-sm notConfirmProject" data-tr="tr_{{$product->id}}">Tidak Dikonfirmasi</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
       return view('admin.dev.allListProduct');
    }*/

    public function detailProjectTerdata($id, Request $req)
    {
        $list_inv = 
        DB::table('header_invests')
        ->leftJoin('users', 'users.id', '=', 'header_invests.user_id')
        ->select('header_invests.id','users.name','header_invests.invest_id','header_invests.jumlah_final','header_invests.status_invest','header_invests.invest_expire')
        ->where('header_invests.project_id','=',$id)
        ->get();

        if($req->ajax()){
            return datatables()->of($list_inv)
                ->addColumn('action', function($data){
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-info btn-sm detailProject">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }


    //INVESTOR
    public function listinv(Request $req){
        //$list_inv = User::all();
        $list_inv = DB::table('users')
                    ->where('role', '=', 2)
                    ->get();
        if($req->ajax()){
            return datatables()->of($list_inv)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailDev" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailDev">Detail</a>';

                    $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Nonaktifkan</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.inv.listInv');
    }

    public function transaksiInv(Request $req){
        $list_invest = 
        DB::table('header_invests')
        ->where('status_transaction','=','settlement')
        ->where('status_invest','=','0')
        ->get();

        if($req->ajax()){
            return datatables()->of($list_invest)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Confirm" class="btn btn-success btn-sm confirmInvest" data-tr="tr_{{$product->id}}">Confirm</a>';

                    // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="notConfirm" class="btn btn-danger btn-sm notConfirmInvest" data-tr="tr_{{$product->id}}">Tidak Dikonfirmasi</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.inv.transaksiInv');
    }

    public function confirmInvest($id)
    {
        DB::table('header_invests')->
        where('id',$id)->
        update([
            'status_invest' => '1',
        ]);
        return response()->json(['success'=>"Berhasil mengaktifkan", 'tr'=>'tr_'.$id]);
    }

    public function notConfirmInvest($id)
    {
        DB::table('header_invests')->
        where('id',$id)->
        update([
            'status_invest' => '0',
        ]);
        return response()->json(['success'=>"Berhasil menonaktifkan", 'tr'=>'tr_'.$id]);
    }

    //Admin - laporan
    public function report()
    {
        return view('admin.laporan');
    }


    public function get_allReasonTdkDikonfirmasi($id)
    {
        $notConfirmProduct = NotConfirmProduct::where('id_headerproduct','=',$id)->get();
        return response()->json($notConfirmProduct);
    }

    public function detailProjectKas(Request $req, $id)
    {
        if($req->ajax()){

            if ($req->getTabel == "#table_listInv") {
                $list_inv = DB::table('header_invests')
                        ->leftJoin('users', 'users.id', '=', 'header_invests.user_id')
                        ->select('header_invests.id','users.name','header_invests.invest_id','header_invests.jumlah_final','header_invests.status_invest','header_invests.invest_expire')
                        ->where('header_invests.project_id','=',$id)
                        ->get();
           
                return datatables()->of($list_inv)
                        ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas" style="text-transform: none">Ubah</a>';
                        return $btn;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
            }
            
            
            if ($req->getTabel == "#table_pemasukkan") {
                $list_kas0 = DB::table('detail_product_kas')
                        ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                        ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                        ->where('detail_product_kas.id_headerproduct','=',$id)
                        ->where('detail_product_kas.tipe','=','1')
                        ->get();
           
                return datatables()->of($list_kas0)
                        ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas" style="text-transform: none">Ubah</a>';
                        return $btn;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
            }

            if ($req->getTabel == "#table_pengeluaran") {
                $list_kas = DB::table('detail_product_kas')
                        ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                        ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                        ->where('detail_product_kas.id_headerproduct','=',$id)
                        ->where('detail_product_kas.tipe','!=','1')
                        ->get();
           
                return datatables()->of($list_kas)
                        ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas" style="text-transform: none">Ubah</a>';
                        return $btn;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
            }

            
        }
    }

}
