@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="admin_view_detial">
		<p class="title-brown"></p>
		<div class="top_right_button">
			<button class="btn btn_function" onclick="location.href='{{  url('surveys/create') }}'">新增問卷</button>
		</div>
		<div class="view_detial_table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th >題目</th>
						<th >選項</th>
						<th >功能</th>
						<th >隱藏</th>
					</tr>
				</thead>
				<tbody>
				@foreach($surveys as $survey)
					<tr>
						<td>{{ $survey->title }}</td>
						<td>
							@foreach($survey->item as $index=>$item)
								@if($item)
								{{ $index+1}}.{{$item}}<br>
								@endif
							@endforeach
						</td>
						<td class="td-underline">
							<a href="{{ url('surveys/'.$survey->id.'/edit') }}" style="float: left; margin-right: 10px;">編輯</a>
							@if(0)
							<a href="" data-toggle="modal" data-target="#delete">刪除</a>
							@endif
						</td>
						<td>{{ ['公開','隱藏'][$survey->is_hide] }}</td>
					</tr>
				@endforeach
					<!--tr>
						<td>1</td>
						<td>單選</td>
						<td>10-12</td>
						<td>閱讀歷程</td>
						<td>題目範例：文字範例文字範例文字範例文字範例文字範例文字範例文字範例
							文字範例文字範例文字範例文字範例文字範例文字範例文字範例文字範例文字
							範例文字範例文字範例文字範例文字範例。<br>
							選項範例：<br>A:XXX<br>B:XXX<br>C:XXX<br>D:XXX</td>
						<td>A</td>   
						<td>數位指標</td>
						<td class="td-underline">
							<a href="" style="float: left; margin-right: 10px;">編輯</a>
							<a href="" data-toggle="modal" data-target="#delete">刪除</a>
						</td>
					</tr-->
					
				</tbody>
			</table>
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
			<button type="" class="btn btn_style" onclick="location.href='{{  url('groups') }}'">返回</button>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
</script>
@endsection
