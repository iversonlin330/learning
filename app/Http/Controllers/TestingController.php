<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\UserAnswer;
use Auth;

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
		
		$no = 0;
		
		foreach($question_map as $temp => $q_no){
			foreach($q_no as $index => $val){
				$no++;
				$new_question_no[$val] = $no;
			}
		}
		
		//dd($question_map,$question_step,$new_question_no);
		
		return view('testings.index',compact('group','templates','questions','question_map','question_step','new_question_no'));
	}
	
	public function finish(Request $request, $id){
		$user = Auth::user();
		$data = $request->all();
		foreach($data['answer'] as $question_id => $answer){
			
			$user_answer = UserAnswer::firstOrNew(array('question_id' => $question_id,'user_id' => $user->id));
			$user_answer->answer = (is_array($answer))? json_encode($answer) : $answer;
			$user_answer->save();
			/*
			UserAnswer::create([
				'question_id' =>  $question_id,
				'answer' => (is_array($answer))? json_encode($answer) : $answer,
				'user_id' => $user->id
			]);
			*/
		}
		
		return redirect('/testing-view/'.$id);
		
		/*
		$group = Group::find($id);
		$questions = $group->questions;
		return view('testings.finish',compact('data','questions'));
		*/
	}
	
	public function view($id){
		$user = Auth::user();
		$group = Group::find($id);
		$questions = $group->questions;
		$user_answers = UserAnswer::where('user_id',$user->id)
			->whereIn('question_id',$questions->pluck('id')->toArray())
			->get()
			->pluck('answer','question_id')
			->toArray();
		$correct = 0;
		$total = 0;
		foreach($questions as $question){
			if($question->type == 1)
				continue;
			if(array_key_exists($question->id,$user_answers)){
				if($question->correct_answer == $user_answers[$question->id]){
					$correct++;
				}
			}
			$total++;
		}
		
		$rate = round($correct/$total*100);
		
		return view('testings.finish',compact('questions','user_answers','rate'));
	}
	
}
