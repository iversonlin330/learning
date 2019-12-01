<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Classroom;
use App\Group;
use App\Student;
use App\User;
use App\UserAnswer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RecordsExport;
use App\Exports\RecordsExport2;

class RecordController extends Controller
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
		if($user->role == 50){
			$classrooms = $user->user_info->classrooms;
		}elseif($user->role == 99){
			$classrooms = Classroom::all();
		}
		
		return view('records.index',compact('classrooms'));
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
	private function cal_rate($classroom_id,$group_id){
		$classroom = Classroom::find($classroom_id);
		$group = Group::find($group_id);
		
		$questions = $group->questions;
		$user_ids = $classroom->students->pluck('user_id')->toArray();
		$question_ids = $group->questions->pluck('id')->toArray();
		
		$user_answers = UserAnswer::whereIn('question_id',$question_ids)
			->whereIn('user_id',$user_ids)
			->get();
		foreach($questions as $question){
			$answers = $user_answers->where('question_id',$question->id);
			if($question->type == 1){
				foreach($answers as $index => $answer){
					$result[$question->id][] = $answer->answer;
				}
			}elseif($question->type == 2){
				$A = $this->cal_count($answers,$question->id,'A');
				$B = $this->cal_count($answers,$question->id,'B');
				$C = $this->cal_count($answers,$question->id,'C');
				$D = $this->cal_count($answers,$question->id,'D');
				$result[$question->id] = [$A,$B,$C,$D];
				/*
				foreach($answers as $index => $answer){
					$result[$question->id][] = $A;
				}
				*/
			}elseif($question->type == 3){
				$total = $A = $B = $C = $D = 0;
				foreach($answers as $index => $answer){
					$temp = json_decode($answer->answer,true);
					$total = $total + count($temp);
					foreach($temp as $v){
						if($v == 'A') $A++;
						elseif($v == 'B') $B++;
						elseif($v == 'C') $C++;
						elseif($v == 'D') $D++;
					}
				}
				$result[$question->id] = [
					($A == 0)? '0%' : round($A/$total*100),
					($B == 0)? '0%' : round($B/$total*100),
					($C == 0)? '0%' : round($C/$total*100),
					($D == 0)? '0%' : round($D/$total*100),
				];
			}
		}
		return $result;
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        //
		$data = $request->all();
		$classroom = Classroom::find($data['classroom_id']);
		$group = Group::find($data['group_id']);
		
		$questions = $group->questions;
		$user_ids = $classroom->students->pluck('user_id')->toArray();
		$question_ids = $group->questions->pluck('id')->toArray();
		
		$user_answers = UserAnswer::whereIn('question_id',$question_ids)
			->whereIn('user_id',$user_ids)
			->get();
		$result = [];
		$result = $this->cal_rate($data['classroom_id'],$data['group_id']);
		
		return view('records.single',compact('data','group','classroom','questions','user_answers','result'));
    }
	
	private function cal_count($data,$question_id,$item){
		$correct = $data->where('question_id',$question_id)
			->where('answer',$item)
			->count();
		if($correct == 0)
			return 0;
		$total = $data->count();
		return round($correct/$total*100);
	}
	
	private function cal_multi_count($data,$question_id,$item){
		$correct = $data->where('question_id',$question_id)
			->where('answer',$item)
			->count();
		if($correct == 0)
			return 0;
		$total = $data->count();
		return round($correct/$total*100);
	}
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multi(Request $request)
    {
        //
		$data = $request->all();
		$multi_result = [];
		foreach($data['data'] as $v){
			$temp = explode(',',$v);
			$classroom_id = $temp[0];
			$group_id = $temp[1];
			
			$classroom = Classroom::find($classroom_id);
			$group = Group::find($group_id);
			
			$questions = $group->questions;
			$user_ids = $classroom->students->pluck('user_id')->toArray();
			$question_ids = $group->questions->pluck('id')->toArray();
			
			$user_answers = UserAnswer::whereIn('question_id',$question_ids)
				->whereIn('user_id',$user_ids)
				->get();
			$result = [];
			$result = $this->cal_rate($classroom_id,$group_id);
			
			$multi_result[] = [
				'group' => $group,
				'questions' => $questions,
				'result' => $result
			];
			
		}
		
		//$groups = ['1','2','3'];
		
		$url = '';
		foreach($data['data'] as $p){
			$url = $url . '&data[]='.$p;
		}
		return view('records.multi',compact('multi_result','url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleExport(Request $request)
    {
        //
		$data = $request->all();
		$classroom = Classroom::find($data['classroom_id']);
		$group = Group::find($data['group_id']);
		
		return Excel::download(new RecordsExport([[$group->id,$classroom->id]]), '題組.xlsx');
		
		
		
		$questions = $group->questions;
		$user_ids = $classroom->students->pluck('user_id')->toArray();
		$question_ids = $group->questions->pluck('id')->toArray();
		
		$user_answers = UserAnswer::whereIn('question_id',$question_ids)
			->whereIn('user_id',$user_ids)
			->get();
		//$result = [];
		$result = ['ID','題組名稱','科目','年級','題號','閱讀歷程','數位閱讀指標','平均答對率'];
		foreach($questions as $question){
			
			$answers = $user_answers->where('question_id',$question->id);
			if($question->type == 1){
				$rate = '';
			}elseif(in_array($question->type,[2,3])){
				$total = $answers->count();
				$correct = $answers->where('answer',$question->correct_answer)->count();
				if($correct == 0){
					$rate = '0%';
				}else{
					$rate = round($correct/$total*100).'%';
				}
			}
			
			$result[] = [
				$group->g_id,
				$group->title,
				$group->subject,
				$group->grade,
				$question->no,
				$question->history,
				$question->goal,
				$rate
			];
			
		}
		
		dd($result);
		
    }
	
	public function singleExport2(Request $request)
    {
        //
		$data = $request->all();
		$classroom = Classroom::find($data['classroom_id']);
		$group = Group::find($data['group_id']);
		
		return Excel::download(new RecordsExport2([[$group->id,$classroom->id]]), '題組.xlsx');
    }
	
	 public function multiExport(Request $request)
    {
        //
		$data = $request->all();
		$result = []; 
		foreach($data['data'] as $v){
			$temp = explode(',',$v);
			$result[] =[
				$temp[1],
				$temp[0],
			];
		}
		
		return Excel::download(new RecordsExport($result), '題組.xlsx');
	}
	
	public function multiExport2(Request $request)
    {
        //
		$data = $request->all();
		$result = []; 
		foreach($data['data'] as $v){
			$temp = explode(',',$v);
			$result[] =[
				$temp[1],
				$temp[0],
			];
		}
		
		return Excel::download(new RecordsExport2($result), '題組.xlsx');
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
		$user = User::where('id',$id)->first();
		$user->user_info->delete();
		$user->delete();
		return back();
    }
}
