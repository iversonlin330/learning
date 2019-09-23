<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\GroupClassroom;
use App\Student;
use App\User;

class GroupClassroomController extends Controller
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
        
		$user = Auth::user();
		$data = $request->all();
		$classrooms = $user->user_info->classrooms;
		
		$classroom_ids = $classrooms->pluck('id')->toArray();
		GroupClassroom::where('group_id' , $data['group_id'])
				->whereIn('classroom_id',$classroom_ids)
				->delete();
		if(!array_key_exists('classroom_id',$data))
			return back();
		foreach($data['classroom_id'] as $classroom_id){
			$is_exist = GroupClassroom::where('group_id' , $data['group_id'])
				->where('classroom_id',$classroom_id)
				->first();
			if($is_exist){
				continue;
			}	
			
			GroupClassroom::create([
				'group_id' => $data['group_id'],
				'classroom_id' => $classroom_id,
			]);
		}
		
		return back();
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
