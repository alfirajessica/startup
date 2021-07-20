<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\HeaderEvent;
use App\Models\HeaderProduct;
use App\Models\Review;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $trending_startup['trending_startup'] = 
            DB::table('header_products')
            ->select('header_products.id','header_products.name_product',\DB::raw('round(avg(reviews.rating))'),'header_products.image')
            ->join('reviews','reviews.project_id','=','header_products.id')
            ->groupBy('header_products.id','header_products.name_product','header_products.image')
            ->orderBy(\DB::raw('round(avg(reviews.rating))'))
            ->paginate(6);
        
        $new_event['new_event'] =
        DB::table('header_events')
        ->orderBy('created_at')->paginate(6);
        return view('/index')->with($trending_startup)->with($new_event);
    }
}
