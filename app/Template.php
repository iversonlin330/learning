<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdsRecord;

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
	
	public function ads_record()
    {
		return $this->hasMany('App\AdsRecord','template_id','id');
    }
	
	public function getTIdAttribute()
    {
        return 'AD'.str_pad($this->id,3,'0',STR_PAD_LEFT);
    }
	
	public function getAdCountAttribute()
    {
		return $this->ads_record->count();
    }
}
