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
						<input type="text" class="form-control" id="teacher_email" name="subject" style="width: 300px;" value="{{ $group->subject }}" required>
					</div>
				</div>
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<label for="teacher_email" class="lable_title">年級</label>
						<input type="text" class="form-control" id="teacher_email" name="grade" style="width: 300px;" value="{{ $group->grade }}" required>
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

</script>
@endsection

