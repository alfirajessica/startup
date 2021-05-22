<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DetailUser;
use Validator;
use Illuminate\Support\Facades\Http;

class DevController extends Controller
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
    public function product()
    {
        $user = auth()->user();
        $list_category['list_category'] = DB::table('category_products')->get();
        $type_trans['type_trans'] = DB::table('type_trans')->get();
        $list_project['list_project'] = DB::table('header_products')->where('user_id','=',$user->id)->get();

        
        return view('developer.product')->with($list_category)->with($type_trans)->with($list_project);
    }

    public function detail_category_filter($id)
    {
        $list_detailcategory['list_detailcategory'] = DB::table('detail_category_products')->where('category_id', '=', $id)->get();
        return $list_detailcategory;
        
    }

    //dipindahkan ke homecontroller
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

        return view('developer.akun')->with($akun_user)->with($provinces);
    }

    public function getCities($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province='.$id.'');

        $cities = $response['rajaongkir']['results'];
        return response()->json($cities);
       
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

                return back()->with('status', 'Berhasil join Event kembali');
                //return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah profil']);
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

    public function event(){
        return view('developer.event');
    }

    public function listJoinEvent(){
        return view('developer.listJoinEvent');
    }

    public function review()
    {
        return view('developer.review');
    }

    
}
