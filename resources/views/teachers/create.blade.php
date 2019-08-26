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
		<div class="teacher_signup">
			<p style="margin-bottom: 15px;" class="title-20 text-center">新增教師資料</p>
			<form action="{{url('teachers')}}" method="POST">
			<div class="teacher_signup_main mb-30">
					<div class="row" style="margin:0;">
						<div class="form-group mr-30">
							<label for="teacher_name" class="lable_title">姓名</label>
							<input style="width: 300px;" type="text" class="form-control" id="teacher_name" name="name" required>
						</div>
						<label for="teacher_gender" class="lable_title">性別</label>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" id="male" value="1" required>
							<label class="form-check-label" for="teacher_gender">男</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" id="female" value="2">
							<label class="form-check-label" for="teacher_gender">女</label>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="mr-30">
						   <div><label for="teacher_city" class="lable_title">所屬縣市</label></div>
							<select class="browser-default custom-select"  name="city_id" style="width: 300px;" required>
							<option value="1">新北市</option>
							<option value="2">台北市</option>
							<option value="3">台中市</option>
							</select>  
						</div>
						<div class="mb-15">
							<div><label for="teacher_school" class="lable_title">服務學校</label></div>
							<select class="browser-default custom-select" name="school_id" style="width: 300px;" required>
								<option value="1">XX國民小學</option>
								<option value="2">XX國民小學</option>
								<option value="3">XX國民小學</option>
							</select>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="mr-30">
							<div><label for="teacher_grade" class="lable_title">任教年級</label></div>
							<select class="browser-default custom-select" name="grade" style="width: 300px;" required>
								<option value="1">二</option>
								<option value="2">三</option>
								<option value="3">四</option>
							</select>
						</div>
						<div class="mb-15">
							<div class="form-group">
								<label for="teacher_class" class="lable_title">任教班級</label>
								<input type="text" class="form-control" name="classroom" id="teacher_class" style="width: 300px;" required>
							</div>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="mb-15" id="teacher_subject">
							<div><label for="teacher_subject" class="lable_title">任教科目</label></div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="subject[]" id="inlineCheckbox1" value="chinese">
								<label class="form-check-label" for="teacher_subject">國語</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="subject[]" id="inlineCheckbox2" value="science">
								<label class="form-check-label" for="teacher_subject">自然</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="subject[]" id="inlineCheckbox3" value="social">
								<label class="form-check-label" for="teacher_subject">社會</label>
							</div>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="form-group mr-30">
							<label for="teacher_email" class="lable_title">E-mail</label>
							<input type="email" class="form-control" id="teacher_email" name="account" style="width: 300px;" required>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="form-group mr-30">
							<label for="teacher_password" class="lable_title">密碼</label>
							<input type="password" class="form-control" id="teacher_password" name="password" style="width: 300px;" required>
						</div>
						<div class="form-group mr-30">
							<label for="teacher_password_again" class="lable_title">密碼再次確認</label>
							<input type="password" class="form-control" id="teacher_password_again" style="width: 300px;" required>
						</div>
					</div>
					<p class="status_text" style="text-align: left">*以上資料皆為必填, 不能空白</p>
				
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn_style">新增</button>
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
/*
	$("form").submit(function(e) {
		e.preventDefault();
		$.ajax({
		  type: 'POST',
		  url: $("form").attr('action'),
		  data: $("form").serialize(),
		}).done(function(data) {
		  if(data.success){
			  $("#teacher_addClassNum").modal('show');
		  }else{
			  alert(data.message);
		  }
		});
		//$('form').submit();
	});*/
</script>
@endsection
