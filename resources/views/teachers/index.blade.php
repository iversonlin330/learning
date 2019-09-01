@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="teacher_edit">
		<div class="filter">
			<input class="form-control large_filter" id="teacher_date_search" type="text" placeholder="Search.." style="margin-right: 0;">
			<div class="btn"><img src="img/search.png" alt=""></div>
		</div>
		<div class="top_right_button">
			<button class="btn btn_function" onclick="location.href='{{url('teachers/create')}}'">新增資料</button>
			<button class="btn btn_function">資料匯出</button>
		</div>
		<div class="teacher_edit_table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width:5%;vertical-align:middle;">ID</th>
						<th style="width:10%;">姓名</th>
						<th style="width:5%;">性別</th>
						<th style="width:10%;">所屬縣市</th>
						<th style="width:15%;">服務學校</th>
						<th style="width:5%;">任教年級</th>
						<th style="width:5%;">任教班級</th>
						<th style="width:5%;">任教科目</th>
						<th style="width:15%;">E-mail</th>
						<th style="width:10%;">密碼</th>
						<th style="width:10%;">功能</th>
					</tr>
				</thead>
				<tbody id="teacher_date">
				@foreach($users as $user)
				<tr data-id="{{$user->id}}">
					<td>{{$user->user_info->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->gender}}</td>
					<td>{{$user->user_info->city_id}}</td>
					<td>{{$user->user_info->school_id}}</td>
					<td>{{$user->user_info->grade}}</td>
					<td>{{$user->user_info->classroom}}</td>
					<td>{{ implode(',',$user->user_info->subject) }}</td>
					<td>{{$user->account}}</td>
					<td>{{$user->password}}</td>
					<td class="td-underline">
						<a href="{{ url('teachers/'.$user->id.'/edit') }}" style="float: left; margin-right: 10px;">編輯</a>
						@if(0)
						<a class="delete" href="#">刪除</a>
						@endif
					</td>
				</tr>
				@endforeach
					<!--tr>
						<td>A001</td>
						<td>王大明</td>
						<td>男</td>
						<td>新北市</td>
						<td>ＸＸ國民小學</td>
						<td>三</td>
						<td>甲</td>
						<td>自然</td>
						<td>oooooo@gmai.com</td>
						<td>password</td>
						<td class="td-underline">
							<a href="" style="float: left; margin-right: 10px;">編輯</a>
							<a href="" data-toggle="modal" data-target="#delete">刪除</a>
						</td>
					</tr>
					<tr>
						<td>A002</td>
						<td>黃小明</td>
						<td>男</td>
						<td>新北市</td>
						<td>ＸＸ國民小學</td>
						<td>三</td>
						<td>甲</td>
						<td>自然</td>
						<td>oooooo@gmai.com</td>
						<td>password</td>
						<td class="td-underline">
							<a href="" style="float: left; margin-right: 10px;">編輯</a>
							<a href="" data-toggle="modal" data-target="#delete">刪除</a>
						</td>
					</tr><tr>
						<td>A003</td>
						<td>林小美</td>
						<td>女</td>
						<td>新北市</td>
						<td>ＸＸ國民小學</td>
						<td>三</td>
						<td>甲</td>
						<td>自然</td>
						<td>oooooo@gmai.com</td>
						<td>password</td>
						<td class="td-underline">
							<a href="" style="float: left; margin-right: 10px;">編輯</a>
							<a href="" data-toggle="modal" data-target="#delete">刪除</a>
						</td>
					</tr-->
				</tbody>
			</table>
		</div>
		<!-- 刪除確認-彈跳視窗 -->
		<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body pop-up text-center">
						<p>確認刪除此筆資料嗎？</p>
						<form action="{{url('classroom')}}" method="POST">

					</div>
				</div>
			</div>
		</div>
		<button type="" class="btn btn_style" onclick="location.href='{{ url('groups') }}'">返回</button>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
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
	});
	
	$(".delete").click(function(){
		$("#delete form").attr('action',"{{url('teachers/')}}/"+$(this).closest('tr').data('id'));
		$("#delete").modal('show');
	})
	
	
</script>
@endsection
