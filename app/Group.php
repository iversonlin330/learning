<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
	protected $guarded = ['id','created_at','updated_at'];
	
	public function questions()
    {
		return $this->hasMany('App\Question','group_id','id');
    }
	
	public function templates()
    {
		return $this->hasMany('App\Template','group_id','id');
    }
}
