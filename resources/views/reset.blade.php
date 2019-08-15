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
		<div class="teacher_resetPassword">
			<p style="margin-bottom: 15px;" class="title-20">重新設定密碼</p>
			<hr class="line">
			<div class="teacher_resetPassword_main white_box_bg mb-30">
				<form>
					<div class="row" style="margin:0;">
						<div class="form-group">
							<label for="resetPassword" class="lable_title">輸入新密碼</label>
							<input style="width: 300px;" type="password" class="form-control" id="resetPassword">
						</div>
						<div class="form-group mr-30">
							<label for="resetPassword_confirm" class="lable_title">密碼再次確認</label>
							<input style="width: 300px;" type="password" class="form-control" id="resetPassword_confirm">
						</div>
					</div>
				</form>
			</div>
			<button type="submit" class="btn btn_style" onclick="location.href='login.html'">確認</button>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
	$("#submit_btn").click(function(){
		$.ajax({
		  type: 'POST',
		  url: "{{url('/forgot')}}",
		  data: $("form").serialize(),
		}).done(function(data) {
		  if(data.status == 'Fail'){
			  alert(data.message);
		  }else{
			  $("#forget_password").modal('show');
		  }
		});
		//$('form').submit();
	});
</script>
@endsection
