<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\HeaderEvent;
use App\Models\detailEvent;
use App\Models\User;
use Carbon\Carbon;
//use App\Http\Controllers\GlobalConstants;

class EventController extends Controller
{
    protected $API_KEY = 'b987431dcecfd64bc6a193cdce1ff0bd';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function event()
    {
        //get Province
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces['provinces']= $response['rajaongkir']['results'];  
        return view('investor.event', $provinces);
       
    }



    public function getCities($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province='.$id.'');

        $cities = $response['rajaongkir']['results'];
        return response()->json($cities);
       // return view('investor.event', $cities);
    }

    public function getCitiesName($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province='.$id.'');

        $cities = $response['rajaongkir']['results'];
        return response()->json($cities);
       // return view('investor.event', $cities);
    }

    

    //save event to db
    public function buatEvent(Request $req){

        $user = auth()->user();

        //validate request
        $validator = Validator::make($req->all(),[
            'nama_event'=>'required',
            'desc_event'=>'required',
            'event_held'=>'required|not_in:0',
            'jadwal_event'=>'required|date',
            'time_event'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $event = new HeaderEvent;
            $event->user_id = $user->id;
            $event->name = ucfirst($req->nama_event);
            $event->desc = ucfirst($req->desc_event);
            $event->held = ucfirst($req->event_held);

            if ($event->held == "Offline") {
                $validator = Validator::make($req->all(),[
                    'provinsi_event'=>'required|not_in:0',
                    'kota_event'=>'required|not_in:0',
                    'address_event'=>'required',
                    
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    //if offline
                    $event->id_province = $req->provinsi_event;
                    $event->id_city = $req->kota_event;
                    $event->province_name = $req->hidden_province_name;
                    $event->city_name = $req->hidden_city_name;
                    $event->address = $req->address_event;

                }
            }
            else if ($event->held == "Online") {
                $validator = Validator::make($req->all(),[
                    'link_event'=>'required',
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    //if online
                    $event->link = $req->link_event;
                }
            }
        
            $event->event_schedule = $req->jadwal_event;
            $event->event_time = $req->time_event;

            //store image
            if ($req->hasfile('image')) {
                $file = $req->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = $req->nama_event.$req->jadwal_event.'.'.$extension;
                $file->move('uploads/event/', $filename);
                $event->image = $filename;
            }else{
                return $req;
                $highligts->image = '';
            }
            $event->image = $filename;
            $event->status = "1";
            $query = $event->save();

            if ($query) {
                return response()->json(['status'=>1, 'msg'=>'Event baru berhasil ditambahkan']);
            }
        }

    }

    

    public function listEvent(Request $req){

        $user = auth()->user();
        
        $list_dev = DB::table('header_events')
                    ->where('user_id', '=', $user->id)
                    ->get();
        if($req->ajax()){
            return datatables()->of($list_dev)
                    ->addColumn('action', function($data){
                        $btn = '';
                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('inv.listEvent');
    }

    public function editEvent($id)
    {
        $HeaderEvent = HeaderEvent::find($id);
        return response()->json($HeaderEvent);
    }

    public function detailEvent($id)
    {
        $HeaderEvent = HeaderEvent::find($id);
        return response()->json($HeaderEvent);
    }

    public function listParticipant($id, Request $req){

        $user = auth()->user();
        
        $list_dev = DB::table('detail_events')
                    ->leftJoin('users', 'detail_events.id_participant', '=', 'users.id')
                    ->where('detail_events.id_header_events','=',$id)
                    ->get();
                    
        if($req->ajax()){
            return datatables()->of($list_dev)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailEventModal" data-id="'.$data->id.'" data-original-title="Detail" class="edit btn btn-warning btn-sm detailEvent">Detail</a>';

                        $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEvent" data-tr="tr_{{$product->id}}"
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

        return view('inv.listEvent');
    }

    public function updateEvent(Request $req)
    {
        //validate request
        $validator = Validator::make($req->all(),[
            'edit_nama_event'=>'required',
            'edit_desc_event'=>'required',
            'edit_event_held'=>'required|not_in:0',
            'edit_jadwal_event'=>'required|date',
            'edit_time_event'=>'required',
        ]);

        //check the request is validated or not
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else
        {

            if ($req->edit_event_held == "Offline") {
                $validator = Validator::make($req->all(),[
                    'edit_provinsi_event'=>'required|not_in:0',
                    'edit_kota_event'=>'required|not_in:0',
                    'edit_address_event'=>'required',
                    
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    DB::table('header_events')->
                    where('id',$req->coba_id)->
                    update([
                        'name' => $req->edit_nama_event,
                        'desc' => $req->edit_desc_event,
                        'held' => $req->edit_event_held,
                        'id_province' => $req->edit_provinsi_event,
                        'id_city' => $req->edit_kota_event,
                        'address' => $req->edit_address_event,
                        'event_schedule' => $req->edit_jadwal_event,
                        'event_time' => $req->edit_time_event,

                    ]);
                }
            }
            else if($req->edit_event_held == "Online"){
                $validator = Validator::make($req->all(),[
                    'edit_link_event'=>'required',
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    //if online
                    DB::table('header_events')->
                    where('id',$req->coba_id)->
                    update([
                        'name' => $req->edit_nama_event,
                        'desc' => $req->edit_desc_event,
                        'held' => $req->edit_event_held,
                        'link' => $req->edit_link_event,
                        'event_schedule' => $req->edit_jadwal_event,
                        'event_time' => $req->edit_time_event,

                    ]);
                }
            }
            
            return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah Event']);
        }
        
    }

    public function nonaktifEvent($id)
    {
        //cek dulu apakah ada participant di event ini
        $isExist = detailEvent::where('id_header_events', '=', $id)->where('status','=','1')->first();
        
        //tidak ada
        if ($isExist == null) {
            DB::table('header_events')
            ->where('id',$id)
            ->update([
                        'status' => "4",
                    ]);
            return 1; //data participant tidak ada maka status event jadi 4 (nonaktif)
        }
        else{
            return 0; //data participant ada, maka status tdk berubah
        }
    }

    public function aktifEvent($id)
    {
        DB::table('header_events')
            ->where('id',$id)
            ->update([
                        'status' => "1",
                    ]);
            return 1;
    }

   

    // developer event
    public function devEvent()
    {
        $header_events['header_events'] = DB::table("header_events")->where('status','=','1')->paginate(6);
        return view('developer.event')->with($header_events);
    }

    //search di events developer
    public function searchEvent(Request $req)
    {
        $list_category['list_category'] = DB::table('category_products')->get();
        $header_events['header_events'] = DB::table("header_events")->where('name','='.$req->search_input)->where('status','=','1')->paginate(6);
        $output="";
      
    }

    //search
    public function getMoreUsers(Request $req) {
        
        $search = $req->search_query;
        $held = $req->held_query;
       
        if($req->ajax()) {
            //semua
            if ($held == null) {
                $header_events['header_events'] = DB::table("header_events")->where('name','like',$search.'%')->where('status','=','1')->paginate(6);
            }
            else{
                $header_events['header_events'] = DB::table("header_events")->where('name','like',$search.'%')->where('held','=',$held)->where('status','=','1')->paginate(6);
            }
            

            return view('developer.event.dataEvent')->with($header_events);
           
        }
    }

    public function homeNewEvents(Request $req){

        $header_events = DB::table("header_events")
                   ->whereDate('created_at', '>', Carbon::now()->subDays(30))
                   ->all();
        return view('dev.devEvent', $header_events);
    }

    public function detailsEvent($id){

        $header_events['header_events'] = DB::table("header_events")->where('id','=',$id)->get();
        return view('developer.event.detailsEvent', $header_events);
    }

    public function joinEvent(Request $req, $id){

        $user = auth()->user();

        $isExist = detailEvent::where('id_header_events', '=', $id)->where('id_participant', '=', $user->id)->first();
        
        if (detailEvent::where('id_header_events', '=', $id)->where('id_participant', '=', $user->id)->where('status', '=', "1")->exists()) //available
        {
            return 0;
            
        }
        
        if(detailEvent::where('id_header_events', '=', $id)->where('id_participant', '=', $user->id)->where('status', '=', "0")->exists()){
            
            DB::table('detail_events')
            ->where('id_header_events',$id)
            ->where('id_participant',$user->id)
            ->update([
                        'status' => "1",
                    ]);
            return 1;
            
        }
        if ($isExist == null) {
            $detailevent = new detailEvent;
            $detailevent->id_header_events = $id;
            $detailevent->id_participant = $user->id;
            $detailevent->status = "1";
            //1 - aktif, 0 - Tidak aktif
            $query = $detailevent->save();
    
            if ($query) {
                return 2;
              
            }
        }
        
        
    }

    public function listJoinEvent(Request $req){

        // 1-aktif/ikut, 0-batal, 2-selesai

        $user = auth()->user();
        $myevents = DB::table('detail_events')
        ->leftJoin('header_events', 'header_events.id', '=', 'detail_events.id_header_events')
        ->where('detail_events.id_participant','=',$user->id)
        ->where('detail_events.status','=',"1")
        ->get();
        if($req->ajax()){
            return datatables()->of($myevents)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailEventModal" data-id="'.$data->id.'" data-original-title="Detail" class="edit btn btn-warning btn-sm detailEvent">Detail</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('developer.listJoinEvent');
    }

    public function cancleEvent($id)
    {
        $user = auth()->user();
        DB::table('detail_events')
            ->where('id_header_events',$id)
            ->where('id_participant',$user->id)
            ->update([
                        'status' => "0",
                    ]);

        return back()->with('status', 'Berhasil cancle Event');
    }

    public function listCancleEvent(Request $req){

        // 1-aktif/ikut, 0-batal, 2-selesai

        $user = auth()->user();
        $myevents = DB::table('detail_events')
        ->leftJoin('header_events', 'header_events.id', '=', 'detail_events.id_header_events')
        ->where('detail_events.id_participant','=',$user->id)
        ->where('detail_events.status','=',"0")
        ->get();
        if($req->ajax()){
            return datatables()->of($myevents)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailEventModal" data-id="'.$data->id.'" data-original-title="Detail" class="edit btn btn-warning btn-sm detailEvent">Detail</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('developer.listJoinEvent');
    }

    public function listHistoryEvent(Request $req){

        // 1-aktif/ikut, 0-batal, 2-selesai

        $user = auth()->user();
        $myevents = DB::table('detail_events')
        ->rightjoin('header_events', 'header_events.id', '=', 'detail_events.id_header_events')
        ->where('detail_events.id_participant','=',$user->id)
        ->where('header_events.status','=',"2")
        ->get();
        if($req->ajax()){
            return datatables()->of($myevents)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailEventModal" data-id="'.$data->id.'" data-original-title="Detail" class="edit btn btn-warning btn-sm detailEvent">Detail</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('developer.listJoinEvent');
    }

    

}
