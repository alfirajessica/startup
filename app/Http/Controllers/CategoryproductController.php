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

class CategoryproductController extends Controller
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
    public function kategoriProduk(Request $request){
        $list_category = 
        DB::table('category_products')->get();
        if($request->ajax()){
            return datatables()->of($list_category)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#editModal"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Ubah</a>';
                    
                    $btn = $btn. '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailCategorySub"  data-id="'.$data->id.'" data-text="'.$data->name_category.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailKategori">Tampilkan Sub-kategori</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.category.categoryProduct');
    }

    public function addNewCategoryProduct(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'category_product'=>'required',
        ]);

        if (!$validator->passes()) {
            //return 0;
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $isExist = CategoryProduct::where('name_category','=', $req->category_product)->first();
        
            if (CategoryProduct::where('name_category','=', $req->category_product)->exists()) //available
            {
                return -1;
                //return response()->json(['status'=>-1, 'msg'=>'Kategori telah tersedia']);
            }
            if ($isExist == null) {
                $category = new CategoryProduct;
                $category->name_category = ucfirst($req->category_product);
                $category->status = "1";
                $query = $category->save();
        
                if ($query) {
                    return 1;
                    //return response()->json(['status'=>1, 'msg'=>'Kategori baru berhasil ditambahkan']);
                }
            }
           
        }
    }

    public function addNewDetailCategoryProduct(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'detailcategory_product'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
           // $re=0;
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $isExist = detailCategoryProduct::where('name','=', $req->detailcategory_product)->first();

            if (detailCategoryProduct::where('name','=', $req->detailcategory_product)->exists()) //available
            {
                return response()->json(['status'=>-1, 'msg'=>'Detail Kategori telah tersedia']);
            }
            if ($isExist == null) {
                $detailcategory = new detailCategoryProduct;
                $detailcategory->category_id = $req->categoryID;
                $detailcategory->name = ucfirst($req->detailcategory_product);
                $detailcategory->status = "1";
                $query = $detailcategory->save();
        
                if ($query) {
                    return response()->json(['status'=>1, 'msg'=>'Detail Kategori baru berhasil ditambahkan']);
                }
            }
            
        }
    }

    public function nonAktifKategori($id)
    {
        //cek apakah id kategori ini digunakan oleh detail-category
        $isExist = detailCategoryProduct::where('category_id','=',$id)->where('status','=','1')->first();
        if (detailCategoryProduct::where('category_id','=',$id)->where('status','=','1')->exists()) //available
        { 
            return 0;
        }
        if ($isExist == null)
        {
            DB::table('category_products')->
            where('id',$id)->
            update([
                'status' => "0",
            ]);
            return response()->json(['success'=>"Berhasil menghapus kategori", 'tr'=>'tr_'.$id]);
        } 
    }

    public function aktifKategori($id)
    {
        DB::table('category_products')->
            where('id',$id)->
            update([
                'status' => "1",
            ]);
        return 1;
    }


    public function detailCategoryProduct(Request $request, $id){

        $list_detailcategory = DB::table('detail_category_products')->where('category_id', '=', $id)->get();
        if($request->ajax()){
            return datatables()->of($list_detailcategory)
                ->addColumn('action', function($data){
                    $btn = '';
                    // $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDetailKategori" data-tr="tr_{{$product->id}}">Nonaktifkan</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.categoryProduct.categoryProduct');
    }

    public function nonaktifDetailKategori($id)
    {
        //cek dipakai atau tdk di headerproduct
        $isExist = HeaderProduct::where('id_detailcategory','=',$id)->first();
        if (HeaderProduct::where('id_detailcategory','=',$id)->exists()) //available
        { 
            return 0;
        }
        if ($isExist == null)
        {
            DB::table('detail_category_products')->
            where('id',$id)->
            update([
                'status' => "0",
            ]);
            return 1;
        } 
    }

    public function aktifDetailKategori($id)
    {
        DB::table('detail_category_products')->
            where('id',$id)->
            update([
                'status' => "1",
            ]);
        return 1;
    }

    public function editCategoryProduct($id)
    {
        $CategoryProduct = CategoryProduct::find($id);
        return response()->json($CategoryProduct);
    }

    public function updateCategoryProduct(Request $req){

        $validator = Validator::make($req->all(),[
            'edit_category_product'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            DB::table('category_products')->where('id',$req->edit_categoryID)->update([
                'name_category' => $req->edit_category_product,
                ]);
           return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah kategori']);
        }
        
    }


    public function detail_category_filter($id)
    {
        $list_detailcategory['list_detailcategory'] = DB::table('detail_category_products')->where('category_id', '=', $id)->get();
        return $list_detailcategory;
        
    }
    
    public function getCities($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province='.$id.'');

        $cities = $response['rajaongkir']['results'];
        return response()->json($cities);
       
    }

    
}
