@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
.tab1,.tab2{
	float:left;
}
.tab1_off, .tab1:hover .tab1_on{
   display:none
}
.tab1_on, .tab1:hover .tab1_off{
   display:block
}

.tab2_off, .tab2:hover .tab2_on{
   display:none
}
.tab2_on, .tab2:hover .tab2_off{
   display:block
}

#tea_btn a {
	background: url("img/teacher_btn.png");/*預設顯示圖片*/
	background-repeat:no-repeat;
	display: block;
	font-size: 0; 
	height: 76px;/*圖片高度*/
	width: 80px;/*圖片寬度*/
	background-size:cover;
}
#tea_btn a:hover {
	background: url("img/teacher_btn_hover.png"); /*滑鼠移過顯示圖片*/
	background-size:cover;
}

#stu_btn a {
	background: url("img/student_btn.png");/*預設顯示圖片*/
	background-repeat:no-repeat;
	display: block;
	font-size: 0; 
	height: 75px;/*圖片高度*/
	width: 80px;/*圖片寬度*/
	background-size:cover;
}
#stu_btn a:hover {
	background: url("img/student_btn_hover.png"); /*滑鼠移過顯示圖片*/
	background-size:cover;
}

.teacher_exam_table{
	position:relative;
}

.tab_btn{
	top:60px;
}

</style>
@endsection
 
@section('content')
<div class="container mb-5">
@if(0)
	@if(Auth::user()->role < 50)
	<div class="tab1" onclick="tab_show(1)">
		<img class="tab1_on" style="width: 80px;" src="img/student_btn.png">
		<img class="tab1_off" style="width: 80px;" src="img/student_btn_hover.png">
	</div>
	<div class="tab2" onclick="tab_show(2)">
		<img class="tab2_on" style="width: 80px;" src="img/teacher_btn.png">
		<img class="tab2_off" style="width: 80px;" src="img/teacher_btn_hover.png">
	</div>
	@endif
