<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //
	protected $guarded = ['id','created_at','updated_at'];
	
	protected $casts = [
        'question_map' => 'array',
		'content' => 'array',
    ];
	
	public function questions()
    {
		return $this->hasMany('App\Question','group_id','id');
    }
	
	public function templates()
    {
		return $this->hasMany('App\Template','group_id','id');
    }
}
