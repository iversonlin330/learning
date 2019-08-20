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
		<p class="title-brown">{{$group->subject}}/{{$group->grade}}/{{$group->title}}</p>
		<div class="top_right_button">
			<button class="btn btn_function" onclick="location.href='UC3-PF7_admin_add_question.html'">新增題目</button>
		</div>
		<div class="view_detial_table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width:8%">題號</th>
						<th style="width:8%">題型</th>
						<th style="width:8%">適合年級</th>
						<th style="width:8%">閱讀歷程</th>
						<th style="width:36%">題目內容</th>
						<th style="width:8%">參考答案</th>
						<th style="width:8%">數位指標</th>
						<th style="width:16%">功能</th>
					</tr>
				</thead>
				<tbody>
				@foreach($questions as $question)
					<tr>
						<td>{{ $question->no }}</td>
						<td>{{ $question->type }}</td>
						<td>{{ $question->grade }}</td>
						<td>{{ $question->history }}</td>
						<td>{{ $question->name }}
							@if($question->item)
							<br>
							選項範例：
							<?php $item = explode('@',$question->item); ?>
							<br>A:{{ $item[0] }}<br>B:{{ $item[1] }}<br>C:{{ $item[2] }}<br>D:{{ $item[3] }}
							@endif
						</td>
						<td>{{ $question->correct_answer }}</td>   
						<td>{{ $question->goal }}</td>
						<td class="td-underline">
							<a href="" style="float: left; margin-right: 10px;">編輯</a>
							<a href="" data-toggle="modal" data-target="#delete">刪除</a>
						</td>
					</tr>
				@endforeach
					<tr>
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
					</tr>
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
			<button type="" class="btn btn_style" onclick="history.back()">返回</button>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
</script>
@endsection
