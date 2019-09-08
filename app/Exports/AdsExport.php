<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\User;
use App\Classroom;
use App\Group;
use App\UserAnswer;
use App\AdsRecord;
use App\Template;

class AdsExport implements FromArray
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
		$data = $this->data;
		if($data == "All"){
			$groups = Group::all();
		}else{
			$groups = Group::where('id',$data)->get();
		}
		
		$result[] = ['ID(題組)','題組名稱','ID(廣告)','點擊數'];
		
		foreach($groups as $group){
			foreach($group->templates as $template){
				$result[] = [
					$group->g_id,
					$group->title,
					$template->T_id,
					$template->ad_count,
				];
			}
		}
		
		$result[] = ['ID(學生)',	'學生ID','就讀學校','就讀班級','任課教師','廣告ID','個人點擊數'];
		
		$user_ids = AdsRecord::all()->pluck('student_id')->toArray();
		$user_ids = array_unique($user_ids);
		
		$users = User::whereIn('id',$user_ids)->get();
		
		foreach($users as $user){
			if(!$user->user_info)
				continue;
			$template_counts = array_count_values($user->ads_record->pluck('template_id')->toArray());
			foreach($template_counts as $template_id => $t_count){
				$template = Template::find($template_id);
				$result[] = [
					$user->user_info->s_id,
					$user->account,
					$user->user_info->classroom->teacher->school_id,
					$user->user_info->classroom->classroom,
					$user->user_info->classroom->teacher->user->name,
					$template->t_id,
					$t_count
				];
			}
		}
		
		return $result;
		
		
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
