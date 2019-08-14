<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
	protected $guarded = ['id','created_at','updated_at'];
	
	public function question()
    {
		return $this->hasMany('App\Question','group_id','id');
    }
}
