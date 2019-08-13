<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Classroom;
use App\Student;
use App\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('students.create');
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
		$user = Auth::user();
		$data = $request->all();
		
		User::where('id',$user->id)
			->update([
				'name' =>$data['name'],
				'gender' =>$data['gender']
			]);
			
		Student::where('user_id',$user->id)
			->update([
				'computer' =>$data['stu_question_1'],
				'search_time' =>$data['stu_question_2'],
				'typing' =>$data['stu_question_3'],
				'search_easy' =>$data['stu_question_4'],
			]);
			
		return redirect('groups');
		/*
		dd($data);
		$teacher_id = intval(substr($user->account,0,3));
		$class_number = substr($user->account,3,1);
		$classroom = Classroom::where('teacher_id',$teacher_id)
			->where('class_number',$class_number)
			->first();
		$data = [
			'user_id' => $user->id,
			'classroom_id' => $classroom->id,
			'computer' => $user->id,
			'search_time' => $user->id,
			'typing' => $user->id,
			'search_easy' => $user->id,
		];
		
		Student::create([
			'user_id' => $user->id,
			'classroom_id' => $classroom->id,
			'computer' => $user->id,
			'search_time' => $user->id,
			'typing' => $user->id,
			'search_easy' => $user->id,
		]);
		dd($data);
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
}
