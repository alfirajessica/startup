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
use App\Models\Hkas;
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
            //0- blm dikonfirmasi, 1-aktif/sdh dikonfirmasi, 2-project memiliki investor, 3-dinonaktifkan, 4-project tidk dikonfirmasi

            $newProduct->status = "0";  
            $query = $newProduct->save();

           // dd($newProduct->id);
            if ($query) {
                // //set default utk detail_product_kas dengan jumlah 0
                // $newKasMasuk = new DetailProductKas;
                // $newKasMasuk->id_headerproduct = $newProduct->id;
                // $newKasMasuk->tipe = 1;
                // $newKasMasuk->id_typetrans = 1;
                // $newKasMasuk->jumlah = 0;
                // $newKasMasuk->status = 1;
                // $query = $newKasMasuk->save();

                // //set default utk detail_product_kas dengan jumlah 0
                // $newKasKeluar = new DetailProductKas;
                // $newKasKeluar->id_headerproduct = $newProduct->id;
                // $newKasKeluar->tipe = 2;
                // $newKasKeluar->id_typetrans = 5;
                // $newKasKeluar->jumlah = 0;
                // $newKasKeluar->status = 1;
                // $query = $newKasKeluar->save();
                
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
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKasMasuk">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKasMasuk" data-tr="tr_{{$product->id}}">Hapus</a>';

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
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKasKeluar">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKasKeluar" data-tr="tr_{{$product->id}}">Hapus</a>';

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
                    ->where('header_products.status','!=','3')
                    ->get();

        return response()->json($list_project);
    }

