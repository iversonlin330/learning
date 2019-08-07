<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\User;

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
			$credentials = $request->only('account', 'password');
			if(Auth::attempt($credentials)){
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
			$credentials = $request->only('account', 'password');
			if(Auth::attempt($credentials)){
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
}
