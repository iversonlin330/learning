<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if(!in_array($request->getPathInfo(),["/verify",'/teachers/create','/students/create','/logout',"/teachers","/students"])){
			$user = Auth::user();
			if($user){
				if($user->role == 1){
					if($user->name == 'student'){
						//return view("students.create");
						return redirect('students/create');
					}
				}elseif($user->role == 50){
					if(!$user->user_info){
						//return view("teachers.create");
						//return redirect('teachers/create');
					}
				}elseif($user->role == 99){
					
				}
			}
		}else{
			
		}
		return $next($request);
    }
}
