<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;
use App\Models\User;
use App\Models\CategoryProduct;
use App\Models\detailCategoryProduct;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('admin.dashboard');
    }

    public function akun(){
        return view('admin.akun');
    }

    //kategori produk
    public function categoryProduct(Request $request){
        $list_category = DB::table('category_products')->get();
        if($request->ajax()){
            return datatables()->of($list_category)
                ->addColumn('action', function($data){
                    $btn = '<a href="javascript:void(0)" data-toggle="collapse" data-target="#collapseExample"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Ubah</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEvent" data-tr="tr_{{$product->id}}"
                    data-toggle="confirmation"
                    data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                    data-btn-ok-class="btn btn-sm btn-danger"
                    data-btn-cancel-label="Cancel"
                    data-btn-cancel-icon="fa fa-chevron-circle-left"
                    data-btn-cancel-class="btn btn-sm btn-default"
                    data-title="Are you sure you want to delete ?"
                    data-placement="left" data-singleton="true">Hapus</a>';

                    $btn = $btn. ' <a href="javascript:void(0)" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-info btn-sm detailKategori">Detail</a>';

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
        // if ($request->has('addCategory')) {
        //     return response()->json(['status'=>1, 'msg'=>'Kategori baru berhasil ditambahkan']);
        // }else{
        //     return response()->json(['status'=>1, 'msg'=>'detail Kategori baru berhasil ditambahkan']);
        // }
        //validate request
        $validator = Validator::make($req->all(),[
            'category_product'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $category = new CategoryProduct;
            $category->name_category = ucfirst($req->category_product);
            $category->status = "1";
            $query = $category->save();
    
            if ($query) {
                return response()->json(['status'=>1, 'msg'=>'Kategori baru berhasil ditambahkan']);
            }
        }
    }

    public function detailCategoryProduct(Request $request, $id){

        $list_detailcategory = DB::table('detail_category_products')->where('category_id', '=', $id)->get();
        if($request->ajax()){
            return datatables()->of($list_detailcategory)
                ->addColumn('action', function($data){
                    
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEvent" data-tr="tr_{{$product->id}}"
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

    public function addNewDetailCategoryProduct(Request $req)
    {
        //validate request
        $validator = Validator::make($req->all(),[
            'detailcategory_product'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $detailcategory = new detailCategoryProduct;
            $detailcategory->id = $req->categoryID;
            $detailcategory->name = ucfirst($req->detailcategory_product);
            $detailcategory->status = "1";
            $query = $detailcategory->save();
    
            if ($query) {
                return response()->json(['status'=>1, 'msg'=>'Detail Kategori baru berhasil ditambahkan']);
            }
        }
    }

    //DEVELOPER
    public function listdev(Request $request){

        //$list_dev = User::all();
        $list_dev = DB::table('users')
                    ->where('role', '=', 1)
                    ->get();
        if($request->ajax()){
            return datatables()->of($list_dev)
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

        return view('admin.dev.listDev');

        //$data['users'] = User::all();
        //https://www.youtube.com/watch?v=XNFNnIglaeE
    //     $data['users'] = DB::table('users')
    //                     ->where('role', '=', 1)
    //                     ->get();
    //    return view('admin.dev.listDev', $data);

        //$dataTables->queryBuilder($data)->toJson();
        //return view('admin.dev.listDev', DataTables::queryBuilder($data)->toJson());
    }

    public function produkdev(){
        return view('admin.dev.produkDev');
    }


    //INVESTOR
    public function listinv(){
        return view('admin.inv.listInv');
    }

    public function transaksiinv(){
        return view('admin.inv.transaksiInv');
    }
}
