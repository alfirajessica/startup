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
use Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addNewProduct(Request $req)
    {
        $user = auth()->user();
        $validator = Validator::make($req->all(),[
            'nama_produk'=>'required',
            'jenis_produk'=>'required',
            'detail_kategori'=>'required',
            'url'=>'required',
            'rilis'=>'required',
            'desc'=>'required',
            'team'=>'required',
            'reason'=>'required',
            'benefit'=>'required',
            'solution'=>'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            
            //save to db header_products
            $newProduct = new HeaderProduct;
            $newProduct->user_id = $user->id;
            $newProduct->name_product = ucfirst($req->nama_produk);
            $newProduct->id_detailcategory = $req->detail_kategori;
            $newProduct->url = $req->url;
            $newProduct->rilis = $req->rilis;

            //store image
            if ($req->hasfile('image')) {
                $file = $req->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = $req->nama_produk.$req->detail_kategori.'.'.$extension;
                $file->move('uploads/event/', $filename);
                $newProduct->image = $filename;
            }else{
                return $req;
                $highligts->image = '';
            }
            $newProduct->image = $filename;
            $newProduct->desc = ucfirst($req->desc);
            $newProduct->team = ucfirst($req->team);
            $newProduct->reason = ucfirst($req->reason);
            $newProduct->benefit = ucfirst($req->benefit);
            $newProduct->solution = ucfirst($req->solution);
            $newProduct->status = "1";  //aktif
            $query = $newProduct->save();

            if ($query) {
                return response()->json(['status'=>1, 'msg'=>'Berhasil menambah produk baru']);
            }
        }
    }

    public function listPemasukkan(Request $req, $id)
    {
        $list_kas = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$id)
                    ->where('detail_product_kas.tipe','=','1')
                    ->get();
       
        if($req->ajax()){
            return datatables()->of($list_kas)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKasMasuk" data-tr="tr_{{$product->id}}"
                    data-toggle="confirmation"
                    data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                    data-btn-ok-class="btn btn-sm btn-danger"
                    data-btn-cancel-label="Cancel"
                    data-btn-cancel-icon="fa fa-chevron-circle-left"
                    data-btn-cancel-class="btn btn-sm btn-default"
                    data-title="Are you sure you want to delete ?"
                    data-placement="left" data-singleton="true">Hapus</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dev.listPemasukkan');      
    }

    public function listPengeluaran(Request $req, $id)
    {
        $list_kas = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$id)
                    ->where('detail_product_kas.tipe','=','2')
                    ->get();
       
        if($req->ajax()){
            return datatables()->of($list_kas)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKasKeluar" data-tr="tr_{{$product->id}}"
                    data-toggle="confirmation"
                    data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                    data-btn-ok-class="btn btn-sm btn-danger"
                    data-btn-cancel-label="Cancel"
                    data-btn-cancel-icon="fa fa-chevron-circle-left"
                    data-btn-cancel-class="btn btn-sm btn-default"
                    data-title="Are you sure you want to delete ?"
                    data-placement="left" data-singleton="true">Hapus</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dev.listPengeluaran');      
    }

    public function listProject_select()
    {
        $user = auth()->user();
        $list_project = DB::table('header_products')
                    ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                    ->select('header_products.id','header_products.name_product','detail_category_products.name')
                    ->where('header_products.user_id','=',$user->id)
                    ->get();

        return response()->json($list_project);
    }

    public function listProduct(Request $req)
    {
        $user = auth()->user();
        $list_proyek = DB::table('header_products')
                    ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                    ->select('header_products.id','header_products.name_product','detail_category_products.name')
                    ->where('header_products.user_id','=',$user->id)
                    ->get();

        if($req->ajax()){
            return datatables()->of($list_proyek)
                ->addColumn('action', function($data){
                    $btn = '<a href="'.route("dev.listProduct.ubahProject").'" data-toggle="tooltip" data-target="#ubahProduct"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProject" data-tr="tr_{{$product->id}}">Hapus</a>';

                    $btn = $btn. ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-info btn-sm detailProject">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dev.listProduct');
    }

    public function deleteProject($id)
    {
        DB::table("header_products")->delete($id);
    	return response()->json(['success'=>"Berhasil menghapus kas", 'tr'=>'tr_'.$id]);
    }

    public function detailProject($id)
    {
       // return view('developer.product.detailProduct');
         $HeaderProduct = HeaderProduct::find($id);
         return response()->json($HeaderProduct);
    }

    public function detailProjectKas(Request $req, $id)
    {
        $list_kas = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$id)
                    ->get();
       
        if($req->ajax()){
            return datatables()->of($list_kas)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dev.listProduct');
    }
    
    public function addNewPemasukkan(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'jumlah'=>'required',
            'tipe_pemasukkan'=>'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            
            //cek apakah data yang sama pernah dimasukkan sebelumnya.
            //berdasarkan id_headerproduct, tipe, id_typetrans dan created_at

            $isExist = DetailProductKas::where('id_headerproduct', '=',$req->pilih_project_masuk)->where('id_typetrans', '=', $req->tipe_pemasukkan)->whereDate('created_at', Carbon::today())->first();

            //dd(Carbon::today());
            //dd($date->toDateString());
            if (DetailProductKas::where('id_headerproduct', '=',$req->pilih_project_masuk)->where('id_typetrans', '=', $req->tipe_pemasukkan)->whereDate('created_at', Carbon::today())->exists()) {
                return response()->json(['status'=>-1, 'msg'=>'sudah ada, silakan ubah']);
            }

            else if ($isExist == null)
            {
                //save to db detail_product_kas
                $newPemasukkan = new DetailProductKas;
                $newPemasukkan->id_headerproduct = $req->pilih_project_masuk;
                $newPemasukkan->tipe = "1";
                $newPemasukkan->id_typetrans = $req->tipe_pemasukkan;
                $newPemasukkan->jumlah = $req->jumlah;
                $newPemasukkan->status = "1";
                $query = $newPemasukkan->save();

                if ($query) {
                    return response()->json(['status'=>1, 'msg'=>'Berhasil menambah detail produk kas']);
                }
            }
        }
    }

    public function addNewPengeluaran(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'jumlah_keluar'=>'required',
            'tipe_pengeluaran'=>'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            
            $isExist = DetailProductKas::where('id_headerproduct', '=',$req->pilih_project_keluar)->where('id_typetrans', '=', $req->tipe_pengeluaran)->whereDate('created_at', Carbon::today())->first();

            //dd(Carbon::today());
            //dd($date->toDateString());
            if (DetailProductKas::where('id_headerproduct', '=',$req->pilih_project_keluar)->where('id_typetrans', '=', $req->tipe_pengeluaran)->whereDate('created_at', Carbon::today())->exists()) {
                return response()->json(['status'=>-1, 'msg'=>'sudah ada, silakan ubah']);
            }

            else if ($isExist == null)
            {
                //save to db detail_product_kas
                $newPengeluaran = new DetailProductKas;
                $newPengeluaran->id_headerproduct = $req->pilih_project_keluar;
                $newPengeluaran->tipe = "2";
                $newPengeluaran->id_typetrans = $req->tipe_pengeluaran;
                $newPengeluaran->jumlah = $req->jumlah_keluar;
                $newPengeluaran->status = "1";
                $query = $newPengeluaran->save();

                if ($query) {
                    return response()->json(['status'=>1, 'msg'=>'Berhasil menambah detail produk kas']);
                }
            }
            
        }
    }

    public function deletePemasukkan(Request $req, $id)
    {
        DB::table("detail_product_kas")->delete($id);
    	return response()->json(['success'=>"Berhasil menghapus kas masuk", 'tr'=>'tr_'.$id]);
    }

    public function deletePengeluaran(Request $req, $id)
    {
        DB::table("detail_product_kas")->delete($id);
    	return response()->json(['success'=>"Berhasil menghapus kas keluar", 'tr'=>'tr_'.$id]);
    }


    public function detailPemasukkan($id)
    {
        $DetailProductKas = DetailProductKas::find($id);
        return response()->json($DetailProductKas);
    }

    public function updatePemasukkan(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'edit_jumlah'=>'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else
        {
            DB::table('detail_product_kas')->
            where('id',$req->id_detail_product_kas)->
            update([
                'jumlah' => $req->edit_jumlah,
            ]);
           return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah detail product kas']);
        }
    }

    public function ubahProject()
    {
        $list_category['list_category'] = DB::table('category_products')->get();
        $type_trans['type_trans'] = DB::table('type_trans')->get();
        $list_project['list_project'] = DB::table('header_products')->get();

        
        return view('developer.ubahProduct')->with($list_category)->with($type_trans)->with($list_project);

        //return view('developer.product.ubahProduct');
    }

    public function startup()
    {
        $list_category['list_category'] = 
        DB::table('category_products')->get();

        $list_dtcategory['list_dtcategory'] = 
        DB::table('detail_category_products')->get();

        $list_project['list_project'] = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url')
        ->paginate(6);
       
        
        return view('investor.startup')->with($list_category)->with($list_project)->with($list_dtcategory);
    }

    //search di startup investor
    public function searchStartup(Request $req)
    {
        $list_category['list_category'] = DB::table('category_products')->get();
        $list_project['list_project'] = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc')
        ->where('header_products.name_product','=',$req->search_input)
        ->paginate(6);

        // $list_category['list_category'] = DB::table('category_products')->get();
        // $header_events['header_events'] = DB::table("header_events")->where('name','='.$req->search_input)->paginate(6);
        $output="";
      
    }

    //search
    public function getMoreUsers(Request $req) {
        
        $search = $req->search_query;
        $type = $req->typecategory_query;
       
        if($req->ajax()) {

            if ($type == "1") {
                $list_project['list_project'] = 
                    DB::table('header_products')
                    ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
                    ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
                    ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc')
                    ->where('header_products.name_product','like',$search.'%')
                    ->paginate(6);

                // $header_events['header_events'] = DB::table("header_events")->where('name','like',$search.'%')->paginate(6);
            }
            else{
                $list_project['list_project'] = 
                    DB::table('header_products')
                    ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
                    ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
                    ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc')
                    ->where('header_products.name_product','like',$search.'%')
                    ->where('detail_category_products.id','=',$type)
                    ->paginate(6);

                // $header_events['header_events'] = DB::table("header_events")->where('name','like',$search.'%')->where('held','=',$type)->paginate(6);
            }
            

            return view('investor.detailStartup.dataStartup')->with($list_project);
           
        }
    }
}
