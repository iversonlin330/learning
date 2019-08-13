@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="teacher_exam_table">
		<div class="filter">
			<select id="filter_subject" class="browser-default custom-select small_filter">
				<option value="" selected>科目</option>
				<option value="國語">國語</option>
				<option value="自然">自然</option>
				<option value="社會">社會</option>
			</select>
			<select id="sort_grade" class="browser-default custom-select large_filter" style="width:220px;">
				<option value="desc" selected>年級排列：由高到低</option>
				<option value="asc">年級排列：由低到高</option>
			</select>
			<button class="btn btn_filter">篩選</button>
		</div>
		<div class="top_right_button">
			@if(Auth::user()->role == 50)
			<button class="btn btn_function" onclick="location.href='UC2-PF15_teacher_view_exam_record.html'" >作答記錄查看</button>
			@endif
			@if(Auth::user()->role == 99)
			<button class="btn btn_function" onclick="location.href=' UC3-PF12_import_exam.html'">題組匯入</button>
			@endif
		</div>
		<div class="exam_table">
			<table id="group_table" class="table table-bordered">
				<thead>
					<tr>
						<th style="width:15%">ID</th>
						<th style="width:15%">科目</th>
						<th style="width:15%">年級</th>
						<th style="width:15%">題組名稱</th>
						<th style="width:40%">功能</th>
					</tr>
				</thead>
				<tbody>
					@foreach($groups as $group)
						<tr>
							<td>{{$group->id}}</td>
							<td>{{$group->subject}}</td>
							<td>{{$group->grade}}</td>
							<td>{{$group->title}}</td>
							<td class="td-underline">
								<a href="#" style="float: left; margin-right: 10px;">開始作答</a>
								@if(Auth::user()->role == 50)
								<a href="{{url('groups/'.$group->id)}}" style="float: left; margin-right: 10px;">瀏覽題目</a>
								<a href="#" style="float: left; margin-right: 10px;">指定班級作答</a>
								@endif
								@if(Auth::user()->role == 99)
								<a href="UC3-PF6_admin_view_detial.html" style="float: left; margin-right: 10px;">查看詳細資訊</a>
								@endif
							</td>
						</tr>
					@endforeach
					<tr>
						<td>A001</td>
						<td>自然</td>
						<td>二上</td>
						<td>題組A</td>
						<td class="td-underline">
							<a href="exam_question_example.html" style="float: left; margin-right: 10px;">開始作答</a>
							<a href="UC2-PF8_teacher_view_detial.html" style="float: left; margin-right: 10px;">瀏覽題目</a>
							<a href="" data-toggle="modal" data-target="#assignation_exam" >指定班級作答</a>
						</td>
					</tr>
					<tr>
						<td>A001</td>
						<td>自然</td>
						<td>二上</td>
						<td>題組A</td>
						<td class="td-underline">
							<a href="exam_question_example.html" style="float: left; margin-right: 10px;">開始作答</a>
							<a href="UC2-PF8_teacher_view_detial.html" style="float: left; margin-right: 10px;">瀏覽題目</a>
							<a href="" data-toggle="modal" data-target="#assignation_exam" >指定班級作答</a>
						</td>
					</tr>
					<tr>
						<td>A001</td>
						<td>自然</td>
						<td>二上</td>
						<td>題組A</td>
						<td class="td-underline">
							<a href="exam_question_example.html" style="float: left; margin-right: 10px;">開始作答</a>
							<a href="UC2-PF8_teacher_view_detial.html" style="float: left; margin-right: 10px;">瀏覽題目</a>
							<a href="" data-toggle="modal" data-target="#assignation_exam" >指定班級作答</a>
						</td>
					</tr>
					<tr>
						<td>A001</td>
						<td>自然</td>
						<td>四上</td>
						<td>題組A</td>
						<td class="td-underline">
							<a href="exam_question_example.html" style="float: left; margin-right: 10px;">開始作答</a>
							<a href="UC2-PF8_teacher_view_detial.html" style="float: left; margin-right: 10px;">瀏覽題目</a>
							<a href="" data-toggle="modal" data-target="#assignation_exam" >指定班級作答</a>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- 指定班級作答彈跳視窗 -->
			<div class="modal fade" id="assignation_exam" tabindex="-1" role="dialog" aria-labelledby="assignation_exam"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body pop-up text-center" style="width:350px;">
							<div class="exam_table">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>班級</th>
											<th>選取</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>二年甲班</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<button type="button" class="btn btn_style" data-dismiss="modal">確認</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
function sort_group_table(type){
    var $tbody = $('#group_table tbody');
	$tbody.find('tr').sort(function(a,b){ 
		var tda = $(a).find('td:eq(2)').text(); // can replace 1 with the column you want to sort on
		var tdb = $(b).find('td:eq(2)').text(); // this will sort on the second column
				// if a < b return 1
		if(type == 'desc'){
			return tda < tdb ? 1 
			   // else if a > b return -1
			   : tda > tdb ? -1 
			   // else they are equal - return 0    
			   : 0;  
		}else{
			return tda > tdb ? 1 
			   // else if a > b return -1
			   : tda < tdb ? -1 
			   // else they are equal - return 0    
			   : 0;  
		}
		         
	}).appendTo($tbody);
}
sort_group_table('desc');

$("#sort_grade").change(function(){
	var type = $(this).val();
	sort_group_table(type);
});


$("#filter_subject").change(function () {
    //split the current value of searchInput
    var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $('#group_table tbody').find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
});

</script>
@endsection
