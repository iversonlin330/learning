<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Classroom;
use App\Student;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$user = Auth::user();
		//$classrooms = Classroom::where('teacher_id',$user->info_id)->get();
		$classrooms = $user->user_info->classrooms;
		return view('classrooms.index',compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		
		return view('classrooms.create');
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
		/*
		dd($data);
		$data = [
			'class_number' => 'A',
			'grade' => 1,
			'classroom' => '甲班',
			'number_of_poeple' => 10,
		];
		*/
		
		$is_exist = Classroom::where('class_number',$data['class_number'])
			->where('teacher_id',$user->user_info->id)
			->first();
			
		if($is_exist){
			return response()->json([
				'success' => false,
				"message" => "班級ID已使用過",
			], 200);
		}
		
		$data['teacher_id'] = str_pad($user->user_info->id,3,'0',STR_PAD_LEFT);
		$new_classroom = Classroom::create([
            'class_number' => $data['class_number'],
			'grade' => $data['grade'],
			'classroom' => $data['classroom'],
			'teacher_id' => $user->user_info->id,
        ]);
		
		for($i=1;$i<=$data['number_of_poeple'];$i++){
			$new_user = User::create([
				'account' => $data['teacher_id'] . $data['class_number'] . str_pad($i,3,'0',STR_PAD_LEFT),
				'name' => 'student',
				'role' => 1,
				'gender' => 0,
			]);
			
			Student::create([
				'user_id' => $new_user->id,
				'classroom_id' => $new_classroom->id,
			]);
		}
		
		return response()->json([
			'success' => true,
			"message" => "新增成功",
		], 200);
		
		//return redirect('/classrooms');
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
		$classroom = Classroom::with('students.user')->find($id);
		
		return view('classrooms.edit',compact('classroom'));
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
		$classroom = Classroom::where('id',$id)->first();
		/*
		$teacher_id = str_pad($classroom->teacher_id,3,'0',STR_PAD_LEFT);
		
		$classroom->students->delete();
		$classroom->users->delete();
		*/
		$classroom->delete();
		return back();
    }
}
