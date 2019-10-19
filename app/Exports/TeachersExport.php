<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\User;

class TeachersExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        //
		$users = User::where('role',50)->get();
		$result[] = ['ID','教師姓名','所屬縣市','服務學校','性別','任教科目','任教年級','任教班級','電子郵件','密碼'];
		foreach($users as $user){
			if(!$user->user_info)
				continue;
			//dd($user->id,$user->user_info);
			$result[] = [
				$user->user_info->t_id,
				$user->name,
				$user->user_info->city_id,
				$user->user_info->school_id,
				Config('map.gender')[$user->gender],
				implode(',',$user->user_info->subject),
				$user->user_info->grade,
				$user->user_info->classroom,
				$user->account,
				$user->password,
			];
		}
		return $result;
    }
}
