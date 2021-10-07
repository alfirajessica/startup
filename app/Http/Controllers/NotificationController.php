<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationType;
use Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class NotificationController extends Controller
{
    //get all notification for this user -- user yang lagi login barusan
    public function devNotification(Request $req)
    {
        //id_notif_type = 1, 
        $user = auth()->user();
        $notif['notif'] = 
        Notification::where('user_to_notify1','=',$user->id)
                    ->where('read_to_notify1','=','0')
                    ->where('id_notif_type','>=','1')
                    // ->orWhere('id_notif_type','=','2')
                    // ->orWhere('id_notif_type','=','3')
                    // ->orWhere('id_notif_type','=','4')
                    // ->orWhere('id_notif_type','=','6')
                    // ->orWhere('id_notif_type','=','8')
                    // ->orWhere('id_notif_type','=','9')
                    ->get();
        
        return response()->json($notif);
    }

    public function adminNotificationlistProduct(Request $req)
    {
        //count byk produk/startup yang blm dikonfirmasi atau produk baru
        $list_project = 
        DB::table('header_products')
        ->select(\DB::raw('count(id) as idlist_project'))
        ->where('status','=','0')
        ->groupBy('id')
        ->get();

        if ($list_project->isEmpty()) {
            return 0;
         }
       else{
            return $list_project;
        }
        
    }

    public function adminNotification(Request $req)
    {
    
        //count byk transaksi investasi blm dikonfirmasi
        $list_invest = 
        DB::table('header_invests')
        ->select(\DB::raw('count(id) as idlist_invest'))
        ->where('status_transaction','=','settlement')
        ->where('status_invest','=','0')
        ->groupBy('id')
        ->get();

        if ($list_invest->isEmpty()) {
            return 0;
         }
       else{
            return $list_invest;
        }

        
    }

    public function invNotification(Request $req)
    {
        $user = auth()->user();
        $notif['notif'] = 
        Notification::where('user_to_notify2','=',$user->id)
                    ->where('read_to_notify2','=',0)
                    ->where('id_notif_type','>=',7)  
                    ->get();
        
        return response()->json($notif);
    }

    public function markReadReviewIinv($id, $notifTypeID)
    {
        //id notiftype = 7
        DB::table('notifications')
                ->where('id_notif_type','=',$notifTypeID)
                ->where('user_to_notify2','=',$id)
                ->update([
                    'read_to_notify2' =>'1',
                ]);
    }

    public function markReadReviewDev($id, $notifTypeID)
    {
        //dev.blade
        DB::table('notifications')
                ->where('id_notif_type','=',$notifTypeID)
                ->where('user_to_notify1','=',$id)
                ->update([
                    'read_to_notify1' =>'1',
                ]);
    }

    public function markReadReviewDev2($id, $notifTypeID)
    {
        //inv.blade
        DB::table('notifications')
                ->where('id_notif_type','=',$notifTypeID)
                ->where('user_to_notify2','=',$id)
                ->update([
                    'read_to_notify2' =>'1',
                ]);
    }

    public function mark_all_inv($id)
    {
        DB::table('notifications')
           // ->where('id_notif_type','=',$notifTypeID)
            ->where('user_to_notify2','=',$id)
            ->update([
                'read_to_notify2' =>'1',
        ]);
    }
}
