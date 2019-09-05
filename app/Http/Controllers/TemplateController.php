<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\UserAnswer;
use App\Question;
use App\Template;
use Auth;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
		$data = $request->all();
		$group_id = $data['group_id'];
		$group = Group::find($group_id );
		$templates = $group->templates;
		
		return view('templates.index',compact('group_id','group','templates'));
		$user = Auth::user();
		$groups = $user->groups();
		if($user->role == 50){
			$classrooms = $user->user_info->classrooms;
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
		
		return view('groups.index',compact('groups','classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
		$data = $request->all();
		$group_id = $data['group_id'];
		$group = Group::find($group_id );
		$questions = $group->questions;
		
		
		return view('templates.create',compact('group_id','questions'));
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
		$data = $request->all();
		$data['order'] = 99;
		Template::Create($data);
		
		return redirect('/templates?group_id='.$data['group_id']);
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
		/*
		$template = [
			'id' =>1,
			'type' => $id,
		];
		*/
		$template = collect();
		$template->id = 1;
		$template->type = $id;
		$questions = [];
		return view('templates.edit',compact('id','template','questions'));
		
		$user = Auth::user();
		$group = Group::find($id);
		$questions = $group->questions;
		$templates = $group->templates;
		
		return view('groups.edit',compact('group','templates','questions','user'));
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
