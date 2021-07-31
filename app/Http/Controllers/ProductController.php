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
use App\Models\CategoryProduct;
use App\Models\detailCategoryProduct;
use App\Models\Hkas;
use App\Models\HStartupTag;
use App\Models\SubStartupTag;
use App\Models\NotConfirmProduct;
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
            'hstartupTag_produk'=>'required',
            'subTag_produk'=>'required',
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
            $newProduct->id_substartuptag = $req->subTag_produk;
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
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKasMasuk" style="text-transform: none">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKasMasuk" data-tr="tr_{{$product->id}}" style="text-transform: none">Hapus</a>';

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
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKasKeluar" style="text-transform: none">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKasKeluar" data-tr="tr_{{$product->id}}" style="text-transform: none">Hapus</a>';

                    // $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKasKeluar">Ubah</a>';

                    // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKasKeluar" data-tr="tr_{{$product->id}}">Hapus</a>';

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
            
            //status 0 -- belum dikonfirmasi dan tdk dikonfirmasi admin
            if ($req->tabel0 == "#table_listProductConfirmYet"){
                $list_proyek0 = DB::table('header_products')
                ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                ->select('header_products.id','header_products.name_product','detail_category_products.name','header_products.status')
                ->where('header_products.user_id','=',$user->id)
                ->whereIn('header_products.status', [0, 4])
                ->get();

                return datatables()->of($list_proyek0)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="table_listProductConfirmYet" style="text-transform: none">Detail</a>';
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
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct"  data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="table_listProduct" style="text-transform: none">Detail </a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Nonaktifkan" class="btn btn-danger btn-sm nonAktifProject" style="text-transform: none" data-tr="tr_{{$product->id}}">Nonaktifkan </a>';
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
                    
                    $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="table_listProductInvestor" style="text-transform: none">Detail</a>';

                   // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Nonaktifkan" class="btn btn-danger btn-sm aktifProject" data-tr="tr_{{$product->id}}">Aktifkan</a>';

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
                        
                        $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#detailProduct" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject" id="table_listProductNonAktif" style="text-transform: none">Detail</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProject" data-tr="tr_{{$product->id}}" style="text-transform: none">Hapus</a>';

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

    public function konfirmasiUlang($id)
    {
        DB::table('header_products')->
            where('id',$id)->
            update([
                'status' => '0',
            ]);
        return 1;
        
    }

    public function detailProject($id)
    {
       // return view('developer.product.detailProduct');
         $HeaderProduct = HeaderProduct::find($id);
         return response()->json($HeaderProduct);
    }

    public function get_categoryID($id)
    {
        $list_category = detailCategoryProduct::find($id);
        return response()->json($list_category);
    }

    public function detailKategori($id)
    {
        $list_detailcategory = DB::table('detail_category_products')->where('category_id','=',$id)->get();
        return response()->json($list_detailcategory);
    }

    public function get_substartupTagID($id)
    {
        $list_hstartupTag = SubStartupTag::find($id);
        return response()->json($list_hstartupTag);
    }

    public function detailsubstartupTag($id)
    {
        $list_detailsubstartupTag = DB::table('sub_startup_tags')->where('startuptag_id','=',$id)->get();
        return response()->json($list_detailsubstartupTag);
    }

    public function jenisProject()
    {
        $list_category = DB::table('category_products')->get();
        return response()->json($list_category);
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

    public function updDetailProject(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nama_product'=>'required',
            'edit_jenis_produk'=>'required',
            'edit_detail_kategori'=>'required',
            'edit_startup_tag'=>'required',
            'edit_subStartup_tag'=>'required',
            'url_product'=>'required',
            'rilis_product'=>'required',
            'desc'=>'required',
            'team'=>'required',
            'reason'=>'required',
            'benefit'=>'required',
            'solution'=>'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            

            DB::table('header_products')->
            where('id',$req->id_product)->
            update([
                'name_product'=>$req->nama_product,
                'id_detailcategory'=>$req->edit_detail_kategori,
                'id_substartuptag'=>$req->edit_subStartup_tag,
                'url'=>$req->url_product,
                'rilis'=>$req->rilis_product,
                'desc'=>$req->desc,
                'team'=>$req->team,
                'reason'=>$req->reason,
                'benefit'=>$req->benefit,
                'solution'=>$req->solution,
            ]);

            return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah detail product']);
        }
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

        }

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
            
            //cek apakah data yang sama pernah dimasukkan sebelumnya berdasarkan tanggal inputnya
            //berdasarkan id_headerproduct, tipe, id_typetrans dan created_at

            $today = Carbon::today()->toDateString();
            
            $minToday = $today. " 00:00:00";
            $maxToday = $today. " 23:59:59";
           
            $isExist = 
            DetailProductKas::where('id_headerproduct','=',$req->pilih_project_masuk)
            ->where('id_typetrans', '=', $req->tipe_pemasukkan)
            ->where('created_at', '>=', $minToday)->where('created_at', '<=', $maxToday)
            ->orderByDesc('created_at')
            ->first();

            if (DetailProductKas::where('id_headerproduct','=',$req->pilih_project_masuk)
            ->where('id_typetrans', '=', $req->tipe_pemasukkan)
            ->where('created_at', '>=', $minToday)->where('created_at', '<=', $maxToday)->doesntExist())
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
                    return 1;
                }
                
                
            }
            if (DetailProductKas::where('id_headerproduct','=',$req->pilih_project_masuk)
            ->where('id_typetrans', '=', $req->tipe_pemasukkan)
            ->where('created_at', '>=', $minToday)->where('created_at', '<=', $maxToday)->exists())
            {
                return -1;
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
            return 1;
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
        DB::table('category_products')
        ->where('status','=','1')->get();

        $list_dtcategory['list_dtcategory'] = 
        DB::table('detail_category_products')->get();

        $list_startupTag['list_startupTag']= DB::table('h_startup_tags')->get();
        $list_SubstartupTag['list_SubstartupTag']= DB::table('sub_startup_tags')->get();

        $list_project['list_project'] = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->join('sub_startup_tags','sub_startup_tags.id','=','header_products.id_substartuptag')
        ->join('h_startup_tags','h_startup_tags.id','=','sub_startup_tags.startuptag_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url','sub_startup_tags.name_subtag','h_startup_tags.name_startup_tag')
        ->where('header_products.status','=','1')
        ->paginate(4);
       
        
        return view('investor.startup')->with($list_dtcategory)->with($list_category)->with($list_project)->with($list_startupTag)->with($list_SubstartupTag);
    }

    public function detailstartup(Request $req, $id){

        $list_project['list_project'] = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->join('users','users.id','=','header_products.user_id')
        ->join('sub_startup_tags','sub_startup_tags.id','=','header_products.id_substartuptag')
        ->join('h_startup_tags','h_startup_tags.id','=','sub_startup_tags.startuptag_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url', 'header_products.rilis','header_products.team','header_products.reason','header_products.benefit','header_products.solution','users.name as nama_user', 'users.email', 'users.province_name', 'users.city_name','sub_startup_tags.name_subtag','h_startup_tags.name_startup_tag')
        ->where('header_products.id','=',$id)
        ->get();

        $list_finance['list_finance'] = 
        DB::table('detail_product_kas')
        ->select(\DB::raw('SUM(jumlah) as total_masuk,DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('id_headerproduct','=',$id)
        ->where('tipe','=','1')
        ->where('status','=','1')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();

        $list_finance_keluar['list_finance_keluar'] = 
        DB::table('detail_product_kas')
        ->select(\DB::raw('SUM(jumlah) as total_keluar,DATE_FORMAT(created_at,"%Y-%m") as monthDate'))
        ->where('id_headerproduct','=',$id)
        ->where('tipe','=','2')
        ->where('status','=','1')
        ->groupBy(\DB::raw('DATE_FORMAT(created_at,"%Y-%m")'))
        ->orderBy('created_at')
        ->get();

       $user = auth()->user();
        $detail_user['detail_user'] = DB::table('users')->where('id','=',$user->id)->get();

        $reviews['reviews'] = 
        DB::table('reviews')
        ->select(\DB::raw('round(avg(rating)) as rate, count(id) as ulasan'))
        ->where('project_id','=',$id)->get();

        $list_reviews ['list_reviews']  = 
        DB::table('reviews')
        ->join('users', 'users.id','=','reviews.user_id')
        ->select('reviews.id', 'users.name', 'reviews.created_at','reviews.rating','reviews.isi_review')
        ->where('reviews.project_id','=',$id)
        ->paginate(4);

        $list_response_reviews['list_response_reviews'] =
        DB::table('reviews')
        ->join('response_reviews','response_reviews.id_reviews','=','reviews.id')
        ->select('response_reviews.response','response_reviews.id_reviews')
        ->get();
       //dd($list_finance);
        return view('investor.detailStartup.desc')->with($list_project)->with($detail_user)->with($list_finance)->with($list_finance_keluar)->with($list_reviews)->with($reviews)->with($list_response_reviews);
    }

    //search di startup investor
    public function searchStartup(Request $req)
    {
        $list_category['list_category'] = DB::table('category_products')->get();
        $list_project['list_project'] = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->join('sub_startup_tags','sub_startup_tags.id','=','header_products.id_substartuptag')
        ->join('h_startup_tags','h_startup_tags.id','=','sub_startup_tags.startuptag_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url','sub_startup_tags.name_subtag','h_startup_tags.name_startup_tag')
        ->where('header_products.status','=','1')
        ->where('header_products.name_product','=',$req->search_input)
        ->paginate(4);
        $output="";
      
    }

    //search
    public function getMoreStartups(Request $req) {
        
        $search = $req->search_query;
        $type = $req->typecategory_query;
        $startupTag = $req->typeStartuptag_query;

        $query = 
        DB::table('header_products')
        ->Join('detail_category_products', 'detail_category_products.id', '=', 'header_products.id_detailcategory')
        ->Join('category_products', 'category_products.id', '=', 'detail_category_products.category_id')
        ->join('sub_startup_tags','sub_startup_tags.id','=','header_products.id_substartuptag')
        ->join('h_startup_tags','h_startup_tags.id','=','sub_startup_tags.startuptag_id')
        ->select('header_products.id','header_products.name_product','category_products.name_category','detail_category_products.name','header_products.image','header_products.desc','header_products.url','sub_startup_tags.name_subtag','h_startup_tags.name_startup_tag')
        ->where('header_products.status','=','1');

        if($req->ajax()) {

            if ($search == null) {
                $list_project['list_project'] = 
                $query->where('header_products.name_product','like',$search.'%')
                ->paginate(4);

                if ($type != null && $startupTag == null) {
                    $list_project['list_project'] = 
                    $query->where('header_products.name_product','like',$search.'%')
                    ->where(function ($query) use($type)
                    {
                        for ($i=0; $i <count($type) ; $i++) { 
                            $query->orwhere('header_products.id_detailcategory','like','%'.$type[$i].'%');
                        }
                    })
                    ->paginate(4);
                }

                if ($type == null && $startupTag != null) {
                    $list_project['list_project'] = 
                    $query->where('header_products.name_product','like',$search.'%')
                    ->where(function ($query) use($startupTag)
                    {
                        for ($i=0; $i <count($startupTag) ; $i++) { 
                            $query->orwhere('header_products.id_substartuptag','like','%'.$startupTag[$i].'%');
                        }
                    })
                    ->paginate(4);
                }

                if ($type != null && $startupTag != null) {
                    $list_project['list_project'] = 
                    $query->where('header_products.name_product','like',$search.'%')
                    ->where(function ($query) use($type)
                    {
                        for ($i=0; $i <count($type) ; $i++) { 
                            $query->orwhere('header_products.id_detailcategory','like','%'.$type[$i].'%');
                        }
                    })
                    ->where(function ($query) use($startupTag)
                    {
                        for ($i=0; $i <count($startupTag) ; $i++) { 
                            $query->orwhere('header_products.id_substartuptag','like','%'.$startupTag[$i].'%');
                        }
                    })
                    ->paginate(4);
                }

            }
            
            else if ($search != null) {
                
                if ($type == null && $startupTag == null) {
                    $list_project['list_project'] = 
                    $query->where('header_products.name_product','like',$search.'%')
                    ->paginate(4);
                }

                if ($type != null && $startupTag != null) {
                    $list_project['list_project'] = 
                    $query->where('header_products.name_product','like',$search.'%')
                    ->where(function ($query) use($type)
                    {
                        for ($i=0; $i <count($type) ; $i++) { 
                            $query->orwhere('header_products.id_detailcategory','like','%'.$type[$i].'%');
                        }
                    })
                    ->where(function ($query) use($startupTag)
                    {
                        for ($i=0; $i <count($startupTag) ; $i++) { 
                            $query->orwhere('header_products.id_substartuptag','like','%'.$startupTag[$i].'%');
                        }
                    })
                    ->paginate(4);
                }

                if ($type != null && $startupTag == null) {
                    $list_project['list_project'] = 
                    $query->where('header_products.name_product','like',$search.'%')
                    ->where(function ($query) use($type)
                    {
                        for ($i=0; $i <count($type) ; $i++) { 
                            $query->orwhere('header_products.id_detailcategory','like','%'.$type[$i].'%');
                        }
                    })
                    ->paginate(4);
                }

                if ($type == null && $startupTag != null) {
                    $list_project['list_project'] = 
                    $query->where('header_products.name_product','like',$search.'%')
                    ->where(function ($query) use($startupTag)
                    {
                        for ($i=0; $i <count($startupTag) ; $i++) { 
                            $query->orwhere('header_products.id_substartuptag','like','%'.$startupTag[$i].'%');
                        }
                    })
                    ->paginate(4);
                }
            }  
            return view('investor.detailStartup.dataStartup')->with($list_project);
           
        }
    }

    public function get_Status($id)
    {
        $getStatus = HeaderProduct::where('id','=',$id)->get();
    
        $isExist = HeaderProduct::where('id','=',$id)->first();

        if (HeaderProduct::where('id','=',$id)->exists()) {
            return response()->json($getStatus);
        }

        else if ($isExist == null)
        {
            return 0;
        }
        
    }

    public function get_allReasonTdkDikonfirmasi($id)
    {
        $notConfirmProduct = NotConfirmProduct::where('id_headerproduct','=',$id)->get();
        return response()->json($notConfirmProduct);
    }
}
