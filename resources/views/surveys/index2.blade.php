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
	<a href="{{url('classrooms/create')}}">建立</a>
		<table>
			<thead>
				<th>ID</th>
				<th>年級</th>
				<th>班級</th>
				<th>人數</th>
				<th>動作</th>
			</thead>
			<tbody>
			@foreach($classrooms as $classroom)
				<tr>
					<td>{{ $classroom->class_number }}<td>
					<td>{{ $classroom->grade }}<td>
					<td>{{ $classroom->classroom }}<td>
					<td>{{ $classroom->number_student() }}<td>
					<td><a href="{{url('classrooms/'.$classroom->id.'/edit')}}">編輯</a>&nbsp<a href="{{url('classrooms/'.$classroom->id.'/delete')}}">刪除</a><td>
				</tr>
			@endforeach
				
			</tbody>
		</table>
    </body>
</html>
