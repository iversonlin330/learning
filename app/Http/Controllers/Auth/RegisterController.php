<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Teacher;
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
		$data['url'] = url('/verify?account='.$data['account'].'&remember_token='.$token);
		
		$is_exist = User::where('account', $data['account'])->first();
		if($is_exist){
			return response()->json([
				'success' => false,
				"message" => "此Email已申請過",
			], 200);
		}
		/**/
		$data['email'] = $data['account'];
		Mail::to($data['account'])
			//->subject('認證...')
			//->send("<a href>");
			->send(new Register($data));
		
		$user = User::create([
			'account' => $data['account'],
            'name' => $data['name'],
			'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
			'role' => 50,
			'remember_token' => $token,
			'email' => $data['account'],
        ]);
		
		Teacher::create([
			'user_id' => $user->id,
            'city_id' => $data['city_id'],
			'school_id' => $data['school_id'],
            'grade' => $data['grade'],
			'classroom' => $data['classroom'],
			'subject' => json_encode($data['subject']),
        ]);
		
		return response()->json([
			'success' => true,
			"message" => "新增成功",
		], 200);
		
		//return view('mails.register',compact('data'));
    }
	
	public function getVerify(Request $request)
    {
		$data = $request->all();
		$user = User::where('account',$data['account'])
			->where('remember_token',$data['remember_token'])
			->update(['email_verified_at' => date('Y-m-d H:i:s')]);
		$user = User::where('account',$data['account'])->first();
		Auth::login($user);
		return redirect('groups');
		/*
		if(!$user->user_info){
			$user = User::where('account',$data['account'])->first();
			Auth::login($user);
			return redirect('teachers/create');
		}else{
			return redirect('groups');
		}*/
	}
}
