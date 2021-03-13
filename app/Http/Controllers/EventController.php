<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\HeaderEvent;
use App\Models\User;
use Carbon\Carbon;

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
                    $event->province = $req->provinsi_event;
                    $event->city = $req->kota_event;
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
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#editEventModal"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Ubah</a>';
   
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEvent" data-tr="tr_{{$product->id}}"
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

    public function editEvent($id)
    {
        $HeaderEvent = HeaderEvent::find($id);
        return response()->json($HeaderEvent);
    }

    public function updateEvent(Request $req)
    {
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
        }else
        {

            if ($req->event_held == "Offline") {
                $validator = Validator::make($req->all(),[
                    'edit_provinsi_event'=>'required|not_in:0',
                    'edit_kota_event'=>'required|not_in:0',
                    'address_event'=>'required',
                    
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    DB::table('header_events')->
                    where('id',$req->coba_id)->
                    update([
                        'name' => $req->nama_event,
                        'desc' => $req->desc_event,
                        'held' => $req->event_held,
                        'province' => $req->edit_provinsi_event,
                        'city' => $req->edit_kota_event,
                        'address' => $req->address_event,
                        'event_schedule' => $req->jadwal_event,
                        'event_time' => $req->time_event,

                    ]);
                }
            }
            else if($req->event_held == "Online"){
                $validator = Validator::make($req->all(),[
                    'link_event'=>'required',
                ]);
                if (!$validator->passes()) {
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    //if online
                    DB::table('header_events')->
                    where('id',$req->coba_id)->
                    update([
                        'name' => $req->nama_event,
                        'desc' => $req->desc_event,
                        'held' => $req->event_held,
                        'link' => $req->link_event,
                        'event_schedule' => $req->jadwal_event,
                        'event_time' => $req->time_event,

                    ]);
                }
            }
            
            return response()->json(['status'=>1, 'msg'=>'Berhasil mengubah Event']);
        }
        
    }

    public function deleteEvent($id)
    {
        DB::table("header_events")->delete($id);
    	return response()->json(['success'=>"Berhasil menghapus event", 'tr'=>'tr_'.$id]);
    }



    // developer event
    public function devEvent()
    {
        $header_events['header_events'] = DB::table("header_events")->paginate(6);
        return view('developer.event', $header_events);
    }

    public function homeNewEvents(Request $req){

    //     $date = \Carbon\Carbon::today()->subDays(30);
    //    // $newEvents = User::where('created_at','>=',$date)->get();
    //     $list_events = DB::table('header_events')
    //                 ->where('created_at', '=', $date)
    //                 ->get();

    //     dd($list_events);

        $header_events = DB::table("header_events")
                   ->whereDate('created_at', '>', Carbon::now()->subDays(30))
                   ->all();
        return view('dev.devEvent', $header_events);

        // $user = auth()->user();
        // $list_events = DB::table('header_events')
        //             ->where('user_id', '=', $user->id)
        //             ->get();
    }
}
