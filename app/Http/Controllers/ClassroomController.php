<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Classroom;

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
		//$data = $request->all();
		$data = [
			'class_number' => 'A',
			'grade' => 1,
			'classroom' => '甲班',
			'number_of_poeple' => 10,
		];
		$data['teacher_id'] = str_pad($user->user_info->id,3,'0',STR_PAD_LEFT);
		Classroom::create([
            'class_number' => $data['class_number'],
			'grade' => $data['grade'],
			'classroom' => $data['classroom'],
			'teacher_id' => $user->user_info->id,
        ]);
		
		for($i=1;$i<=$data['number_of_poeple'];$i++){
			User::create([
				'account' => $data['teacher_id'] . $data['class_number'] . str_pad($i,3,'0',STR_PAD_LEFT),
				'name' => 'student',
				'role' => 1,
				'gender' => 0,
			]);
		}
		
		return redirect('/classrooms');
		dd($user,$data);
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
		return view('classrooms.edit');
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
