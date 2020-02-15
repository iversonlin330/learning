<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Mail\Forgot;
use Illuminate\Support\Facades\Mail;

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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
	
	public function postLogin(Request $request){
		$data = $request->all();
		
		//dd($data);
		$user = User::where('account',$data['account'])->first();
		if(!$user){
			return back();
		}
		
		if($user->role == 1){
			$user = User::where('account',$data['account'])->first();
			Auth::login($user);
			if($user->user_info){
				return redirect('groups');
			}else{
				return redirect('students/create');
			}
		}elseif($user->role == 50){
			//$credentials = $request->only('account', 'password');
			//if(Auth::attempt($credentials)){
			$credentials = User::where('account',$data['account'])
				->where('password',$data['password'])
				->first();
			if($credentials && $credentials->email_verified_at != null){
				Auth::login($credentials);
				$user = Auth::user();
				if($user->user_info){
					return redirect('groups');
				}else{
					return redirect('teachers/create');
				}
			}else{
				return back();
			}
		}elseif($user->role == 99){
			//$credentials = $request->only('account', 'password');
			//if(Auth::attempt($credentials)){
			$credentials = User::where('account',$data['account'])
				->where('password',$data['password'])
				->first();
			if($credentials){
				Auth::login($credentials);
				return redirect('groups');
			}else{
				return back();
			}
		}else{
			$credentials = $request->only('account', 'password');
			if(Auth::attempt($credentials)){
				return redirect('groups');
			}else{
				return back();
			}
		}
		
		return redirect('groups');
	}
	
	public function getLogout(){
		Auth::logout();
		return redirect('/');
	}
	
	public function getForgot(){
		return view('forgot');
	}
	
	public function postForgot(Request $request){
		$data = $request->all();
		$user = User::where('account',$data['email'])->first();
		if($user){
			$data = $user;
			$data['url'] = url('/reset?email='.$data['email'].'&remember_token='.$user->remember_token);
			Mail::to($data['email'])
			->send(new Forgot($data));
			/*
			return response()->json([
				'success' => true,
				"message" => "Insert successfully",
			], 200);
			*/
			return response()->json([
				'success' => true,
				"message" => "成功",
			], 200);
			//return [ 'status' => 'Success','message' =>'成功'];
		}else{
			return response()->json([
				'success' => false,
				"message" => "Email錯誤",
			], 200);
			//return [ 'status' => 'Fail','message' =>'Email錯誤'];
		}
	}
	
	public function getReset(Request $request){
		$data = $request->all();
		
		$user = User::where('account',$data['email'])
			->where('remember_token',$data['remember_token'])
			->first();
		if($user){
			Auth::login($user);
			return view('reset',compact('data'));
		}else{
			return false;
		}
	}
	
	public function postReset(Request $request){
		$data = $request->all();
		
		$user = User::where('account',$data['email'])->first();
		
		$user = User::where('account',$data['email'])
			->update([
				'password' => $data['password'],
			]);
		
		
	}
}
