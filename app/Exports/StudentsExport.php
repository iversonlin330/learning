<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\User;

class StudentsExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        //
		$users = User::with(['user_info', "user_info.classroom", "user_info.classroom.teacher"])->where('role',1)->get();
		$result[] = ['ID','學生ID','姓名','性別','就讀學校',',就讀年級','就讀班級','任課教師',	'使用電腦時間','尋找資訊','很會打字','很會搜尋資訊'];
		foreach($users as $user){
		    if(!$user->user_info->classroom->teacher->user){
		        continue;
            }
			$result[] = [
				$user->user_info->s_id,
				$user->account,
				$user->name,
				Config('map.gender')[$user->gender],
				$user->user_info->classroom->teacher->school_id,
				$user->user_info->classroom->grade,
				$user->user_info->classroom->classroom,
				$user->user_info->classroom->teacher->user->name,
				Config('map.computer')[$user->user_info->computer],
				Config('map.search_time')[$user->user_info->search_time],
				Config('map.typing')[$user->user_info->typing],
				Config('map.search_easy')[$user->user_info->search_easy],
			];
		}
		return $result;
    }
}
