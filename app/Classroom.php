<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
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
	
	public function number_student()
    {
        $teacher_id = str_pad($this->teacher_id,3,'0',STR_PAD_LEFT);
		return User::where('account','like',$teacher_id . $this->class_number . '%')->count();
    }
	
	public function users()
    {
		 $teacher_id = str_pad($this->teacher_id,3,'0',STR_PAD_LEFT);
		 return User::where('account','like',$teacher_id . $this->class_number . '%');
    }
	
	public function students()
    {
		 return $this->hasMany('App\Student','classroom_id','id');
    }
	
	public function delete()
	{
		$this->users()->delete();
		$this->students()->delete();

		return parent::delete(); 
	}
	
}
