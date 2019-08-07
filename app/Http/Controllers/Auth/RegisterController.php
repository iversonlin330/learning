<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\Register;
use Auth;

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
    //protected $redirectTo = '/home';

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

	protected function index()
    {
		return view('register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {
		return view('register');
    }
	
	protected function store(Request $request)
    {
		$data = $request->all();
		$token = str_random(32);
		$data['account'] = '123@com';
		$data['name'] = 'test';
		$data['gender'] = 1;
		$data['city_id'] = 1;
		$data['service_school'] = 1;
		$data['service_grade'] = 1;
		$data['service_subject'] = 1;
		
		$data['email'] = '123@com';
		$data['password'] = '123';
		$data['url'] = url('/verify?account='.$data['email'].'&remember_token='.$token);
		
		Mail::to($data['email'])
			//->subject('認證...')
			//->send("<a href>");
			->send(new Register($data));
		
		User::create([
			'account' => $data['account'],
            'name' => $data['name'],
			'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
			'role' => 50,
			'remember_token' => $token,
			'email' => $data['email'],
        ]);
		
		return view('mails.register',compact('data'));
    }
	
	public function getVerify(Request $request)
    {
		$data = $request->all();
		$user = User::where('account',$data['account'])
			->where('remember_token',$data['remember_token'])
			->update(['email_verified_at' => date('Y-m-d H:i:s')]);
		$user = User::where('account',$data['account'])->first();
		if(!$user->user_info){
			$user = User::where('account',$data['account'])->first();
			Auth::login($user);
			return redirect('teachers/create');
		}else{
			return redirect('groups');
		}
	}
}
