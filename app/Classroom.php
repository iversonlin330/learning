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
	
	public function groups()
	{
		return $this->belongsToMany('\App\Group','group_classroom','classroom_id','group_id');
	}
	
	public function groups_rate($group_id)
	{
		//dd($this->belongsToMany('\App\Group','group_classroom','classroom_id','group_id'));
		//return '80%';
		//echo $this->id.$group_id;
		$classroom = Classroom::find($this->id);
		$group = Group::find($group_id);
		
		$questions = $group->questions;
		$user_ids = $classroom->students->pluck('user_id')->toArray();
		$question_ids = $group->questions->pluck('id')->toArray();
		//var_dump($group);
		$user_answers = UserAnswer::whereIn('question_id',$question_ids)
			->whereIn('user_id',$user_ids)
			->get();
		$result = [];
		$total = 0;
		$correct = 0;
		foreach($questions as $question){
			$answers = $user_answers->where('question_id',$question->id);
			if($question->type == 1){
				/*
				foreach($answers as $index => $answer){
					$result[$question->id][] = $answer->answer;
				}
				*/
			}elseif($question->type == 2){
				$total = $total + $answers->count();
				$correct = $answers->where('answer',$question->correct_answer)->count();
				//$result[$question->id] = [$A,$B,$C,$D];
			}elseif($question->type == 3){
				/*
				$total = $A = $B = $C = $D = 0;
				foreach($answers as $index => $answer){
					$temp = json_decode($answer->answer,true);
					$total = $total + count($temp);
					foreach($temp as $v){
						if($v == 'A') $A++;
						elseif($v == 'B') $B++;
						elseif($v == 'C') $C++;
						elseif($v == 'D') $D++;
					}
				}
				$result[$question->id] = [
					round($A/$total*100),
					round($B/$total*100),
					round($C/$total*100),
					round($D/$total*100),
				];
				*/
			}
		}
		//dd($correct,$total);
		if($correct ==0 || $total == 0){
			return '0%';
		}else{
			return round($correct/$total*100).'%';
		}
	}
	
	public function teacher()
    {
		return $this->hasOne('App\Teacher','id','teacher_id');
    }
	
}
