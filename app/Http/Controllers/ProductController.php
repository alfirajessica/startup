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
        //dd($req->nama_produk);
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
            $newProduct->name_product = $req->nama_produk;
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
            $newProduct->desc = $req->desc;
            $newProduct->team = $req->team;
            $newProduct->reason = $req->reason;
            $newProduct->benefit = $req->benefit;
            $newProduct->solution = $req->solution;
            $newProduct->status = "1";  //aktif
            $query = $newProduct->save();

            if ($query) {
                return response()->json(['status'=>1, 'msg'=>'Berhasil menambah produk baru']);
            }
        }
    }

    public function listProduct(Request $req)
    {
        $list_proyek = DB::table('header_products')
                    ->Join('detail_category_products', 'header_products.id_detailcategory', '=', 'detail_category_products.id')
                    ->get();

        if($req->ajax()){
            return datatables()->of($list_proyek)
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
            
            //ok
        }
    }
}
