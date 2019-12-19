<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Classroom;
use App\Student;
use App\User;
use App\Teacher;
use App\Survey;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$users = User::with('user_info')->where('role',1)->get();
		$surveys = Survey::all();
		//dd($users);
		return view('students.index',compact('users','surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$surveys = Survey::all();
		return view('students.create',compact('surveys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$user = Auth::user();
		$data = $request->all();
		
		User::where('id',$user->id)
			->update([
				'name' =>$data['name'],
				'gender' =>$data['gender']
			]);
			
		Student::where('user_id',$user->id)
			->update([
				//'computer' =>$data['stu_question_1'],
				//'search_time' =>$data['stu_question_2'],
				//'typing' =>$data['stu_question_3'],
				//'search_easy' =>$data['stu_question_4'],
				'survey' =>json_encode($data['survey']),
			]);
			
		return redirect('groups');
		/*
		dd($data);
		$teacher_id = intval(substr($user->account,0,3));
		$class_number = substr($user->account,3,1);
		$classroom = Classroom::where('teacher_id',$teacher_id)
			->where('class_number',$class_number)
			->first();
		$data = [
			'user_id' => $user->id,
			'classroom_id' => $classroom->id,
			'computer' => $user->id,
			'search_time' => $user->id,
			'typing' => $user->id,
			'search_easy' => $user->id,
		];
		
		Student::create([
			'user_id' => $user->id,
			'classroom_id' => $classroom->id,
			'computer' => $user->id,
			'search_time' => $user->id,
			'typing' => $user->id,
			'search_easy' => $user->id,
		]);
		dd($data);
		*/
    }
	
	public function getAdminCreate()
    {
        //
		$teachers = User::where('role',50)->get();
		$class_map = [];
		
		foreach($teachers as $teacher){
			foreach($teacher->user_info->classrooms as $classroom){
				$class_map[$teacher->user_info->id][] = [
					'id' => $classroom->id,
					'val' =>$classroom->class_number
				];
			}
		}
		$surveys = Survey::all();
		return view('students.adminCreate',compact('teachers','class_map','surveys'));
    }
	
	public function postAdminCreate(Request $request)
    {
        //
		$user = Auth::user();
		$data = $request->all();
		
		$classroom = Classroom::find($data['class_id']);
		
		$account = str_pad($data['teacher_id'],3,'0',STR_PAD_LEFT) . $classroom->class_number . str_pad($data['student_id'],3,'0',STR_PAD_LEFT);
		
		$is_exist = User::where('account',$account)->first();
		
		if($is_exist){
			return back()->withErrors(['msg', '重複']);
		}
		
		$new_user = User::create([
			'account' => $account,
			'name' => $data['name'],
			'role' => 1,
			'gender' => $data['gender'],
		]);
		
		Student::create([
			'user_id' => $new_user->id,
			'classroom_id' => $data['class_id'],
			//'computer' =>$data['stu_question_1'],
			//'search_time' =>$data['stu_question_2'],
			//'typing' =>$data['stu_question_3'],
			//'search_easy' =>$data['stu_question_4'],
			'survey' =>$data['survey'],
		]);
		/*
		
		User::where('id',$user->id)
			->create([
				'name' =>$data['name'],
				'gender' =>$data['gender']
			]);
			
		Student::where('user_id',$user->id)
			->update([
				'computer' =>$data['stu_question_1'],
				'search_time' =>$data['stu_question_2'],
				'typing' =>$data['stu_question_3'],
				'search_easy' =>$data['stu_question_4'],
			]);
		*/
		return redirect('students');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$user = User::find($id);
		$student = $user->user_info; 
		$teachers = User::where('role',50)->get();
		$class_map = [];
		
		foreach($teachers as $teacher){
			foreach($teacher->user_info->classrooms as $classroom){
				$class_map[$teacher->user_info->id][] = [
					'id' => $classroom->id,
					'val' =>$classroom->class_number
				];
			}
		}
		$surveys = Survey::all();
		return view('students.adminCreate',compact('id','user','student','teachers','class_map','surveys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$user = Auth::user();
		$data = $request->all();
		
		$classroom = Classroom::find($data['class_id']);
		$new_user = User::find($id);
		
		$account = str_pad($data['teacher_id'],3,'0',STR_PAD_LEFT) . $classroom->class_number . str_pad($data['student_id'],3,'0',STR_PAD_LEFT);
		
		$is_exist = User::where('account',$account)->where('id','!=',$id)->first();
		
		if($is_exist){
			return back()->withErrors(['msg', '重複']);
		}
		
		
		$new_user->update([
			'account' => $account,
			'name' => $data['name'],
			'gender' => $data['gender'],
		]);
		
		$new_user->user_info->update([
			//'user_id' => $new_user->id,
			'classroom_id' => $classroom->id,
			//'computer' =>$data['stu_question_1'],
			//'search_time' =>$data['stu_question_2'],
			//'typing' =>$data['stu_question_3'],
			//'search_easy' =>$data['stu_question_4'],
			'survey' =>$data['survey'],
		]);

		return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function export()
    {
        //
		return Excel::download(new StudentsExport, '學生.xlsx');
    }
}
