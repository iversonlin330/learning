@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="view_ad_table">
		<div class="filter">
			<select class="browser-default custom-select small_filter">
				<option selected>科目</option>
				<option value="1">國語</option>
				<option value="2">自然</option>
				<option value="3">社會</option>
			</select>
			<select class="browser-default custom-select large_filter" style="width:220px;">
				<option selected>年級排列：由高到低</option>
				<option value="1">年級排列：由低到高</option>
			</select>
			<button class="btn btn_filter">篩選</button>
		</div>
		<div class="top_right_button">
			<button class="btn btn_function">匯出總資料</button>
		</div>
		<div class="exam_table mb-5">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width: 10%">ID</th>
						<th style="width: 18%">科目</th>
						<th style="width: 18%">年級</th>
						<th style="width: 18%">題組名稱</th>
						<th style="width: 18%">總點擊率</th>
						<th style="width: 18%">功能</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>A001</td>
						<td>自然</td>
						<td>二上</td>
						<td>題組A</td>
						<td>1,000</td>
						<td class="td-underline"><a href="">匯出此廣告資料</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<button type="" class="btn btn_style" onclick="location.href='UC3-PF3_admin_exam_table.html'">返回</button>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>

</script>
@endsection
