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
		<!--div class="filter">
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
		</div-->
		<div class="top_right_button">
			<button class="btn btn_function" onclick="location.href='{{ url('templates/create?group_id='.$group_id) }}'" >建立模板</button>
			<button class="btn btn_function" data-toggle="modal" data-target="#order">排序</button>
		</div>
		<div class="exam_table">
			<table id="group_table" class="table table-bordered">
				<thead>
					<tr>
						<th style="width:15%">模板名稱</th>
						<th style="width:15%">模板類型</th>
						<th style="width:40%">功能</th>
					</tr>
				</thead>
				<tbody>
				@if(0)
					@foreach($groups as $group)
						<tr data-id="{{ $group->id }}">
							@if(Auth::user()->role >=50)
							<td>{{$group->id}}</td>
							@endif
							<td>{{$group->subject}}</td>
							<td>{{$group->grade}}</td>
							<td>{{$group->title}}</td>
							@if(Auth::user()->role == 1)
							<td>{{ $group->is_finish }}</td>
							@endif
							<td class="td-underline">
								<a href="{{url('testing/'.$group->id)}}" style="float: left; margin-right: 10px;">開始作答</a>
								@if(Auth::user()->role == 50)
								<a href="{{url('groups/'.$group->id)}}" style="float: left; margin-right: 10px;">瀏覽題目</a>
								<a class="assign" href="#" style="float: left; margin-right: 10px;">指定班級作答</a>
								@endif
								@if(Auth::user()->role == 99)
								<a href="{{url('groups/'.$group->id)}}" style="float: left; margin-right: 10px;">查看詳細資訊</a>
								<a href="{{url('groups/'.$group->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯題組內容</a>
								@endif
							</td>
						</tr>
					@endforeach
				@endif
				@foreach($templates as $template)
				<tr>
					<td>{{ isset($template->content['name'])? $template->content['name'] : '' }}</td>
					<td>{{ ($template->type == 1)? '模板一' : '模板二' }}</td>
					<td class="td-underline">
						<a href="{{url('templates/'.$template->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯</a>
						<form class="delete_form" action="{{url('templates/'.$template->id)}}" method="POST">
						{{ method_field('DELETE') }}
						<a href="#" style="float: left; margin-right: 10px;" onclick="delete_form(this)">刪除</a>
						</form>
					</td>
				</tr>
				@endforeach
					<!--tr>
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
					</tr-->
				</tbody>
			</table>
			<!-- 指定班級作答彈跳視窗 -->
			<div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="assignation_exam"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form action="{{ url('templates') }}" method="post">
						<div class="modal-body pop-up text-center" style="width:350px;">
							<ul id="sortable">
								@foreach($templates as $template)
								<li class="btn btn_editor" style="display: block;float: none;">{{ isset($template->content['name'])? $template->content['name'] : '' }}
									<input name="order[]" value="{{ $template->id }}" hidden>
								</li>
								@endforeach
							</ul>
							<button type="submit" class="btn btn_style">確認</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<button type="" class="btn btn_style" onclick="location.href='{{ url('groups') }}'">返回</button>
</div>
@endsection
 
@section('script')
@parent
<script>
$("#sortable").sortable();

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

$(".assign").click(function(){
	var group_id = $(this).closest('tr').data('id');
	$("#group_id").val(group_id);
	$("#assignation_exam").modal('show');
});
/*
$("form").submit(function(e) {
	e.preventDefault();
	$.ajax({
	  type: 'POST',
	  url: $(this).attr('action'),
	  data: $("form").serialize(),
	}).done(function(data) {
	  if(data.success){
		  $("#teacher_signup").modal('show');
	  }else{
		  alert(data.message);
	  }
	});
});
*/
function delete_form(obj){
	if (confirm('確定要刪除?')) {
		// Post the form
		$(obj).closest('form').submit() // Post the surrounding form
	}
}
</script>
@endsection
