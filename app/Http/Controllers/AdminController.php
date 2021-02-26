<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\User;
use App\Models\Student;

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
