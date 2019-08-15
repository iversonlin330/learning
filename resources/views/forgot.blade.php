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
		<div class="teacher_forgotPassword">
			<p style="margin-bottom: 15px;" class="title-20">忘記密碼</p>
			<hr class="line">
			<div class="teacher_forgotPassword_main white_box_bg mb-30">
				<form action="{{url('/forgot')}}" method="post">
					<div class="row" style="margin:0;">
						<div class="form-group">
							<label for="forgotPassword" class="lable_title">輸入電子信箱</label>
							<input style="width: 300px;" type="email" class="form-control" id="forgotPassword" name="email">
						</div>
					</div>
				</form>
			</div>
			<button id="submit_btn" type="submit" class="btn btn_style">確認</button>
		</div>
	</div>
	<!-- 重設密碼彈跳視窗 -->
	<div class="modal fade" id="forget_password" tabindex="-1" role="dialog" aria-labelledby="forget_password"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body pop-up text-center">
					<p>已經傳送郵件至您的信箱<br>
						請至信箱點擊連結完成認證</p>
					<button type="button" class="btn btn_style" data-dismiss="modal"onclick="location.href='{{url('/')}}'">確認</button>
				</div>
			</div>
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
