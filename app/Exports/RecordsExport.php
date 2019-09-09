<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\User;
use App\Classroom;
use App\Group;
use App\UserAnswer;

class RecordsExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
	public function __construct($data)
    {
        $this->data = $data;
    }
	
	
    public function array(): array
    {
        //dd($this->data);
		$datas = $this->data;
		foreach($datas as $data){
			$classroom = Classroom::find($data[1]);
			$group = Group::find($data[0]);
			
			$questions = $group->questions;
			$user_ids = $classroom->students->pluck('user_id')->toArray();
			$question_ids = $group->questions->pluck('id')->toArray();
			
			$user_answers = UserAnswer::whereIn('question_id',$question_ids)
				->whereIn('user_id',$user_ids)
				->get();
			//$result = [];
			$result[] = ['ID','題組名稱','科目','年級','題號','閱讀歷程','數位閱讀指標','平均答對率'];
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
		}
		
		return $result; 
		
		
		//
		$users = User::with('user_info')->where('role',1)->get();
		$result[] = ['ID','學生ID','姓名','性別','就讀學校',',就讀年級','就讀班級','任課教師',	'使用電腦時間','尋找資訊','很會打字','很會搜尋資訊'];
		foreach($users as $user){
			$result[] = [
				$user->user_info->s_id,
				$user->account,
				$user->name,
				Config('map.gender')[$user->gender],
				$user->user_info->classroom->teacher->school_id,
				$user->user_info->classroom->grade,
				$user->user_info->classroom->classroom,
				$user->user_info->classroom->teacher->user->name,
				Config('map.computer')[$user->computer],
				Config('map.search_time')[$user->search_time],
				Config('map.typing')[$user->typing],
				Config('map.search_easy')[$user->search_easy],
			];
		}
		return $result;
    }
}