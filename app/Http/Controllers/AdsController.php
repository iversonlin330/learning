<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\UserAnswer;
use App\Question;
use App\AdsRecord;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdsExport;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
		//$ads_records = AdsRecord::all();
		//$ads_records = AdsRecord::distinct('group_id')->get();
		$groups = Group::all();
		return view('ads.index',compact('groups'));
    }
	
	public function export(Request $request)
    {
        //
		$data = $request->all();
		return Excel::download(new AdsExport($data['group_id']), '廣告點擊紀錄.xlsx');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('templates.create');
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
		if($user->role >= 50)
			return;
		$data = $request->all();
		AdsRecord::create([
			'student_id' => $user->id,
			'template_id' => $data['template_id'],
		]);
		return $request->all();
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
