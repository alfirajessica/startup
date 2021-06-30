<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use DataTables;
use App\Models\User;
use App\Models\TypeTrans;
use App\Models\DetailProductKas;

class TypeTransController extends Controller
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

    //kategori produk
    public function typeTrans(Request $request){
        $type_trans = DB::table('type_trans')->get();
        if($request->ajax()){
            return datatables()->of($type_trans)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#editModal"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editTypeTrans">Ubah</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.transaksi.typeTrans');
    }

    public function addNewtypeTrans(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'tipe'=>'required',
            'keterangan'=>'required',
        ]);

        if (!$validator->passes()) {
            //return 0;
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $isExist = TypeTrans::where('keterangan','=', ucwords(strtolower($req->keterangan)))->first();
        
            if (TypeTrans::where('keterangan','=', ucwords(strtolower($req->keterangan)))->exists()) //available
            {
                return -1;
                //return response()->json(['status'=>-1, 'msg'=>'Kategori telah tersedia']);
            }
            if ($isExist == null) {
                $tipe = new TypeTrans;
                $tipe->tipe = $req->tipe;
                $tipe->keterangan = ucwords(strtolower($req->keterangan));
                $tipe->status = "1";
                $query = $tipe->save();

                if ($query) {
                    return 1;
                    //return response()->json(['status'=>1, 'msg'=>'Kategori baru berhasil ditambahkan']);
                }
            }
           
        }
        return view('admin.transaksi.typeTrans');
    }

    public function editTypeTrans($id)
    {
        $type_trans = TypeTrans::find($id);
        return response()->json($type_trans);
    }

    public function updateTypeTrans(Request $req){

        $validator = Validator::make($req->all(),[
            'edit_type_ket'=>'required',
        ]);

        if (!$validator->passes()) {
            //return 0;
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $ket = ucwords(strtolower($req->edit_type_ket));
       
            $isExist = TypeTrans::where('keterangan','=', $ket)->first();
    
            if (TypeTrans::where('keterangan','=', $ket)->exists()) //available
            {
                return -1;
            }
            if ($isExist == null) {
                DB::table('type_trans')->where('id',$req->edit_type_ID)->update([
                    'keterangan' => $ket,
                    ]);

                    return 1;
            }
        }
        
    }

    public function nonAktifTypeTrans($id)
    {
        //cek dipakai atau tdk di headerproduct
        $isExist = DetailProductKas::where('id_typetrans','=',$id)->first();
        if (DetailProductKas::where('id_typetrans','=',$id)->exists()) //available
        { 
            return 0;
        }
        if ($isExist == null)
        {
            DB::table('type_trans')->
            where('id',$id)->
            update([
                'status' => "0",
            ]);
            return 1;
        } 
    }

    public function aktifTypeTrans($id)
    {
        DB::table('type_trans')->
            where('id',$id)->
            update([
                'status' => "1",
            ]);
            return 1;
    }
}
