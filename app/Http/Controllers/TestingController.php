<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class TestingController extends Controller
{
    //
	public function index($id){
		$group = Group::find($id);
		$questions = $group->question;
		return view('testings.index',compact('group','questions'));
	}
}
