@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="student_edit">
		<div class="filter">
			<input class="form-control large_filter" id="student_date_search" type="text" placeholder="Search.." style="margin-right: 0;">
			<div class="btn"><img src="img/search.png" alt=""></div>
		</div>
		<div class="top_right_button">
			<button class="btn btn_function" onclick="location.href='{{url('students/admin-create')}}'">新增資料</button>
			<button class="btn btn_function" onclick="location.href='{{url('students/export')}}'">資料匯出</button>
		</div>
		<div class="student_edit_table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width:8%;">ID</th>
						<th style="width:8%;">學生ID</th>
						<th style="width:8%;">姓名</th>
						<th style="width:5%;">性別</th>
						<th style="width:15%;">就讀學校</th>
						<th style="width:5%;">年級</th>
						<th style="width:5%;">班級</th>
						<th style="width:10%;">使用時間</th>
						<th style="width:10%;">尋找資訊時間</th>
						<th style="width:8%;">自評打字能力</th>
						<th style="width:8%;">自評尋找資訊</th>
						<th style="width:10%;">功能</th>
					</tr>
				</thead>
				<tbody id="student_date">
				@foreach($users as $user)
				<tr>
					<td>{{ $user->user_info->s_id }}</td>
					<td>{{ $user->account }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ Config::get('map.gender')[$user->gender] }}</td>
					<td>{{ $user->user_info->classroom->teacher->school_id }}</td>
					<td>{{ $user->user_info->classroom->grade }}</td>
					<td>{{ $user->user_info->classroom->classroom }}</td>
					<td>{{ Config::get('map.computer')[$user->user_info->computer] }}</td>
					<td>{{ Config::get('map.search_time')[$user->user_info->search_time] }}</td>
					<td>{{ Config::get('map.typing')[$user->user_info->typing] }}</td>
					<td>{{ Config::get('map.search_easy')[$user->user_info->search_easy] }}</td>
					<td class="td-underline">
						<a href="{{url('students/'.$user->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯</a>
						@if(0)
						 <a href="" data-toggle="modal" data-target="#delete">刪除</a>
						@endif
					</td>
				</tr>
				@endforeach
					<!--tr>
						<td>S00001</td>
						<td>001A01</td>
						<td>李小美</td>
						<td>女</td>
						<td>ＸＸＸＸＸ國民小學</td>
						<td>三</td>
						<td>甲</td>
						<td>少於30分鐘</td>
						<td>少於30分鐘</td>
						<td>非常同意</td>
						<td>非常同意</td>
						<td class="td-underline">
							<a href="" style="float: left; margin-right: 10px;">編輯</a>
							 <a href="" data-toggle="modal" data-target="#delete">刪除</a>
						</td>
					</tr>
					<tr>
						<td>S00002</td>
						<td>001A02</td>
						<td>李小美</td>
						<td>女</td>
						<td>ＸＸＸＸＸ國民小學</td>
						<td>三</td>
						<td>甲</td>
						<td>少於30分鐘</td>
						<td>少於30分鐘</td>
						<td>非常同意</td>
						<td>非常同意</td>
						<td class="td-underline">
							<a href="" style="float: left; margin-right: 10px;">編輯</a>
							 <a href="" data-toggle="modal" data-target="#delete">刪除</a>
						</td>
					</tr>
					<tr>
						<td>S00003</td>
						<td>001A03</td>
						<td>李小美</td>
						<td>女</td>
						<td>ＸＸＸＸＸ國民小學</td>
						<td>三</td>
						<td>甲</td>
						<td>少於30分鐘</td>
						<td>少於30分鐘</td>
						<td>非常同意</td>
						<td>非常同意</td>
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
						<button type="button" class="btn btn_style" data-dismiss="modal">確認</button>
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

</script>
@endsection

