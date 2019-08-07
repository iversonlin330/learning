<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>數位閱讀學習平台</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
	<span>Hello, {{Auth::user()->name}} <a href="{{url('logout')}}">登出</a></span>
	<br>
	<span>班級資料建立</a>
		<form action="{{url('classrooms')}}" method="post">
		@csrf
			<select name="grade">
				<option>年級</option>
			</select>
			<select name="class">
				<option>班級</option>
			</select>
			<input name="class_id"/>
			<input type="number" name="number_of poeple"/>
			<input type="submit">
		</form>
    </body>
</html>
