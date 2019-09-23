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
	<form action="{{url('groups/'.$id)}}" method="post">
	@method('PUT')
		<div class="student_questionaire">
			<p style="margin-bottom: 15px;" class="title-20">題組資訊編輯</p>
			<hr class="line">
			<div class="student_questionaire_main mb-30">
				<!--question form-->
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<label for="teacher_email" class="lable_title">科目</label>
						<select class="form-control" name="subject" style="width: 300px;" required>
							<option value="國語">國語</option>
							<option value="自然">自然</option>
							<option value="社會">社會</option>
						</select>
						<!--input type="text" class="form-control" id="teacher_email" name="subject" style="width: 300px;" value="{{ $group->subject }}" required-->
					</div>
				</div>
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<label for="teacher_email" class="lable_title">年級</label>
						<select class="form-control" name="grade" style="width: 300px;" required>
							<option value="二">二</option>
							<option value="三">三</option>
							<option value="四">四</option>
							<option value="五">五</option>
							<option value="六">六</option>
						</select>
						<!--input type="text" class="form-control" id="teacher_email" name="grade" style="width: 300px;" value="{{ $group->grade }}" required-->
					</div>
				</div>
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<label for="teacher_email" class="lable_title">題組名稱</label>
						<input type="text" class="form-control" id="teacher_email" name="title" style="width: 300px;" value="{{ $group->title }}"required>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn_style">送出</button>
		</div>
		</form>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
@if(isset($group))
	var group = {!! json_encode($group) !!};
	
	//$("[name='teacher_id']").val(parseInt(user.account.slice(0, 3))).change();
	$("[name='subject']").val(group.subject);
	$("[name='grade']").val(group.grade);
	//$("[name='student_id']").val(parseInt(user.account.slice(4, 7)));
	
	$("[name='name']").val(user.name);
	$("[name='gender']").filter('[value='+user.gender+']').prop('checked', true);
	
	$("[name='stu_question_1']").filter('[value='+student.computer+']').prop('checked', true);
	$("[name='stu_question_2']").filter('[value='+student.search_time+']').prop('checked', true);
	$("[name='stu_question_3']").filter('[value='+student.typing+']').prop('checked', true);
	$("[name='stu_question_4']").filter('[value='+student.search_easy+']').prop('checked', true);

@endif
</script>
@endsection

