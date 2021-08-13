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
use App\Models\HeaderInvest;
use App\Models\HeaderEvent;
use App\Models\NotConfirmProduct;
use Carbon\Carbon;

class AdminController extends Controller
{
    public $MIDTRANS_SERVER_KEY = 'SB-Mid-server-prYkvSccGV27NceSR_YIgIQo';
    protected $API_KEY = 'b987431dcecfd64bc6a193cdce1ff0bd';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $this->MIDTRANS_SERVER_KEY;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $try_month['try_month'] = 
        DB::table('header_invests')
        ->select(\DB::raw('DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();

        $get_pendapatan['get_pendapatan'] = 
        DB::table('header_invests')
        ->select(\DB::raw('DATE_FORMAT(created_at,"%Y-%m") as monthDate, sum(jumlah_invest-jumlah_final) as total '))
        ->where('status_transaction','=','settlement')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();

        $inv_gagal['inv_gagal'] = 
        DB::table('header_invests')
        ->select(\DB::raw('COUNT(id) as totalinv_gagal, DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('status_transaction','=','cancel')
        ->orWhere('status_transaction','=','expire')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();

        $inv_sukses['inv_sukses'] = 
        DB::table('header_invests')
        ->select(\DB::raw('COUNT(id) as totalinv_sukses, DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('status_transaction','=','settlement')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();

        $inv_expire['inv_expire'] = 
        DB::table('header_invests')
        ->select(\DB::raw('COUNT(id) as totalinv_expire, DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('status_transaction','=','expire')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();
        
        $count_inv['count_inv'] = 
        DB::table('users')
        ->select(\DB::raw('COUNT(id) as totalinv'))
        ->where('role','=','2')
        ->get();

        $count_dev['count_dev'] = 
        DB::table('users')
        ->select(\DB::raw('COUNT(id) as totaldev'))
        ->where('role','=','1')
        ->get();

        $count_startup['count_startup'] = 
        DB::table('header_products')
        ->select(\DB::raw('COUNT(id) as totalstartup'))
        ->get();

        $count_event['count_event'] = 
        DB::table('header_events')
        ->select(\DB::raw('COUNT(id) as totalevent'))
        ->get();

        return view('admin.dashboard')->with($inv_gagal)->with($inv_sukses)->with($inv_expire)->with($count_inv)->with($count_dev)->with($count_startup)->with($count_event)->with($try_month)->with($get_pendapatan);
    }

    public function akun(){

        $user = auth()->user();
        $detail_admin['detail_admin'] = DB::table('admins')
                    ->where('id', '=', $user->id)
                    ->get();

        return view('admin.akun')->with($detail_admin);
    }

    public function akunUpdate(Request $req)
    {
        $user = auth()->user();

        //validate request
        $validator = Validator::make($req->all(),[
            'nama_admin'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            DB::table('admins')->
            where('id',$user->id)->
            update([
                'name' => $req->nama_admin,
            ]);
            
            return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah profil']);
        }
        

       
    }

    //DEVELOPER
    public function listdev(Request $request){

        //$list_dev = User::all();
        $list_dev = DB::table('users')
                    ->where('role', '=', 1)
                    ->get();
        if($request->ajax()){
            return datatables()->of($list_dev)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailDev" data-id="'.$data->id.'" data-text="'.$data->name.'/'.$data->email.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailDev">Detail</a>';

                    // $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Nonaktifkan</a>';

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
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailInv" data-id="'.$data->id.'" data-text="'.$data->name.'/'.$data->email.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailInv">Detail</a>';

                    // $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Nonaktifkan</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.inv.listInv');
    }

    public function detailInv($id, Request $req)
    {
        if($req->ajax()){
            
            //semua produk terdaftar pada developer dengan id tsb
            $list_proyek = DB::table('header_invests')
                ->select('header_invests.id', 'header_invests.invest_id','header_invests.jumlah_invest','header_invests.status_invest','header_invests.created_at','header_products.name_product')
                ->join('header_products','header_products.id','=','header_invests.project_id')
                ->where('header_invests.user_id','=',$id)
                ->get();

                return datatables()->of($list_proyek)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

        }
    }

    public function transaksiInv(Request $req){
        $list_invest = 
        DB::table('header_invests')
        // ->where('status_transaction','=','settlement')
        // ->where('status_invest','=','0')
        ->orderBy('status_invest', 'asc')
        ->get();

        if($req->ajax()){
            return datatables()->of($list_invest)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

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

    public function detailInvest($id)
    {

        $data = HeaderInvest::find($id);
        $investID = $data->invest_id;
        $projectID = $data->project_id;
       
        
        //get status dari midtrans berdasarkan order_id nya
        $status = \Midtrans\Transaction::status($investID);
        $status = json_decode(json_encode($status),true);

        return response()->json($status);

    }

    public function detailStatusInvest($id)
    {
        $data = HeaderInvest::find($id);
        $statusInvest = $data->status_invest;

        return response()->json($data);
    }

    public function projectdetailInvest(Request $req, $id)
    {
        $data = HeaderInvest::find($id);
        $projectID = $data->project_id;

        $detail = DB::table('header_products')
                    ->leftJoin('detail_category_products', 'detail_category_products.id','=','header_products.id_detailcategory')
                    ->leftJoin('header_invests','header_invests.project_id','=','header_products.id')
                    ->leftJoin('users','users.id','=','header_invests.user_id')
                    ->select('header_invests.id','header_products.id as idproduk','header_products.name_product','detail_category_products.name','header_invests.jumlah_invest', 'users.name as nama_inv', 'users.email','header_invests.invest_id')
                    ->where('header_products.id', '=', $projectID)
                    ->where('header_invests.id','=',$id)
                    ->get();
        if($req->ajax()){
            return datatables()->of($detail)
                    ->addColumn('action', function($data){
                         $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                         $button .= '&nbsp;&nbsp;';
                         $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                         return $button;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        
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
                        ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','detail_product_kas.tanggal','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
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
                        ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','detail_product_kas.tanggal','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
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


    //check event if has passed
    public function event_haspassed()
    {
        //get date now
        $date = Carbon::now();

        //update status yang ada di header_events
        $list_event = DB::table('header_events')
                    ->where('event_schedule','<=',$date->toDateString())
                    ->update([
                        'status' =>'2',
                    ]);
        
        $data = HeaderEvent::where('status','=','2')->get()->toArray();
        
        $upd_details = DB::table('detail_events')
                        ->where('status','=','1')
                        ->where(function ($query) use($data)
                        {
                            for ($i=0; $i <count($data) ; $i++) { 
                                $query->orwhere('id_header_events','=', $data[$i]['id']);
                            }
                        })
                        ->update([
                            'status' =>'2',
                        ]);
    }

    public function updStatusTrans()
    {
        $data = HeaderInvest::whereBetween('header_invests',[0,3])->get()->toArray();
        for ($i=0; $i < count($data); $i++) { 

            $status = \Midtrans\Transaction::status($data[$i]['invest_id']);
            $status = json_decode(json_encode($status),true);

            if ($status['transaction_status'] == "cancel" || $status['transaction_status'] == "expire") {
                DB::table('header_invests')->
                where('invest_id','=',$data[$i]['invest_id'])->
                update([
                    'status_transaction' => $status['transaction_status'],
                    'status_invest' => '4'
                ]);

                 DB::table('header_products')
                 ->leftJoin('header_invests','header_invests.project_id','=','header_products.id')
                 ->where('header_invests.invest_id','=',$data[$i]['invest_id'])
                 ->update([
                     'header_products.status' => '1',
                 ]);
            }
            //harusnya cek status dulu status investnya dan status transaction
            else{
                //jika pending dan settlement, masih menunggu admin konfirmasi
                DB::table('header_invests')->
                where('invest_id','=',$data[$i]['invest_id'])->
                update([
                    'status_transaction' => $status['transaction_status'],
                ]);

                DB::table('header_products')
                ->leftJoin('header_invests','header_invests.project_id','=','header_products.id')
                ->where('header_invests.invest_id','=',$data[$i]['invest_id'])
                ->where('header_invests.status_transaction','=','pending')
                ->orwhere('header_invests.status_transaction','=','settlement')
                ->where('header_invests.status_invest','!=','5')
                ->update([
                    'header_products.status' => '2',
                ]);
            }
   
        }
   
        
    }

    //ubah status_invest di tabel header invest menjadi 5 --> investasi telah berakhir/finished/sesuai waktu kontrak
    public function invest_haspassed(Request $req)
    {
        $date = Carbon::now();
        
        //cek yang status investnya 1 (aktif)
        //ubah status invest jadi 5 kalau expire
       
        $data = HeaderInvest::where('status_invest','=','1')->get()->toArray();
        
        for ($i=0; $i < count($data); $i++) { 
            DB::table('header_invests')
            ->where('id','=',$data[$i]['id'])
            ->where('invest_expire','<',$date->toDateString())
            ->update([
                'status_invest' =>'5',
            ]);

            DB::table('header_products')
            ->leftJoin('header_invests','header_invests.project_id','=','header_products.id')
            ->where('header_invests.invest_id','=',$data[$i]['invest_id'])
            ->where('header_invests.status_transaction','=','settlement')
            ->where('header_invests.status_invest','=','5')
            ->update([
                'header_products.status' => '1',
            ]);
        }

        //cek yang status investnya 5 (expire)
        //ubah status product jadi 1 (Aktif)
        // $data2 = HeaderInvest::where('status_invest','=','5')->where('status_transaction','=','settlement')->get()->toArray();
        // for ($i=0; $i < count($data2); $i++) { 
        //     DB::table('header_products')
        //     ->where('id','=',$data2[$i]['project_id'])
        //     ->update([
        //         'status' =>'1',
        //     ]);
        // }
    }

}
