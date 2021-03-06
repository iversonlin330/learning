<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    //
	protected $table = 'user_answer';
	
	protected $guarded = ['id','created_at','updated_at'];
	
	public function user()
    {
		return $this->hasOne('App\User','id','user_id');
    }
}
