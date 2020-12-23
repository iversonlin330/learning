<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
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
        //'email_verified_at' => 'datetime',
		'subject' => 'array'
    ];
	
	public function classrooms()
    {
		return $this->hasMany('App\Classroom','teacher_id','id');
    }
	
	public function user()
    {
		return $this->hasOne('App\User','id','user_id');
    }
	
	public function getTIdAttribute()
    {
        return 'T'.str_pad($this->id,4,'0',STR_PAD_LEFT);
    }
}
