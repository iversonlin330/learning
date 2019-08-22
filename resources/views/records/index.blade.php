@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="exam_record">
		<div class="filter">
			<select class="browser-default custom-select small_filter">
				<option selected>科目</option>
				<option value="1">國語</option>
				<option value="2">自然</option>
				<option value="3">社會</option>
			</select>
			<select class="browser-default custom-select small_filter">
				<option selected>年級</option>
				<option value="1">二</option>
				<option value="2">三</option>
				<option value="3">四</option>
				<option value="3">五</option>
				<option value="3">六</option>
			</select>
			<input class="form-control small_filter" id="class_search" type="text" placeholder="班級">
			<select class="browser-default custom-select large_filter">
				<option selected>正確率排序：由高到低</option>
				<option value="1">正確率排序：由低到高</option>
			</select>
			<button class="btn btn_filter">篩選</button>
		</div>
		<div class="exam_table  mb-5">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width:5%">選取</th>
						<th style="width:13%">ID</th>
						<th style="width:13%">科目</th>
						<th style="width:13%">年級</th>
						<th style="width:13%">班級</th>
						<th style="width:18%">題組名稱</th>
						<th style="width:13%">平均正確率</th>
						<th style="width:13%">單筆瀏覽</th>
					</tr>
				</thead>
				<tbody id="exam_record">
					
					@foreach($classrooms as $classroom)
						@foreach($classroom->groups as $group)
						<tr>
							<td class="text-center">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
									<label class="form-check-label" for=""></label>
								</div>
							</td>
							<td>{{ $group->id }}</td>
							<td>{{ $group->subject }}</td>
							<td>{{ $classroom->grade }}</td>
							<td>{{ $classroom->classroom }}</td>
							<td>{{ $group->title }}</td>
							<td>{{ $classroom->groups_rate($group->id) }}</td>
							<td class="td-underline"><a href="{{ url('record/single/'.'?classroom_id='.$classroom->id.'&group_id='.$group->id) }}">瀏覽</a></td>
						</tr>
						@endforeach
					
					@endforeach
					
					<!--tr>
						<td class="text-center">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for=""></label>
							</div>
						</td>
						<td>A001</td>
						<td>自然</td>
						<td>二</td>
						<td>乙</td>
						<td>題組A</td>
						<td>80%</td>
						<td class="td-underline"><a href="UC2-PF16_teacher_view_single_result.html">瀏覽</a></td>
					</tr>
					<tr>
						<td class="text-center">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for=""></label>
							</div>
						</td>
						<td>A001</td>
						<td>國文</td>
						<td>二</td>
						<td>乙</td>
						<td>題組A</td>
						<td>80%</td>
						<td class="td-underline"><a href="UC3-PF9_admin_view_single_result.html">瀏覽</a></td>
					</tr-->
				</tbody>
			</table>
		</div>
		<div class="text-center">
			<div class="btn-group">
				<button type="submit" class="btn btn_style" onclick="location.href='UC2-PF17_teacher_view_all_result.html'">多筆瀏覽</button>
				<button type="" class="btn btn_cancel" onclick="history.back()" >返回</button>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
function question_no_change(num){
	$(".question_no div").removeClass('question_no_now');
	
	if(num == 0){
		num = 1;
	}
	num = num.toString().split("_")[0];
	//num = num.toString().substr(0,1);
	num = num -1;
	$(".question_no div:eq("+num+")").addClass('question_no_now');
}
</script>
@endsection
