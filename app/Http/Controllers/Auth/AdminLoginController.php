<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest:admin');
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request){
        //return true;

        //validate the form data
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6|max:10'
        ]);

        // $request->validate([
        //     'email'=>'required|email',
        //     'password'=>'required|min:5|max:10'
        // ]);

        //attemp to log the user in
        //Auth::attempt($credentials, $remember);
        // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));

        

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}


// tinker
// php artisan tinker
// $admin = new App\Models\Admin
// $admin->name = "Admin"
// $admin->email = "admin@gmail.com"
// $admin->password = Hash::make('password')
// $admin->save()