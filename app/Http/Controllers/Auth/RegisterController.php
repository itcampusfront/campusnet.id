<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Providers\RouteServiceProvider;
use App\Models\Komisi;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {	
        return view('auth/register');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/member';

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
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nomor_hp' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users', 'alpha_dash'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], array_validation_messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {		
		// Create user
		$user = new User;
		$user->nama_user = $data['nama_lengkap'];
		$user->username = $data['username'];
		$user->email = $data['email'];
		$user->password = Hash::make($data['password']);
		$user->nomor_hp = $data['nomor_hp'];
		$user->foto = '';
		$user->role = role_member();
		$user->status = 1;
		$user->email_verified = 1;
        $user->last_visit = null;
		$user->register_at = date('Y-m-d H:i:s');
		$user->save();
		
		// Send Mail
		// Mail::to($user->email)->send(new RegisterMail($new_user->id_user, $new_komisi->id_komisi));
		
		return $user;
    }
}
