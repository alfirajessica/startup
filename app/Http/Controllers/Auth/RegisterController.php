<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    protected $API_KEY = 'b987431dcecfd64bc6a193cdce1ff0bd';

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
       //get Province
       $response = Http::withHeaders([
        'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces['provinces']= $response['rajaongkir']['results'];  

        return view('auth.register', $provinces);

    }

    public function getCities($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province='.$id.'');

        $cities = $response['rajaongkir']['results'];
        return response()->json($cities);
       
    }
    


    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'name_company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'province'=> ['required','not_in:0'],
            'city'=> ['required','not_in:0'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:1,2'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'name_company' => $data['name_company'],
            'email' => $data['email'],
            'id_province'=> $data['province'],
            'province_name'=> $data['hidden_province_name'],
            'id_city'=> $data['city'],
            'city_name'=> $data['hidden_city_name'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'no_telp' => 0,
        ]);

    }
}
