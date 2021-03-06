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
        $validator = Validator::make($req->all(),[
            'category_product'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            $re = 0;
           // return redirect()->back()->with('alert', 'Deleted!');
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $category = new CategoryProduct;
            $category->name_category = ucfirst($req->category_product);
            $category->status = "1";
            $query = $category->save();
    
            if ($query) {
                //return redirect()->back()->with('alert', 'Berhasil tambah kategori baru!');
                // $re = 1;
                 return response()->json(['status'=>1, 'msg'=>'Kategori baru berhasil ditambahkan']);
            }
        }

        /*$re = 0;
        if ($req->has('addCategory')) {
            $validator = Validator::make($req->all(),[
                'category_product'=>'required',
            ]);
    
            //check the request is validated or not
            if (!$validator->passes()) {
                $re = 0;
               // return redirect()->back()->with('alert', 'Deleted!');
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $category = new CategoryProduct;
                $category->name_category = ucfirst($req->category_product);
                $category->status = "1";
                $query = $category->save();
        
                if ($query) {
                    //return redirect()->back()->with('alert', 'Berhasil tambah kategori baru!');
                    // $re = 1;
                     return response()->json(['status'=>1, 'msg'=>'Kategori baru berhasil ditambahkan']);
                }
            }
        }

        
        if ($req->has('addDetail')){
            $validator = Validator::make($req->all(),[
                'detailcategory_product'=>'required',
            ]);
    
            //check the request is validated or not
            if (!$validator->passes()) {
                $re=0;
                //return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $detailcategory = new detailCategoryProduct;
                $detailcategory->category_id = $req->categoryID;
                $detailcategory->name = ucfirst($req->detailcategory_product);
                $detailcategory->status = "1";
                $query = $detailcategory->save();
        
                if ($query) {
                    $re = 1;
                   // return response()->json(['status'=>1, 'msg'=>'Detail Kategori baru berhasil ditambahkan']);
                }
            }
        }

        if ($re == 0) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else if ($re == 1) {
            return response()->json(['status'=>1, 'msg'=>'berhasil ditambahkan']);
        }*/
        
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
