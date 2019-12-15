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
	<form action="{{url('surveys/'.$survey->id)}}" method="post">
	@method('PUT')
		<div class="student_questionaire">
			<p style="margin-bottom: 15px;" class="title-20">學生問券編輯</p>
			<hr class="line">
			<div class="student_questionaire_main mb-30">
				<!--question form-->
				
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<label for="teacher_email" class="lable_title">題組名稱</label>
						<input type="text" class="form-control" id="teacher_email" name="title" style="width: 300px;" value="{{ $survey->title }}"required>
					</div>
				</div>
				@for($i = 0; $i < 5; $i ++)
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<label for="teacher_email" class="lable_title">選項{{$i+1}}</label>
						<input type="text" class="form-control" id="teacher_email" name="item[{{$i}}]" style="width: 300px;" value="{{ array_key_exists($i,$survey->item)? $survey->item[$i] : '' }}">
					</div>
				</div>
				@endfor
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<label for="teacher_email" class="lable_title">是否隱藏</label>
					<br>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="is_hide" value="1">
					  <label class="form-check-label" for="inlineCheckbox1">是</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="is_hide" value="0">
					  <label class="form-check-label" for="inlineRadio2">否</label>
					</div>
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
@if(isset($survey))
	var survey = {!! json_encode($survey) !!};
	
	//$("[name='teacher_id']").val(parseInt(user.account.slice(0, 3))).change();
	
	$("[name='subject']").val(group.subject);
	$("[name='grade']").val(group.grade);
	$("[name='is_hide']").filter('[value='+group.is_hide+']').prop('checked', true);
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