//Developer /listProduct/table_listProduct
    public function listProduct(Request $req)
    {
        $user = auth()->user();
       
        if($req->ajax()){
            
            //status 0 -- belum dikonfirmasi
            if ($req->tabel0 == "#table_listProductConfirmYet"){
                $list_proyek0 = DB::table('header_products')
                ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                ->select('header_products.id','header_products.name_product','detail_category_products.name','header_products.status','header_products.created_at')
                ->where('header_products.user_id','=',$user->id)
                ->where('header_products.status','=','0')
                ->orWhere('header_products.status','=','4')
                ->get();

                return datatables()->of($list_proyek0)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }

            //status 1 -- aktif/sudah dikonfirmasi
            if ($req->tabel1 == "#table_listProduct") {
                $list_proyek1 = DB::table('header_products')
                ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                ->select('header_products.id','header_products.name_product','detail_category_products.name')
                ->where('header_products.user_id','=',$user->id)
                ->where('header_products.status','=','1')
                ->get();

                return datatables()->of($list_proyek1)
                ->addColumn('action', function($data){
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct"  data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                    $btn = $btn. ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct2"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Nonaktifkan" class="btn btn-danger btn-sm nonAktifProject" data-tr="tr_{{$product->id}}">Nonaktif</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }

            //status 2 - project memiliki investor
            if($req->tabel2 == "#table_listProductInvestor"){
                $list_proyek2 = DB::table('header_products')
                ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                ->select('header_products.id','header_products.name_product','detail_category_products.name')
                ->where('header_products.user_id','=',$user->id)
                ->where('header_products.status','=','2')
                ->get();

                return datatables()->of($list_proyek2)
                ->addColumn('action', function($data){
                    
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Nonaktifkan" class="btn btn-danger btn-sm aktifProject" data-tr="tr_{{$product->id}}">Aktifkan</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }

            //status 3 - nonaktif
            if($req->tabel3 == "#table_listProductNonAktif"){
                
                $list_proyek3 = DB::table('header_products')
                    ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                    ->select('header_products.id','header_products.name_product','detail_category_products.name')
                    ->where('header_products.user_id','=',$user->id)
                    ->where('header_products.status','=','3')
                    ->get();

                    return datatables()->of($list_proyek3)
                    ->addColumn('action', function($data){
                        
                        $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProject" data-tr="tr_{{$product->id}}">Hapus</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
            }

        }
        return view('dev.listProduct');
    }

    public function activeProject($id)
    {
        //aktifkan project
        DB::table('header_products')->
            where('id',$id)->
            update([
                'status' => '1',
            ]);
        return response()->json(['success'=>"Berhasil mengaktifkan", 'tr'=>'tr_'.$id]);
    }

    public function nonactiveProject($id)
    {
        //nonaktifkan project
        DB::table('header_products')->
            where('id',$id)->
            update([
                'status' => '3',
            ]);
        return response()->json(['success'=>"Berhasil menonaktifkan", 'tr'=>'tr_'.$id]);
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
        if($req->ajax()){

            if ($req->getTabel == "#table_listInv") {
                $list_inv = DB::table('header_invests')
                        ->leftJoin('users', 'users.id', '=', 'header_invests.user_id')
                        ->select('header_invests.id','users.name','header_invests.invest_id','header_invests.jumlah_final','header_invests.status_invest','header_invests.invest_expire')
                        ->where('header_invests.project_id','=',$id)
                        ->get();
           
                return datatables()->of($list_inv)
                        ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';
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
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';
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
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';
                        return $btn;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
            }

            
        }

       

        
        
        //return view('dev.listProduct');
    }

    public function cek_pemasukan($id)
    {
         $list_project = DB::table('detail_product_kas')
                     ->where('id_headerproduct','=',$id)
                     ->first();

        //jika tdk ada pemasukkan pada id tsb
        if ($list_project == null) {
            return 0;
        }else{
            return 1;
            //return response()->json($list_project);
        }
         

        //$detail_product_kas = DetailProductKas::where('id_headerproduct','=',$id)->first();
        // $detail_product_kas = DetailProductKas::find($id);
        // return response()->json($detail_product_kas);
    }
//end of Developer /listProduct/table_listProduct
    
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

            $now = Carbon::now();

            $isExist = DetailProductKas::where('id_headerproduct', '=',$req->pilih_project_masuk)->where('id_typetrans', '=', $req->tipe_pemasukkan)->whereMonth('created_at', '=', $now->month)->first();

        
            if (DetailProductKas::where('id_headerproduct', '=',$req->pilih_project_masuk)->where('id_typetrans', '=', $req->tipe_pemasukkan)->whereMonth('created_at','=', $now->month)->exists()) {
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

                return response()->json(['status'=>1, 'msg'=>'Berhasil menambah detail produk kas']);

                // if ($query) {
                    
                    
                // }
            }
        }
    }

    public function upd_status_to($cek)
    {
        $isExist = DetailProductKas::where('id_headerproduct', '=',$cek)->first();
        if ($isExist == null)
        {
            DB::table('header_products')->
            where('id',$cek)->
            update([
                'status' => '1',
            ]);
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
        ->where('header_products.status','=','1')
        ->paginate(6);
       
        
        return view('investor.startup')->with($list_dtcategory)->with($list_category)->with($list_project);
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
        ->where('header_products.status','=','1')
        ->where('header_products.name_product','=',$req->search_input)
        ->paginate(6);

        // $list_category['list_category'] = DB::table('category_products')->get();
        // $header_events['header_events'] = DB::table("header_events")->where('name','='.$req->search_input)->paginate(6);
        $output="";
      
    }

    //search
    public function getMoreStartups(Request $req) {
        
        $search = $req->search_query;
        $type = "";
       
        if($req->ajax()) {

            if ($type == "1") {
                $list_project['list_project'] = 
                    DB::table('header_products')
                    ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
                    ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
                    ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url')
                    ->where('header_products.status','=','1')
                    ->where('header_products.name_product','like',$search.'%')
                    ->paginate(6);

                // $header_events['header_events'] = DB::table("header_events")->where('name','like',$search.'%')->paginate(6);
            }
            else{
                $list_project['list_project'] = 
                    DB::table('header_products')
                    ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
                    ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
                    ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url')
                    ->where('header_products.status','=','1')
                    ->where('header_products.name_product','like',$search.'%')
                    ->paginate(6);

                // $header_events['header_events'] = DB::table("header_events")->where('name','like',$search.'%')->where('held','=',$type)->paginate(6);
            }
            

            return view('investor.detailStartup.dataStartup')->with($list_project);
           
        }
    }


    
}
