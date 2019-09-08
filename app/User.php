<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Groups;

class User extends Authenticatable
{
    use Notifiable;

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
        //'password', 
		'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	//protected $appends = array('classroom');
	
	public function user_info()
    {
        if($this->role == 99){
			return [];
		}else if($this->role == 50){
			return $this->hasOne('App\Teacher','user_id','id');
		}{
			return $this->hasOne('App\Student','user_id','id');
		}
    }
	
	public function groups()
    {
        if($this->role == 99){
			return Group::all();
		}else if($this->role == 50){
			return Group::all();
		}{
			return $this->user_info->classroom->groups;
		}
    }
	
	public function ads_record()
    {
		return $this->hasMany('App\AdsRecord','student_id','id');
    }
	
	public function getAdCountAttribute()
    {
		return $this->ads_record->count();
    }
	/*
	public function getAvailabilityAttribute()
    {
        return $this->calculateAvailability();  
    }
	*/
}
