<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\HeaderEvent;
use App\Models\User;
use App\Models\DetailUser;
use App\Models\CategoryProduct;
use App\Models\DetailProductKas;
use App\Models\detailCategoryProduct;


class InvController extends Controller
{
    protected $API_KEY = 'b987431dcecfd64bc6a193cdce1ff0bd';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /*public function event()
    {
        //get Province
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces['provinces']= $response['rajaongkir']['results'];  
        return view('investor.event', $provinces);
       
    }



    public function getCities($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province='.$id.'');

        $cities = $response['rajaongkir']['results'];
        return response()->json($cities);
       // return view('investor.event', $cities);
    }

    public function buatEvent(Request $req){

        $user = auth()->user();

        //validate request
        $validator = Validator::make($req->all(),[
            'nama_event'=>'required',
            'desc_event'=>'required',
            'event_held'=>'required|not_in:0',
            'jadwal_event'=>'required|date',
            'time_event'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $event = new HeaderEvent;
            $event->user_id = $user->id;
            $event->name = ucfirst($req->nama_event);
            $event->desc = ucfirst($req->desc_event);
            $event->held = ucfirst($req->event_held);

            if ($event->held == "Offline") {
                $validator = Validator::make($req->all(),[
                    'provinsi_event'=>'required|not_in:0',
                    'kota_event'=>'required|not_in:0',
                    'address_event'=>'required',
                    
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    //if offline
                    $event->province = $req->provinsi_event;
                    $event->city = $req->kota_event;
                    $event->address = $req->address_event;
                }
            }
            else if ($event->held == "Online") {
                $validator = Validator::make($req->all(),[
                    'link_event'=>'required',
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    //if online
                    $event->link = $req->link_event;
                }
            }
        
            $event->event_schedule = $req->jadwal_event;
            $event->event_time = $req->time_event;

            //store image
            if ($req->hasfile('image')) {
                $file = $req->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = $req->nama_event.$req->jadwal_event.'.'.$extension;
                $file->move('uploads/event/', $filename);
                $event->image = $filename;
            }else{
                return $req;
                $highligts->image = '';
            }
            $event->image = $filename;
            $event->status = "1";
            $query = $event->save();

            if ($query) {
                return response()->json(['status'=>1, 'msg'=>'Event baru berhasil ditambahkan']);
            }
        }

    }

    public function listEvent(Request $req){

        $user = auth()->user();
        
        $list_dev = DB::table('header_events')
                    ->where('user_id', '=', $user->id)
                    ->get();
        if($req->ajax()){
            return datatables()->of($list_dev)
                    // ->addColumn('action', function($data){
                    //     $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                    //     $button .= '&nbsp;&nbsp;';
                    //     $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                    //     return $button;
                    // })
                    // ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('inv.listEvent');
    }*/



    public function startup()
    {
        $list_category['list_category'] = DB::table('category_products')->get();
        $list_project['list_project'] = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc')
        ->paginate(6);
        //return view('investor.startup', $list_category);
        return view('investor.startup')->with($list_category)->with($list_project);
    }

    public function detailstartup(Request $req, $id){

        /*(SELECT created_at, id, SUM(jumlah) as jumlah1
        FROM detail_product_kas WHERE tipe='1' AND id_headerproduct=10)
        UNION
        (SELECT created_at, id, SUM(jumlah) as jumlah2
        FROM detail_product_kas WHERE tipe='2' AND id_headerproduct=10)*/

        $list_project['list_project'] = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url', 'header_products.rilis','header_products.team','header_products.reason','header_products.benefit','header_products.solution')
        ->where('header_products.id','=',$id)
        ->get();

        $list_finance['list_finance'] = 
        DB::table('detail_product_kas')
        ->select(\DB::raw('SUM(jumlah) as total_masuk,DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('id_headerproduct','=',$id)
        ->where('tipe','=','1')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at' )
        ->get();
        

        $list_finance_keluar['list_finance_keluar'] = 
        DB::table('detail_product_kas')
        ->select(\DB::raw('SUM(jumlah) as total_keluar,DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('id_headerproduct','=',$id)
        ->where('tipe','=','2')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('detail_product_kas.created_at')
        ->get();

        $user = auth()->user();
        $detail_user['detail_user'] = DB::table('users')->where('id','=',$user->id)->get();

       
        return view('investor.detailstartup')->with($list_project)->with($detail_user)->with($list_finance)->with($list_finance_keluar);
    }

    /*public function listFinance(Request $req, $id)
    {
        $list_finance = 
        DB::table('detail_product_kas')
        ->select('id', \DB::raw('SUM(jumlah) as total_masuk,DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('id_headerproduct','=',$id)
        ->where('tipe','=','1')
        ->groupBy('id', \DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();

        if($req->ajax()){
            return datatables()->of($list_finance)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('inv.detailstartup.financial');
    }*/

    public function detail_category_filter($id)
    {
        $list_detailcategory['list_detailcategory'] = DB::table('detail_category_products')->where('category_id', '=', $id)->get();
        return $list_detailcategory;
        
    }

   

    

    public function akun()
    {
        $user = auth()->user();
        
        //headernya
        $akun_user['akun_user'] = DB::table('users')
                    ->leftJoin('detail_users', 'users.id', '=', 'detail_users.id_user')
                    ->where('users.id', '=', $user->id)
                    ->get();

        //get Province
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces['provinces']= $response['rajaongkir']['results']; 

        //return view('developer.akun')->with($akun_user)->with($provinces);

        return view('investor.akun')->with($akun_user)->with($provinces);
    }

    public function invest()
    {
        return view('investor.invest');
    }
}