@endif
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
			<button class="btn btn_function" onclick="location.href='{{ url('record/index') }}'" >作答記錄查看</button>
			@endif
			@if(Auth::user()->role == 99)
			<button class="btn btn_function" onclick="location.href='{{ url('groups/create') }}'">題組匯入</button>
			@endif
		</div>
		<div class="exam_table">
		@if(Auth::user()->role < 50)
			<div class="tab_btn" style="position: absolute; left:-95px;">
				<div id="tea_btn" class="mb-1"  onclick="tab_show(1)"><a href="#"></a></div>
				<div id="stu_btn"  onclick="tab_show(2)"><a href="#"></a></div>
			</div>
		@endif
			<table id="group_table" class="table table-bordered group_table">
				<thead>
					<tr>
						@if(Auth::user()->role >=50)
						<th style="width:10%">ID</th>
						<th style="width:10%">科目</th>
						<th style="width:15%">年級</th>
						<th style="width:15%">題組名稱</th>
						<th style="width:40%">功能</th>
						@if(Auth::user()->role >=99)
							<th style="width:5%">隱藏</th>
						@endif
						@else
						<th>科目</th>
						<th>年級</th>
						<th>題組名稱</th>
						<th>作答紀錄</th>
						<th>功能</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@foreach($groups as $group)
					<?php
						$number = 0;
						if(array_key_exists($group->grade,Config('map.class_number'))){
							$number = Config('map.class_number')[$group->grade];
						}
					?>
						<tr data-id="{{ $group->id }}" data-number="{{ $number }}">
							@if(Auth::user()->role >=50)
							<td>{{$group->g_id}}</td>
							@endif
							<td>{{$group->subject}}</td>
							<td>{{$group->grade}}</td>
							<td>{{$group->title}}</td>
							@if(Auth::user()->role == 1)
							<td>{{ $group->is_finish }}</td>
							@endif
							<td class="td-underline">
								@if($group->templates->count() > 0)
								<a href="{{url('testing/'.$group->id)}}" style="float: left; margin-right: 10px;">開始作答</a>
								@endif
								@if(Auth::user()->role == 50)
								<a href="{{url('groups/'.$group->id)}}" style="float: left; margin-right: 10px;">瀏覽題目</a>
								<a class="assign" href="#" style="float: left; margin-right: 10px;">指定班級作答</a>
								@endif
								@if(Auth::user()->role == 99)
								<a href="{{url('groups/'.$group->id)}}" style="float: left; margin-right: 10px;">查看詳細資訊</a>
								<!--a href="{{url('groups/'.$group->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯題組內容</a-->
								<a href="{{url('groups/'.$group->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯題組資訊</a>
								<a href="{{url('templates/?group_id='.$group->id)}}" style="float: left; margin-right: 10px;">編輯題組內容</a>
								@endif
							</td>
							@if(Auth::user()->role >=99)
								<td>{{ ['公開','隱藏'][$group->is_hide] }}</td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
			<table id="group_table_2" class="table table-bordered group_table">
				<thead>
					<tr>
						@if(Auth::user()->role >=50)
						<th style="width:15%">ID</th>
						<th style="width:15%">科目</th>
						<th style="width:15%">年級</th>
						<th style="width:15%">題組名稱</th>
						<th style="width:40%">功能</th>
						@else
						<th>科目</th>
						<th>年級</th>
						<th>題組名稱</th>
						<th>作答紀錄</th>
						<th>功能</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@foreach($teacher_not_group as $group)
					<?php
						$number = 0;
						if(array_key_exists($group->grade,Config('map.class_number'))){
							$number = Config('map.class_number')[$group->grade];
						}
					?>
						<tr data-id="{{ $group->id }}" data-number="{{ $number }}">
							@if(Auth::user()->role >=50)
							<td>{{$group->g_id}}</td>
							@endif
							<td>{{$group->subject}}</td>
							<td>{{$group->grade}}</td>
							<td>{{$group->title}}</td>
							@if(Auth::user()->role == 1)
							<td>{{ $group->is_finish }}</td>
							@endif
							<td class="td-underline">
								@if($group->templates->count() > 0)
								<a href="{{url('testing/'.$group->id)}}" style="float: left; margin-right: 10px;">開始作答</a>
								@endif
								@if(Auth::user()->role == 50)
								<a href="{{url('groups/'.$group->id)}}" style="float: left; margin-right: 10px;">瀏覽題目</a>
								<a class="assign" href="#" style="float: left; margin-right: 10px;">指定班級作答</a>
								@endif
								@if(Auth::user()->role == 99)
								<a href="{{url('groups/'.$group->id)}}" style="float: left; margin-right: 10px;">查看詳細資訊</a>
								<!--a href="{{url('groups/'.$group->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯題組內容</a-->
								<a href="{{url('groups/'.$group->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯題組資訊</a>
								<a href="{{url('templates/?group_id='.$group->id)}}" style="float: left; margin-right: 10px;">編輯題組內容</a>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<!-- 指定班級作答彈跳視窗 -->
			<div class="modal fade" id="assignation_exam" tabindex="-1" role="dialog" aria-labelledby="assignation_exam"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form action="{{ url('group_classrooms') }}" method="post">
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
									@foreach($classrooms as $classroom)
									<tr>
										<td>{{ $classroom->grade }}年{{ $classroom->classroom }}班</td>
										<td class="text-center">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" name="classroom_id[]" value="{{ $classroom->id }}">
												<label class="form-check-label" for=""></label>
											</div>
										</td>
									</tr>
									@endforeach
									<input id="group_id" name="group_id" value=""  hidden />
									</tbody>
								</table>
							</div>
							<button type="submit" class="btn btn_style">確認</button>
						</div>
						</form>
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
$("#group_table_2").hide();
function sort_group_table(type){
    var $tbody = $('#group_table tbody');
	$tbody.find('tr').sort(function(a,b){ 
		//var tda = $(a).find('td:eq(2)').text(); // can replace 1 with the column you want to sort on
		//var tdb = $(b).find('td:eq(2)').text(); // this will sort on the second column
		//var tda = $(a).find('td:eq(2)').data('number'); // can replace 1 with the column you want to sort on
		//var tdb = $(b).find('td:eq(2)').data('number'); // this will sort on the second column
		var tda = $(a).data('number'); // can replace 1 with the column you want to sort on
		var tdb = $(b).data('number'); // this will sort on the second column
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
	
	var $tbody = $('#group_table_2 tbody');
	$tbody.find('tr').sort(function(a,b){ 
		//var tda = $(a).find('td:eq(2)').text(); // can replace 1 with the column you want to sort on
		//var tdb = $(b).find('td:eq(2)').text(); // this will sort on the second column
		//var tda = $(a).find('td:eq(2)').data('number'); // can replace 1 with the column you want to sort on
		//var tdb = $(b).find('td:eq(2)').data('number'); // this will sort on the second column
		var tda = $(a).data('number'); // can replace 1 with the column you want to sort on
		var tdb = $(b).data('number'); // this will sort on the second column
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
//sort_group_table('desc');

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
        //return;
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
	
	var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $('#group_table_2 tbody').find("tr");
    if (this.value == "") {
        jo.show();
        //return;
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

var group_classrooms = {!! json_encode($result,true) !!};

$(".assign").click(function(){
	var group_id = $(this).closest('tr').data('id');
	$('[name^="classroom_id"]').prop('checked',false);
	$("#group_id").val(group_id);
	for(x in group_classrooms[group_id]){
		$('[name^="classroom_id"][value="'+group_classrooms[group_id][x]+'"]').prop('checked',true);
	}
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

function tab_show(num){
	if(num == 1){
		$("#group_table").show();
		$("#group_table_2").hide();
	}else{
		$("#group_table").hide();
		$("#group_table_2").show();
	}
}

</script>
@endsection
