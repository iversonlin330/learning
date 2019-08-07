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
	<div><a href="{{url('classrooms')}}">學生資料設定</a></div>
		<table>
			<thead>
				<th>ID</th>
				<th>科目</th>
				<th>年級</th>
				<th>題組名稱</th>
				<th>動作</th>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#">開始作答</a>
						<a href="#">瀏覽題目</a>
						<a href="#">指定班級作答</a>
					</td>
				</tr>
			</tbody>
		</table>
    </body>
</html>
