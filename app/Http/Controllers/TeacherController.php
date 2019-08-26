<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teacher;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddClass;
use App\Mail\ChangeId;
use Crypt;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$users = User::where('role',50)->get();
		
		//foreach($users as $k =>$v){
			//$users[$k]->password = Crypt::decrypt($v->password);
		//}
		
		return view('teachers.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		/*
		
		$data = $request->all();
		dd($data);
		$user = Auth::user();
		
		$data = [
			'city_id' =>1,
			'school_id' => 1,
			'grade' => 1,
			'classroom' => 1,
			'subject' => 1,
		];
		
		
		Teacher::create([
			'user_id' => $user->id,
			'city_id' => $data['city_id'],
			'school_id' => $data['school_id'],
			'grade' => $data['grade'],
			'classroom' => $data['classroom'],
			'subject' => $data['subject'],
			'classroom_create' => json_encode([]),
		]);
		*/
		
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
		/*
		Mail::to($data['account'])
			//->subject('認證...')
			//->send("<a href>");
			->send(new Register($data));
		*/
		$user = User::create([
			'account' => $data['account'],
            'name' => $data['name'],
			'gender' => $data['gender'],
            //'password' => Hash::make($data['password']),
			'password' => $data['password'],
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
		
		return redirect('teachers');
		/*
		return response()->json([
			'success' => true,
			"message" => "新增成功",
		], 200);
		
		return redirect('groups');
		*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function getAddClass()
    {
        //
		return view('teachers.addClass');
    }
	
	public function postAddClass(Request $request)
    {
        //
		//Mail
		$user = Auth::user();
		$teacher = $user->user_info;
		$data['id'] = $teacher->id;
		$data['name'] = $user->name;
		$data['number_of_classroom'] = $request->input('number_of_classroom');
		
		Mail::send(new AddClass($data));
			
		return response()->json([
			'success' => true,
			'message' => 'test'
		]);
    }
	
	public function getChangeId()
    {
        //
		return view('teachers.changeId');
    }
	
	public function postChangeId(Request $request)
    {
        //
		//Mail
		
		$user = Auth::user();
		$teacher = $user->user_info;
		$data['id'] = $teacher->id;
		$data['name'] = $user->name;
		$data['old_id'] = $request->input('old_id');
		$data['new_id'] = $request->input('new_id');
		
		Mail::send(new ChangeId($data));
		
		
		return response()->json([
			'success' => true,
			'message' => 'test'
		]);
    }
	
}
