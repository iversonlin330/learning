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
		return $this->hasMany('App\Template','group_id','id')->orderBy('order');
    }
	
	public function getGIdAttribute()
    {
        return 'A'.str_pad($this->id,3,'0',STR_PAD_LEFT);
    }
	
	public function getAdCountAttribute()
    {
        $total = 0;
		foreach($this->templates()->get() as $template){
			$total = $total + $template->ad_count;
		}
		
		return $total;
    }
}
