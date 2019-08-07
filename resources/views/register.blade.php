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
		老師註冊
		<form action="{{url('registers')}}" method="post">
			@csrf
			姓名<input type="text" name="name" />
			性別<input type="text" name="name" />
			所屬縣市
			<select>
					<option></option>
			</select>
			服務學校
			<input type="text" name="name" />
			任教年級
			<input type="text" name="name" />
			任教班級
			<input type="text" name="name" />
			任教科目
			<input type="text" name="name" />
			Email
			<input type="text" name="name" />
			密碼
			<input type="text" name="name" />
			密碼再次確認
			<input type="text" name="name" />
			<input type="text" name="role" value="1" hidden>
			<input type="submit">
		</form>
    </body>
</html>
