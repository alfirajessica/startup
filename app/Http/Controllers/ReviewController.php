<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class ReviewController extends Controller
{
    //investor - detailStartup - ulasan.blade.php
    public function beriReview(Request $req)
    {
        $user = auth()->user();
        $validator = Validator::make($req->all(),[
            'isi_review'=>'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            
            //save to db header_products
            $newReview = new Review;
            $newReview->user_id = $user->id;
            $newReview->project_id = $req->project_id_ulas;
            $newReview->rating = $req->stars_rating;
            $newReview->isi_review = $req->isi_review;
            $newReview->status = "1";  
            $query = $newReview->save();

            if ($query) {
                return response()->json(['status'=>1, 'msg'=>'Berhasil beri review']);
            }
        }
    }

    public function refreshUlasan(Request $req, $id)
    {
        if($req->ajax()) {
            $list_reviews ['list_reviews']  = 
            DB::table('reviews')
            ->join('users', 'users.id','=','reviews.user_id')
            ->select('reviews.id', 'users.name', 'reviews.created_at','reviews.rating','reviews.isi_review')
            ->where('reviews.project_id','=',$id)
            ->get();
        }
        return view('investor.detailStartup.dataUlasan')->with($list_reviews);
    }
    //end of investor - detailStartup - ulasan.blade.php

    //investor - listReview.blade.php --> history review 
    public function riwayatReview()
    {
        return view('investor.listReview');
    }

    public function listReviews(Request $req)
    {
        $user = auth()->user();

        $list_reviews = 
            DB::table('reviews')
            ->join('header_products', 'header_products.id','=','reviews.project_id')
            ->select('reviews.id','header_products.name_product','reviews.rating','reviews.isi_review', 'reviews.created_at')
            ->where('reviews.user_id','=',$user->id)
            ->get();

        if($req->ajax()) {
            return datatables()->of($list_reviews)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Sudah Kirim</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        
    }
    //end of investor - listReview.blade.php --> history review

    //developer - product - detailProduct.blade.php
    public function detailProjectReview(Request $req, $id)
    {
        $list_reviews = 
            DB::table('reviews')
            ->join('users', 'users.id','=','reviews.user_id')
            ->select('reviews.id','users.name','reviews.rating','reviews.isi_review', 'reviews.created_at')
            ->where('reviews.project_id','=',$id)
            ->get();

        if($req->ajax()) {
            return datatables()->of($list_reviews)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Sudah Kirim</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }
    //end of developer - product - detailProduct.blade.php
}