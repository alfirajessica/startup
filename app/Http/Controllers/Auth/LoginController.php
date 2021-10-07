<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        //$this->middleware('guest')->except('userLogout');
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');

        
    }

    public function saveToken(Request $request, $token)
    {
        $user = auth()->user();
        DB::table('users')->
                where('id',$user->id)->
                update([
                    'device_token' =>$req->device_token,
                  
                ]);

                //return back()->with('status', 'Berhasil join Event kembali');
                return response()->json(['token saved successfully.']);

        // auth()->user()->update(['device_token'=>$request->token]);
        // return response()->json(['token saved successfully.']);
    }
}
