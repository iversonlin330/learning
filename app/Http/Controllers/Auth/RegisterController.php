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
		$data['name'] = 'test';
		$data['gender'] = '1';
		$data['email'] = '123@com';
		$data['password'] = '123';
		$data['school_id'] = '1';
		$data['url'] = url('/verify?email='.$data['email'].'&remember_token='.$token);
		
		Mail::to($data['email'])
			//->subject('認證...')
			//->send("<a href>");
			->send(new Register($data));
		
		User::create([
            'name' => $data['name'],
			'gender' => $data['gender'] = '1',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
			'school_id' => $data['school_id'],
			'role' => 1,
			'remember_token' => $token,
        ]);
		
		return view('mails.register',compact('data'));
    }
	
	protected function getVerify(Request $request)
    {
		$data = $request->all();
		$user = User::where('email',$data['email'])
			->where('remember_token',$data['remember_token'])
			->update(['email_verified_at' => date('Y-m-d H:i:s')]);
		if($user){
			$user = User::where('email',$data['email'])->first();
			Auth::login($user);
			return redirect('groups');
		}else{
			
		}
	}
}
