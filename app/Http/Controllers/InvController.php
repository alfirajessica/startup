<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\HeaderEvent;
use App\Models\User;


class InvController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function event()
    {
        return view('investor.event');
    }

    public function buatEvent(Request $req){

        $user = auth()->user();

        //validate request
        $validator = Validator::make($req->all(),[
            'nama_event'=>'required',
            'desc_event'=>'required',
            'event_held'=>'required|not_in:0',
            'jadwal_event'=>'required|date',
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
            $event->link = $req->link_event;
            $event->location = ucfirst($req->lokasi_event);
            $event->event_schedule = $req->jadwal_event;

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
                // return back()
                //     ->with('success','You have successfully upload image.')
                //     ->with('image',$filename); 

                return response()->json(['status'=>1, 'msg'=>'Event baru berhasil ditambahkan']);
            }
        }

        //return view('investor.event');
    }

    public function listEvent(Request $req){

        $user = auth()->user();
        
        $list_dev = DB::table('header_events')
                    ->where('user_id', '=', $user->id)
                    ->get();
        if($req->ajax()){
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

        return view('inv.listEvent');
    }

    public function startup()
    {
        return view('investor.startup');
    }

    public function detailstartup(){
        return view('investor.detailstartup');
    }

    public function akun()
    {
        return view('investor.akun');
    }
}
