<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
	
	protected $guarded = ['id','created_at','updated_at'];
	
	protected $casts = [
        'item' => 'array',
    ];
	
	protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
