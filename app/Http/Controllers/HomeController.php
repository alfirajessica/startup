<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\HeaderEvent;
use App\Models\HeaderInvest;
use App\Models\User;
use App\Models\DetailUser;
use Carbon\Carbon;

class HomeController extends Controller
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
        $this->middleware('auth');
        // $this->middleware('guest');
        // $this->middleware('guest:admin');

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
        
        $user_role = auth()->user()->role;
        //dd($user_role);

        //developer
        if ($user_role == "1") {
            $header_events['header_events'] = DB::table("header_events")
                   ->whereDate('created_at', '>', Carbon::now()->subDays(30))
                   ->get();
            return view('developer.home', $header_events); 
        }
        //investor
        else if ($user_role == "2") {
            
             $get_id = DB::table('header_events')->select('id')->where('status','=','2')->get();
        
            return view('investor.home'); 
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
        
        $data = HeaderInvest::where('status_invest','!=','4')->get()->toArray();
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
            else{
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
                ->update([
                    'header_products.status' => '2',
                ]);
            }
   
        }
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
                    ->leftJoin('users','users.id','=','header_products.user_id')
                    ->select('header_products.id','header_products.name_product','detail_category_products.name','header_invests.jumlah_invest', 'users.name as nama_dev', 'users.email')
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

    
    
    //jika investor meng-cancle investasi/Batal Invest pada saat transaksi investasi masih berstatus "Pending"
    //status product dikembalikan menjadi 0
    public function cancleInvest($id)
    {
         //get invest idnya
        $data = HeaderInvest::find($id);
        $investID = $data->invest_id;
        
        $cancel = \Midtrans\Transaction::cancel($investID);

        return $cancel;
        
    }

    //ubah status_invest di tabel header invest menjadi 5 --> investasi telah berakhir/finished/sesuai waktu kontrak
    public function invest_haspassed(Request $req)
    {
        $date = Carbon::now();
        //dd($date->toDateString());

        $data = HeaderInvest::where('status_invest','=','1')->get()->toArray();
        
        $upd_headerInv = DB::table('header_invests')
                        ->where(function ($query) use($data)
                        {
                            for ($i=0; $i <count($data) ; $i++) { 
                                $query->orwhere('id','=', $data[$i]['id']);
                            }
                        })
                        ->where('invest_expire','<',$date->toDateString())
                        ->update([
                            'status_invest' =>'5',
                        ]);
        
    }

    
    //akun
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

        $user_role = auth()->user()->role;
        //developer
        if ($user_role == "1") {
            return view('developer.akun')->with($akun_user)->with($provinces);
        }
        //investor
        else if ($user_role == "2") {
            return view('investor.akun')->with($akun_user)->with($provinces);
        }
        
    }

    public function detailProfil()
    {
        $user = auth()->user();
        $akun_user = User::find($user->id);

        return response()->json($akun_user);
    }

    public function updateAkun(Request $req)
    {
        $user = auth()->user();

        //validate request
        $validator = Validator::make($req->all(),[
            'nama_akunUser'=>'required',
            'edit_provinsi_user'=>'required',
            'edit_kota_user'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            DB::table('users')->
                where('id',$user->id)->
                update([
                    'name' =>$req->nama_akunUser,
                    'id_province' => $req->edit_provinsi_user,
                    'id_city' => $req->edit_kota_user,
                    'province_name' => $req->hidden_province_name,
                    'city_name' => $req->hidden_city_name,
                ]);

                //return back()->with('status', 'Berhasil join Event kembali');
                return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah profil']);
        }
        
    }

    public function updateTentang(Request $req)
    {
        $user = auth()->user();
        $validator = Validator::make($req->all(),[
            'desc'=>'required',
            'team'=>'required',
            'benefit'=>'required',
            'target'=>'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $isExist = DetailUser::where('id_user', '=', $user->id)->first();

            if (DetailUser::where('id_user', '=', $user->id)->exists()) {
                DB::table('detail_users')->
                where('id_user',$user->id)->
                update([
                    'desc' =>ucfirst($req->desc),
                    'team' => ucfirst($req->team),
                    'benefit' => ucfirst($req->benefit),
                    'target' => ucfirst($req->target),
                    
                ]);

                return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah detail user tentang saya']);

            }elseif ($isExist == null) {
                $detailUser = new DetailUser;
                $detailUser->id_user = $user->id;
                $detailUser->desc = ucfirst($req->desc);
                $detailUser->team = ucfirst($req->team);
                $detailUser->benefit = ucfirst($req->benefit);
                $detailUser->target = ucfirst($req->target);

                $query = $detailUser->save();

                if ($query) {
                    return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah detail user']);
                }
            }

            
        }
        
    }
}
