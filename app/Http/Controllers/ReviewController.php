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
    //
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
            $newReview->rating = 3;
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
}
