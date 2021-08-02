<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use DataTables;
use App\Models\User;
use App\Models\HStartupTag;
use App\Models\SubStartupTag;
use App\Models\HeaderProduct;


class StartupTagController extends Controller
{
    //
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
    public function startupTags(Request $request){
        $type_trans = DB::table('h_startup_tags')->get();
        if($request->ajax()){
            return datatables()->of($type_trans)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#editHStartupTags"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editHStartupTag">Ubah</a>';
                    
                    $btn = $btn. '<a href="javascript:void(0)" data-toggle="modal" data-target="#subStartupTag"  data-id="'.$data->id.'" data-text="'.$data->name_startup_tag.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailHStartupTag">Tampilkan Sub-Tag</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.startuptag.hstartuptag');
    }

    public function addNewHStartupTag(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'h_StartupTagName'=>'required',
        ]);

        if (!$validator->passes()) {
            //return 0;
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $isExist = HStartupTag::where('name_startup_tag','=', $req->h_StartupTagName)->first();
        
            if (HStartupTag::where('name_startup_tag','=', $req->h_StartupTagName)->exists()) //available
            {
                return -1;
            }
            if ($isExist == null) {
                $category = new HStartupTag;
                $category->name_startup_tag = ucfirst($req->h_StartupTagName);
                $category->status = "1";
                $query = $category->save();
        
                if ($query) {
                    return 1;
                }
            }
           
        }
    }

    public function editHStartupTag($id)
    {
        $hStartupTags = HStartupTag::find($id);
        return response()->json($hStartupTags);
    }

    public function updateHStartupTag(Request $req){

        $validator = Validator::make($req->all(),[
            'edit_HStartupTag'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            DB::table('h_startup_tags')->where('id',$req->edit_HStartupTagID)->update([
                'name_startup_tag' => $req->edit_HStartupTag,
                ]);
           return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah kategori']);
        }
        
    }

    public function showSubStartupTag(Request $request, $id){

        $list_SubStartupTag = DB::table('sub_startup_tags')->where('startuptag_id', '=', $id)->get();
        if($request->ajax()){
            return datatables()->of($list_SubStartupTag)
                ->addColumn('action', function($data){
                    $btn = '';
                    // $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDetailKategori" data-tr="tr_{{$product->id}}">Nonaktifkan</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.startuptag.hstartuptag');
    }

    public function addNewSubStartupTag(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'sub_nameStartupTag'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $isExist = SubStartupTag::where('name_subtag','=', $req->sub_nameStartupTag)->first();

            if (SubStartupTag::where('name_subtag','=', $req->sub_nameStartupTag)->exists()) //available
            {
                return response()->json(['status'=>-1, 'msg'=>'Sub Tag telah tersedia']);
            }
            if ($isExist == null) {
                $subStartupTag = new SubStartupTag;
                $subStartupTag->startuptag_id = $req->hStartupID;
                $subStartupTag->name_subtag = ucfirst($req->sub_nameStartupTag);
                $subStartupTag->status = "1";
                $query = $subStartupTag->save();
        
                if ($query) {
                    return response()->json(['status'=>1, 'msg'=>'Sub Tag baru berhasil ditambahkan']);
                }
            }
            
        }
    }

    public function nonAktifHStartupTag($id)
    {
        //cek apakah id kategori ini digunakan oleh detail-category
        $isExist = SubStartupTag::where('startuptag_id','=',$id)->where('status','=','1')->first();
        if (SubStartupTag::where('startuptag_id','=',$id)->where('status','=','1')->exists()) //available
        { 
            return 0;
        }
        if ($isExist == null)
        {
            DB::table('h_startup_tags')->
            where('id',$id)->
            update([
                'status' => "0",
            ]);
            return response()->json(['success'=>"Berhasil nonaktifkan tag", 'tr'=>'tr_'.$id]);
        } 
    }

    public function aktifHStartupTag($id)
    {
        DB::table('h_startup_tags')->
            where('id',$id)->
            update([
                'status' => "1",
            ]);
        return 1;
    }

    public function nonAktifSubStartupTag($id)
    {
        //cek dipakai atau tdk di headerproduct
        $isExist = HeaderProduct::where('id_substartuptag','=',$id)->first();
        if (HeaderProduct::where('id_substartuptag','=',$id)->exists()) //available
        { 
            return 0;
        }
        if ($isExist == null)
        {
            DB::table('sub_startup_tags')->
            where('id',$id)->
            update([
                'status' => "0",
            ]);
            return 1;
        } 
    }

    public function aktifSubStartupTag($id)
    {
        DB::table('sub_startup_tags')->
            where('id',$id)->
            update([
                'status' => "1",
            ]);
        return 1;
    }

}
