<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Address;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;
    public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 1:
                $this->redirectTo = route('admin.dashboard');
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = route('customer.dashboard');
                return $this->redirectTo;
                break;
            default:
                // $this->redirectTo = '/login';
                return url()->previous();
        }
    }

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
            'adi' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'mobile' => ['required'],
            'address' => ['required'],
            'city' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //datada adres bilgisi vaarsa bir tane adres oluşturalım;

        $user = User::create([
            'adi' => $data['adi'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' => $data['mobile'],
            'role' => $data['role']
        ]);
        Address::create([
            'user_id' => $user->id,
            'address_name' => 'Kayıtlı adres',
            'city' => $data['city'],
            'address' => $data['address'],
            'contact_name' => $data['adi'],
            'phone' => $data['mobile'],
            'email' => $data['email']
        ]);

        return $user;
    }
}