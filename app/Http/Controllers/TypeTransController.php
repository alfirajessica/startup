<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;
use App\Models\User;
use App\Models\typeTrans;

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
        return view('admin.typeTrans');
    }

    public function addNewtypeTrans(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'tipe'=>'required',
            'keterangan'=>'required',
        ]);

        if (!$validator->passes()) {
            $re = 0;
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $ket = ucwords(strtolower($req->keterangan));

            $isExist = TypeTrans::where('keterangan','=', $ket)->first();
        
            if (TypeTrans::where('keterangan','=', $ket)->exists()) //available
            {
                return response()->json(['status'=>-1, 'msg'=>' telah tersedia']);
            }
            if ($isExist == null) {
                $tipe = new TypeTrans;
                $tipe->tipe = $req->tipe;
                $tipe->keterangan = $ket;
                $tipe->status = "1";
                $query = $tipe->save();
        
                if ($query) {
                    return response()->json(['status'=>1, 'msg'=>'berhasil ditambahkan']);
                }
            }
           
        }
    }

    public function editTypeTrans($id)
    {
        $type_trans = TypeTrans::find($id);
        return response()->json($type_trans);
    }

    public function updateTypeTrans(Request $req){

        $ket = ucwords(strtolower($req->edit_type_ket));
       

        $isExist = TypeTrans::where('keterangan','=', $ket)->first();

        if (TypeTrans::where('keterangan','=', $ket)->exists()) //available
        {
            return response()->json(['status'=>-1, 'msg'=>' telah tersedia']);
        }
        if ($isExist == null) {
            DB::table('type_trans')->where('id',$req->edit_type_ID)->update([
                'keterangan' => $ket,
                ]);

                return response()->json(['status'=>1, 'msg'=>'update']);
        }
    }

}
