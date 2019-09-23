@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="col-12">
		<div class="student_questionaire">
			<p style="margin-bottom: 15px;" class="title-20 text-center">@if(isset($user))修改@else新增@endif學生資料</p>
			@if(isset($user))
				<form action="{{url('students/'.$id)}}" method="POST">
				@method('PUT')
			@else
				<form action="{{url('students/admin-create')}}" method="POST">
			@endif
			<div class="student_questionaire_main mb-30">
				<!--question form-->
				
					<div class="row" style="margin:0;">
						<div class="form-group float-left">
							<div><label for="edit_student_id" class="lable_title">學生ID</label></div>
							<div class="mr-3 float-left">
								<select id="teacher_id" name="teacher_id" class="browser-default custom-select" style="width: 200px;" required>
									<option value="" disabled selected hidden>任課教師</option>
									@foreach($teachers as $teacher)
									<option value="{{ $teacher->user_info->id }}">{{str_pad($teacher->user_info->id,3,'0',STR_PAD_LEFT)}} ({{ $teacher->name }}老師)</option>
									@endforeach
									<!--option value="1">001 (XXX老師)</option>
									<option value="2">002 (XXX老師)</option>
									<option value="3">003 (XX老師)</option-->
								</select>
							</div>
							<div class="mr-3 float-left">
								<select id="class_id" name="class_id" class="browser-default custom-select" style="width: 100px;" required>
									<option value="" disabled selected hidden>班級ID</option>
								</select>
							</div>
							<div class="mr-3 float-left">
								<input type="number" class="form-control" id="student_id" name="student_id" placeholder="編號" style="width: 150px;" min="1" max="99" required>
							</div>
						</div>
						<div class="form-group mr-3">
							<label for="edit_teacher_name" class="lable_title">姓名</label>
							<input type="text" class="form-control" id="student_name" name="name" style="width: 150px;" required>
						</div>
					</div>
					<div class="form-group">
						<label for="student_gender" class="lable_title">性別</label>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" id="male" value="1" required>
							<label class="form-check-label" for="male">男</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" id="female" value="2">
							<label class="form-check-label" for="female">女</label>
						</div>
					</div>
					
					<!--Q1-->
					<div class="form-group">
						<div><label for="stu_question_1" class="lable_title" >你每天花多少時間使用電腦？(單選)</label></div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_1" id="1" value="1" required>
							<label class="form-check-label" for="inlineRadio1">少於30分鐘</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_1" id="2" value="2">
							<label class="form-check-label" for="inlineRadio2">30分鐘到1小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_1" id="3" value="3">
							<label class="form-check-label" for="inlineRadio3">1到2小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_1" id="4" value="4">
							<label class="form-check-label" for="inlineRadio4">2小時以上</label>
						</div>
					</div>
					<!--Q2-->
					<div class="form-group">
						<div><label for="stu_question_2" class="lable_title">你每天大約花多少時間在網路上尋找及閱讀資訊？(單選)</label></div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_2" id="inlineRadio1" value="1" required>
							<label class="form-check-label" for="inlineRadio1">少於30分鐘</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_2" id="inlineRadio2" value="2" required>
							<label class="form-check-label" for="inlineRadio2">30分鐘到1小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_2" id="inlineRadio3" value="3" required>
							<label class="form-check-label" for="inlineRadio3">1到2小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_2" id="inlineRadio4" value="4" required>
							<label class="form-check-label" for="inlineRadio4">2小時以上</label>
						</div>
					</div>
					<!--Q3-->
					<div class="form-group">
						<div><label for="stu_question_3" class="lable_title">我很會打字(單選)</label></div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_3" id="inlineRadio1" value="1" required>
							<label class="form-check-label" for="inlineRadio1">非常同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_3" id="inlineRadio2" value="2" required>
							<label class="form-check-label" for="inlineRadio2">有點同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_3" id="inlineRadio3" value="3" required>
							<label class="form-check-label" for="inlineRadio3">有點不同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_3" id="inlineRadio4" value="4" required>
							<label class="form-check-label" for="inlineRadio4">非常不同意</label>
						</div>
					</div>
					<!--Q4-->
					<div class="form-group">
						<div><label for="stu_question_4" class="lable_title">在網路上尋找資訊對我來說是容易的(單選)</label></div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_4" id="inlineRadio1" value="1" required>
							<label class="form-check-label" for="inlineRadio1">非常同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_4" id="inlineRadio12" value="2" required>
							<label class="form-check-label" for="inlineRadio2">有點同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_4" id="inlineRadio3" value="3" required>
							<label class="form-check-label" for="inlineRadio3">有點不同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_4" id="inlineRadio4" value="4" required>
							<label class="form-check-label" for="inlineRadio4">非常不同意</label>
						</div>
					</div>
				
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn_style">@if(isset($user))修改@else新增@endif</button>
					<button type="" class="btn btn_cancel" onclick="history.back()">返回</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
var class_map = {!! json_encode($class_map) !!}
$("#teacher_id").change(function(){
	$("#class_id").empty();
	console.log($(this).val());
	console.log(class_map[$(this).val()]);
	var temp = class_map[$(this).val()];
	for(x in temp){
		var id = temp[x]['id'];
		var val = temp[x]['val'];
		$("#class_id").append("<option value='"+id+"'>"+val+"</option>");
	}
});

@if(isset($user))
	var user = {!! json_encode($user) !!};
	var student = {!! json_encode($student) !!};
	
	$("[name='teacher_id']").val(parseInt(user.account.slice(0, 3))).change();
	$("[name='class_id']").val(student.classroom_id);
	$("[name='student_id']").val(parseInt(user.account.slice(4, 7)));
	
	$("[name='name']").val(user.name);
	$("[name='gender']").filter('[value='+user.gender+']').prop('checked', true);
	
	$("[name='stu_question_1']").filter('[value='+student.computer+']').prop('checked', true);
	$("[name='stu_question_2']").filter('[value='+student.search_time+']').prop('checked', true);
	$("[name='stu_question_3']").filter('[value='+student.typing+']').prop('checked', true);
	$("[name='stu_question_4']").filter('[value='+student.search_easy+']').prop('checked', true);

@endif


</script>
@endsection

