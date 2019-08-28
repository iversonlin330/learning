<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Classroom;
use App\Group;
use App\Student;
use App\User;
use App\UserAnswer;

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
					round($A/$total*100),
					round($B/$total*100),
					round($C/$total*100),
					round($D/$total*100),
				];
			}
			
		}
		
		return view('records.single',compact('group','classroom','questions','user_answers','result'));
    }
	
	private function cal_count($data,$question_id,$item){
		$total = $data->count();
		return round($data->where('question_id',$question_id)
			->where('answer',$item)
			->count()/$total*100);
	}
	
	private function cal_multi_count($data,$question_id,$item){
		$total = $data->count();
		return round($data->where('question_id',$question_id)
			->where('answer',$item)
			->count()/$total*100);
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
						round($A/$total*100),
						round($B/$total*100),
						round($C/$total*100),
						round($D/$total*100),
					];
				}
				
			}
			
			$multi_result[] = [
				'group' => $group,
				'questions' => $questions,
				'result' => $result
			];
			
		}
		
		//$groups = ['1','2','3'];
		
		return view('records.multi',compact('multi_result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export($id)
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
		$user = User::where('id',$id)->first();
		$user->user_info->delete();
		$user->delete();
		return back();
    }
}
