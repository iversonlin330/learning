<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [
    //    'name', 'email', 'password',
    //];
	
	protected $guarded = ['id','created_at','updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function user_info()
    {
        if($this->role == 99){
			return [];
		}else if($this->role == 1){
			return $this->hasOne('App\Teacher','user_id','id');
		}{
			return $this->hasOne('App\Student','user_id','id');
		}
    }
	
	public function classroom()
    {
		return $this->hasOne('App\Classroom','id','classroom_id');
    }
}
