<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1200, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	@section('style')
		<!--link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.css"-->
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	@show
    <title>數位閱讀學習平台</title>
	<script type="text/javascript" src="{{ asset('js/ckeditor.js') }}"></script>
</head>

<body class="gradient">
    @if(Auth::check() && Auth::user()->name != 'student' && !Request::is('reset'))
	<header>
        <nav class="nav-bar">
            <a class="brand">數位閱讀學習平台</a>
            <a type="submit" class="btn btn_logout" href="{{url('logout')}}">登出</a>
            @if(Auth::user()->role >=50)
			<div class="dropdown" style="float:right;">
                <button class="dropbtn"><img src="{{ asset('img/nav_settings.png') }}" alt=""></button>
                <div class="dropdown-content">
					@if(Auth::user()->role == 50)
					<a href="{{url('classrooms')}}">學生資料設定</a>
                    @endif
					@if(Auth::user()->role == 99)
					<a href="{{url('teachers')}}">教師資料維護</a>
                    <a href="{{url('students')}}">學生資料維護</a>
                    <a href="{{url('records')}}">作答記錄查看</a>
                    <a href="{{url('ads')}}">廣告點擊報告</a>
					@endif
                </div>
            </div>
			@endif
			
			<p class="nav_name">哈囉！{{Auth::user()->name}}</p>
        </nav>
    </header>
	@endif
		<section>
            @yield('content')
        </section>
		@section('script')
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
		
        @show
</body>
</html>