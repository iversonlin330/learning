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
		if(array_key_exists('order',$data)){
			foreach($data['order'] as $index => $template_id){
				Template::find($template_id)->update(['order' => $index+1]);
			}
			return back();
		}else{
			$data['order'] = 99;
			Template::Create($data);
		}
		
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
		$template = Template::find($id);
		$group_id = $template->group_id;
		$group = Group::find($group_id );
		$questions = $group->questions;
		
		return view('templates.create',compact('id','template','questions','group_id')); 
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
		$template = Template::find($id);
		$template->update($data);
		
		return redirect('/templates?group_id='.$template->group_id);
		
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
