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
	<form action="{{url('students')}}" method="post">
		<div class="student_questionaire">
			<p style="margin-bottom: 15px;" class="title-20">學生問卷調查</p>
			<hr class="line">
			<div class="student_questionaire_main mb-30">
				<!--question form-->
				
					<div class="row" style="margin:0;">
					   <div class="form-group mr-30">
							<label  for="student_name" class="lable_title">姓名</label>
							<input type="text" class="form-control" id="student_name" name="name" style="width: 300px;" required>
						</div> 
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
							<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio1" value="1" required>
							<label class="form-check-label" for="inlineRadio1">少於30分鐘</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio2" value="2">
							<label class="form-check-label" for="inlineRadio2">30分鐘到1小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio3" value="3">
							<label class="form-check-label" for="inlineRadio3">1到2小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio4" value="4">
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
							<input class="form-check-input" type="radio" name="stu_question_2" id="inlineRadio2" value="2">
							<label class="form-check-label" for="inlineRadio2">30分鐘到1小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_2" id="inlineRadio3" value="3">
							<label class="form-check-label" for="inlineRadio3">1到2小時</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_2" id="inlineRadio4" value="4">
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
							<input class="form-check-input" type="radio" name="stu_question_3" id="inlineRadio2" value="2">
							<label class="form-check-label" for="inlineRadio2">有點同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_3" id="inlineRadio3" value="3">
							<label class="form-check-label" for="inlineRadio3">有點不同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_3" id="inlineRadio4" value="4">
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
							<input class="form-check-input" type="radio" name="stu_question_4" id="inlineRadio12" value="2">
							<label class="form-check-label" for="inlineRadio2">有點同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_4" id="inlineRadio3" value="3">
							<label class="form-check-label" for="inlineRadio3">有點不同意</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="stu_question_4" id="inlineRadio4" value="4">
							<label class="form-check-label" for="inlineRadio4">非常不同意</label>
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

