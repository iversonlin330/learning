<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class TestingController extends Controller
{
    //
	public function index($id){
		$group = Group::find($id);
		$questions = $group->questions;
		$templates = $group->templates;
		/*
		dd(json_encode([
			'banner' => asset('img/exam-banner.jpg'),
			'tab_title' => ['Tab1','Tab2','Tab3','Tab4'],
			'tab_content' => ['Tab1_content','Tab1_content','Tab1_content','Tab1_content'],
			'ads_type' => 'right',
			'ads_pic' => asset('img/ad_right.jpg'),
			'popup' => asset('img/exam-banner.jpg'),
		]));
		*/
		
		$question_map = $templates->pluck('question_map','order')->toArray();
		$question_step = [];
		$new_question_no = [];
		foreach($question_map as $key=>$val){
			$question_step[end($val)] = $key;
		}
		
		foreach($question_map as $temp => $q_no){
			foreach($q_no as $index => $val){
				$new_question_no[$val] = $index+1;
			}
		}
		return view('testings.index',compact('group','templates','questions','question_map','question_step','new_question_no'));
	}
}
