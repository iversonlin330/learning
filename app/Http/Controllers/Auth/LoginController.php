<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

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
		if($data['role'] == 1){
			Auth::loginUsingId(1);
			return redirect('groups');
		}else{
			$credentials = $request->only('email', 'password');
			if(Auth::attempt($credentials)){
				return redirect('groups');
			}else{
				return redirect('/');
			}
		}
		
		return redirect('groups');
	}
	
	public function getLogout(){
		Auth::logout();
		return redirect('/');
	}
}
