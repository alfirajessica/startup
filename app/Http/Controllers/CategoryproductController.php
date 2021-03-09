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
    public function categoryProduct(Request $request){
        $list_category = DB::table('category_products')->get();
        if($request->ajax()){
            return datatables()->of($list_category)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#editModal"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKategori" data-tr="tr_{{$product->id}}"
                    data-toggle="confirmation"
                    data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                    data-btn-ok-class="btn btn-sm btn-danger"
                    data-btn-cancel-label="Cancel"
                    data-btn-cancel-icon="fa fa-chevron-circle-left"
                    data-btn-cancel-class="btn btn-sm btn-default"
                    data-title="Are you sure you want to delete ?"
                    data-placement="left" data-singleton="true">Hapus</a>';

                    $btn = $btn. ' <a href="#row_detailCategory" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-info btn-sm detailKategori">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.categoryProduct');
    }

    public function addNewCategoryProduct(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'category_product'=>'required',
        ]);

        if (!$validator->passes()) {
            $re = 0;
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $isExist = CategoryProduct::where('name_category','=', $req->category_product)->first();
        
            if (CategoryProduct::where('name_category','=', $req->category_product)->exists()) //available
            {
                return response()->json(['status'=>-1, 'msg'=>'Kategori telah tersedia']);
            }
            if ($isExist == null) {
                $category = new CategoryProduct;
                $category->name_category = ucfirst($req->category_product);
                $category->status = "1";
                $query = $category->save();
        
                if ($query) {
                    return response()->json(['status'=>1, 'msg'=>'Kategori baru berhasil ditambahkan']);
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

    public function deleteCategoryProduct($id)
    {
        DB::table("category_products")->delete($id);
    	return response()->json(['success'=>"Berhasil menghapus kategori", 'tr'=>'tr_'.$id]);
    }

    public function detailCategoryProduct(Request $request, $id){

        $list_detailcategory = DB::table('detail_category_products')->where('category_id', '=', $id)->get();
        if($request->ajax()){
            return datatables()->of($list_detailcategory)
                ->addColumn('action', function($data){
                    
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDetailKategori" data-tr="tr_{{$product->id}}"
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
        return view('admin.categoryProduct');
    }

    public function deleteDetailCategoryProduct($id)
    {
        DB::table("detail_category_products")->delete($id);
    	return response()->json(['success'=>"Berhasil menghapus kategori", 'tr'=>'tr_'.$id]);
    }

    public function editCategoryProduct($id)
    {
        $CategoryProduct = CategoryProduct::find($id);
        return response()->json($CategoryProduct);
    }

    public function updateCategoryProduct(Request $req){
        DB::table('category_products')->where('id',$req->edit_categoryID)->update([
             'name_category' => $req->edit_category_product,
             ]);
        return response()->json(['success'=>"Berhasil mengubah kategori", 'tr'=>'tr_'.$req->edit_categoryID]);
    }


    
}
