<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\Review;
use App\Models\User;
use App\Models\ResponseReview;
use App\Models\HeaderProduct;
use App\Models\Notification;
use App\Events\InvestorReview;
use App\Events\InvestorNotif;
use App\Events\DevNotif;
use Carbon\Carbon;

class ReviewController extends Controller
{
    //investor - detailStartup - ulasan.blade.php
    public function beriReview(Request $req)
    {
        $user = auth()->user();
        $validator = Validator::make($req->all(),[
            'isi_review'=>'required',
            'stars_rating'=>'required|not in:0',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            
            //save to db review
            $newReview = new Review;
            $newReview->user_id = $user->id;
            $newReview->project_id = $req->project_id_ulas;
            $newReview->rating = $req->stars_rating;
            $newReview->isi_review = $req->isi_review;
            $newReview->status = "1";  
            $query = $newReview->save();

            //get data dari project yang diulas
            $dataHProduct = HeaderProduct::find($req->project_id_ulas);
            $startupName = $dataHProduct->name_product;

            $dataUser1 = User::find($user->id);
            $userName = $dataUser1->name;

            $dataUser2 = User::find($dataHProduct->user_id);
            $userNameHasProduct = $dataUser2->name;
            
            //notification type -- 1
            $newNotif = new Notification;
            $newNotif->id_notif_type = 1;
            $newNotif->user_to_notify1 = $dataHProduct->user_id; //yang punya startup-- dev
            $newNotif->name_user_to_notify1 = $userNameHasProduct;
            $newNotif->user_to_notify2 = 0;
            $newNotif->user_fired_event=$user->id; //user investor skrg yg lagi review
            $newNotif->name_user_fired_event=$userName;
            $newNotif->name_product=$startupName;
            $newNotif->data = '-';
            $newNotif->read_to_notify1=0;
            $newNotif->read_to_notify2=0;
            $query = $newNotif->save();

            DevNotif::dispatch($newNotif, $userName, $startupName);

            if ($query) {
                return 1;
                //return response()->json(['status'=>1, 'msg'=>'Berhasil beri review']);
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
            //->paginate(4);

            $list_response_reviews['list_response_reviews'] =
            DB::table('reviews')
            ->join('response_reviews','response_reviews.id_reviews','=','reviews.id')
            ->select('response_reviews.response','response_reviews.id_reviews')
            ->get();

            return view('investor.detailStartup.dataUlasan')->with($list_reviews)->with($list_response_reviews);
        }

       
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
            ->leftjoin('response_reviews', 'response_reviews.id_reviews','reviews.id')
            ->select('reviews.id','header_products.name_product','reviews.rating','reviews.isi_review', 'reviews.created_at', 'response_reviews.response', 'response_reviews.created_at as tglTanggapan' )
            ->where('reviews.user_id','=',$user->id)
            ->get();

        if($req->ajax()) {
            return datatables()->of($list_reviews)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_BeriTanggapan" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailResponse">Lihat Tanggapan</a>';

                        return $btn;
                        // $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        // $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Sudah Kirim</a>';

                        // return $btn;
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
            ->select('reviews.id','users.name','users.name_company','reviews.rating','reviews.isi_review', 'reviews.created_at')
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

    //developer -- tab ulasan
    public function reviews(Request $req)
    {
        $user = auth()->user();
        if($req->ajax()){
            
            //status 0 -- belum dikonfirmasi dan tdk dikonfirmasi admin
            if ($req->tabel0 == "#table_listUlasan")
            {
                $list_reviews = 
                    DB::table('reviews')
                    ->join('users', 'users.id','=','reviews.user_id')
                    ->join('header_products', 'header_products.id','=','reviews.project_id')
                    ->leftjoin('response_reviews','reviews.id','=','response_reviews.id_reviews')
                    ->select('reviews.id','users.name','users.name_company','reviews.rating','reviews.isi_review', 'reviews.created_at', 'response_reviews.created_at as tgltanggapan','response_reviews.id as idresponse', 'header_products.name_product')
                    ->where('header_products.user_id','=',$user->id)
                    ->get();

                    return datatables()->of($list_reviews)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_BeriTanggapan" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailResponse">Lihat Tanggapan</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
            }

            if ($req->tabel1 == "#table_listUlasanInvestasi")
            {
                $list_reviewsInvestasi = 
                DB::table('rating_invests')
                ->join('header_invests','rating_invests.id_headerinvest','=','header_invests.id')
                ->join('users', 'users.id','=','header_invests.user_id')
                ->join('header_products', 'header_products.id','=','header_invests.project_id')
                ->select('rating_invests.id','users.name','users.name_company','rating_invests.rating','rating_invests.review', 'rating_invests.created_at', 'header_products.name_product')
                ->where('header_products.user_id','=',$user->id)
                ->get();

                    return datatables()->of($list_reviewsInvestasi)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_BeriTanggapan" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailResponse">Lihat Tanggapan</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
            }
        }
        
    }

    public function getResponse($id)
    {
        $list_responsereviews= 
            DB::table('response_reviews')
                ->select('id','id_reviews','response','status')
                ->where('id_reviews','=',$id)
                ->get();
        return $list_responsereviews;
    }

    public function postResponse(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'beri_response'=>'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else
        {
            if ($req->id_response == null) {
                $newResponse = new ResponseReview;
                $newResponse->id_reviews = $req->id_reviews;
                $newResponse->response = $req->beri_response;
                $newResponse->status = "1";
                $query = $newResponse->save();
    
                //get data dari project yang diulas
                $dataReview = Review::find($req->id_reviews);

                $dataHProduct = HeaderProduct::find($dataReview->project_id);
                $startupName = $dataHProduct->name_product;

                $dataUser1 = User::find($dataReview->user_id);
                $userName = $dataUser1->name;

                $dataUser2 = User::find($dataHProduct->user_id);
                $userNameHasProduct = $dataUser2->name;
                
                //notification type -- 1
                $newNotif = new Notification;
                $newNotif->id_notif_type = 7;
                $newNotif->user_to_notify1 = 0; 
                $newNotif->name_user_to_notify1 = 0; 
                $newNotif->user_to_notify2 = $dataReview->user_id; //inv 
                $newNotif->user_fired_event=$dataHProduct->user_id;  //developer yg menanggapi
                $newNotif->name_user_fired_event=$userNameHasProduct;
                $newNotif->name_product=$startupName;
                $newNotif->data = $userName; //inv nama
                $newNotif->read_to_notify1=0;
                $newNotif->read_to_notify2=0;
                $query = $newNotif->save();

                InvestorNotif::dispatch($newNotif, $userName, $startupName);

                if ($query) {
                    return 1;
                }
            }
            else{
                DB::table('response_reviews')->
                where('id',$req->id_response)->
                update([
                    'response' => $req->beri_response,
                ]);

                return 2;
            }
        }
    }

    //end of developer -- tab ulasan 
}
