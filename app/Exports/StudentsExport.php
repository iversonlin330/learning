<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\User;
use App\Survey;

class StudentsExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        //
		$users = User::with('user_info')->where('role',1)->get();
		$surveys = Survey::all();
		$survey_array = $surveys->pluck('title')->toArray();
		//$result[] = ['ID','學生ID','姓名','性別','就讀學校',',就讀年級','就讀班級','任課教師',	'使用電腦時間','尋找資訊','很會打字','很會搜尋資訊'];
		$result[] = array_merge(['ID','學生ID','姓名','性別','就讀學校',',就讀年級','就讀班級','任課教師'],$survey_array);
		//dd($result);
		foreach($users as $user){
			$item = $user->user_info->survey;
			$temp_array = [];
			foreach($surveys as $survey){
				if($item){
					if(array_key_exists($survey->id,$item)){
						$temp_array[] = $item[$survey->id];
					}else{
						$temp_array[] = "";
					}
				}else{
					$temp_array[] = "";
				}
			}
			
			$result[] = array_merge([
				$user->user_info->s_id,
				$user->account,
				$user->name,
				Config('map.gender')[$user->gender],
				$user->user_info->classroom->teacher->school_id,
				$user->user_info->classroom->grade,
				$user->user_info->classroom->classroom,
				$user->user_info->classroom->teacher->user->name,
				//Config('map.computer')[$user->user_info->computer],
				//Config('map.search_time')[$user->user_info->search_time],
				//Config('map.typing')[$user->user_info->typing],
				//Config('map.search_easy')[$user->user_info->search_easy],
			],$temp_array);
		}
		return $result;
    }
}
