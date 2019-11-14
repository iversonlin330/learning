<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
		$data = $request->all();
		$group_id = $data['group_id'];
		return view('questions.create',compact('group_id'));
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
		$data = $request->all();
		Question::create([
			'no' => Question::where('group_id',$data['group_id'])->max('no')+1,
			'name' => $data['name'],
			'item' => json_encode(explode('@',$data['item']),JSON_UNESCAPED_UNICODE),
			//'item' => '',
			'type' => $data['type'],
			'group_id' => $data['group_id'],
			'correct_answer' => $data['correct_answer'],
			'grade' => $data['grade'],
			'history' => $data['history'],
			'goal' => $data['goal'],
		]);
		
		return redirect('/groups/'.$data['group_id']);
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
		$question = Question::find($id);
		$group_id = $question->group_id;
		$question->item = implode('@',json_decode($question->item,true));
		//dd($question->item);
		return view('questions.create',compact('id','question','group_id'));
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
		
		$data = $request->all();
		
		$question = Question::find($id);
		
		$question->update([
			//'no' => 1,
			'name' => $data['name'],
			'item' => json_encode(explode('@',$data['item']),JSON_UNESCAPED_UNICODE),
			//'item' => '',
			'type' => $data['type'],
			//'group_id' => $data['group_id'],
			'correct_answer' => $data['correct_answer'],
			'grade' => $data['grade'],
			'history' => $data['history'],
			'goal' => $data['goal'],
		]);
		
		return redirect('/groups/'.$question->group_id);
		
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
}
