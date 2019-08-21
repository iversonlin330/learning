<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupClassroom extends Model
{
    //
	
	protected $table = 'group_classroom';
	
	protected $guarded = ['id','created_at','updated_at'];
}
