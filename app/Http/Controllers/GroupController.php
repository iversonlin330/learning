<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\UserAnswer;
use App\Question;
use App\GroupClassroom;
use Auth;

class GroupController extends Controller
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
		$groups = $user->groups();
		$result = [];
		if($user->role == 50){
			$classrooms = $user->user_info->classrooms;
			$group_classrooms = GroupClassroom::all();
			foreach($group_classrooms as $group_classroom){
				$result[$group_classroom->group_id][] = $group_classroom->classroom_id;
			}
			//->pluck('group_id','classroom_id')->toArray();
		}else{
			$classrooms = [];
			
			$question_ids = UserAnswer::where('user_id',$user->id)
				->pluck('id')
				->toArray();
			
			$is_finish_array = array_unique(Question::whereIn('id',$question_ids)
				->pluck('group_id')
				->toArray());
			
			foreach($groups as $key => $group){
				if(in_array($group->id,$is_finish_array)){
					$groups[$key]['is_finish'] = '已完成';
				}else{
					$groups[$key]['is_finish'] = '未完成';
				}
			}
		}
		
		return view('groups.index',compact('groups','classrooms','result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('groups.create');
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
		//$data = $request->all();
		//dd($data);
		
		$path = $request->file('file')->getRealPath();
		$data = array_map('str_getcsv', file($path));
		
		//dd($data);
		foreach($data as $k => $v){
			if($k == 0){
				$group = Group::create([
					'title' => $v[0],
					'subject' => $v[2],
					'grade' => $v[1],
				]);
			}else{
				if(count($v) <= 7)
					continue;
				//dd($v[6],explode('@',$v[6]),json_encode(explode('@',$v[6])));
				if($v[1] == '簡答'){
					$type = 1;
				}elseif($v[1] == '單選'){
					$type = 2;
				}elseif($v[1] == '多選'){
					$type = 3;
				}
				
				Question::create([
					'no' => $v[0],
					'name' => $v[5],
					'item' => json_encode(explode('@',$v[7]),JSON_UNESCAPED_UNICODE),
					'type' => $type,
					'group_id' => $group->id,
					'correct_answer' => $v[6],
					'grade' => $v[2],
					'history' => $v[3],
					'goal' => $v[4],
				]);
			}
		}
		/*
		foreach($data as $k => $v){
			dd(array_map("utf8_encode", $v));
		}
		*/
		//dd(utf8_encode($data[0][0]),mb_convert_encoding($data[0][0], 'UTF-8'));
		
		/*
		foreach($data as $k => $v){
			$data[$k] = $v
		}
		*/
		
		return redirect('/groups');
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
		$user = Auth::user();
		$group = Group::find($id);
		$questions = $group->questions;
		
		return view('groups.show',compact('group','questions','user'));
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
		$user = Auth::user();
		$group = Group::find($id);
		$questions = $group->questions;
		$templates = $group->templates;
		
		return view('groups.edit',compact('id','group','templates','questions','user'));
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
		$data = $request->all();
		
		$group = Group::find($id);
		$group->update([
			'subject' => $data['subject'],
			'grade' => $data['grade'],
			'title' => $data['title'],
		]);
		
		return redirect('groups');
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
