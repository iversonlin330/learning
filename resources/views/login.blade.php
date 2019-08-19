@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="row">
		<div class="col-xs-12 mx-auto">
			<div class="login">
				<p class="title-20 text-center">數位閱讀學習平台</p>
				<div class="login_left">
					<a href="#"><img src="img/explanation.png" alt=""></a>
				</div>
				<div class="login_right">
				<p class="title-20 text-center mb-15">登入 LOGIN</p>
					<div class="clearfix"></div>
					<div class="login_box">
						<div class="login_header">
							<a href="#" class="active" id="student_login">學生登入</a>
							<a href="#" id="teacher_login">老師/管理員登入</a>
						</div>
						<form class="student_login mt-5" action="{{url('login')}}" method="post">
						@csrf
							<div class="login-form mb-30">
								<input type="text" name="account" placeholder="輸入學生ID" />
								<input type="text" name="role" value="1" hidden>
							</div>
							<button type="submit" class="btn btn_style">登入</button>
						</form>
						<form class="teacher_login" action="{{url('login')}}" method="post">
						@csrf
							<div class="login-form">
								<input type="email" name="account" placeholder="Email" />
							</div>
							<div class="login-form">
								<input type="password" name="password" placeholder="密碼" />
							</div>
							<div class="mb-30">
								<!--a href="UC2-PF4_forgot_password.html" class="signup">忘記密碼?</a>
								<a href="UC2-PF2_teacher_signup.html" class="signup">申請帳號</a-->
								<a href="{{url('forgot')}}" class="signup">忘記密碼?</a>
								<a href="{{url('registers')}}" class="signup">申請帳號</a-->
							</div>
							<button  type="submit" class="btn btn_style">登入</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
    $(function() {
    });
</script>
@endsection