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
			<select id="filter_subject" class="browser-default custom-select small_filter">
				<option value="" selected>科目</option>
				<option value="國語">國語</option>
				<option value="自然">自然</option>
				<option value="社會">社會</option>
			</select>
			<select id="filter_grade" class="browser-default custom-select small_filter">
				<option value="" selected>年級</option>
				<option value="二">二</option>
				<option value="三">三</option>
				<option value="四">四</option>
				<option value="五">五</option>
				<option value="六">六</option>
			</select>
			<input id="filter_classroom" class="form-control small_filter" id="class_search" type="text" placeholder="班級">
			<select id="sort_rate" class="browser-default custom-select large_filter">
				<option value="desc" selected>正確率排序：由高到低</option>
				<option value="asc">正確率排序：由低到高</option>
			</select>
			<button class="btn btn_filter">篩選</button>
		</div>
		<div class="exam_table  mb-5">
			<table id="group_table" class="table table-bordered">
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
									<input class="form-check-input" type="checkbox" name="multi[]" value="{{$classroom->id.','.$group->id }}">
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
				<button id="multi" type="submit" class="btn btn_style" onclick="goMulti()">多筆瀏覽</button>
				<button type="" class="btn btn_cancel" onclick="location.href='{{url('groups')}}'" >返回</button>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
var multi_url = '';
$(".form-check-input").change(function(){
	multi_url = "{{url('record/multi/')}}?";
	$(".form-check-input:checked").each(function(){
		multi_url = multi_url + '&data[]='+$(this).val();
		//console.log($(this).val());
	});
	//$("#multi").attr('onclick',"location.href='UC2-PF17_teacher_view_all_result.html'")
});

function goMulti(){
	location.href = multi_url;
}

function sort_group_table(type){
    var $tbody = $('#group_table tbody');
	$tbody.find('tr').sort(function(a,b){ 
		var tda = $(a).find('td:eq(6)').text(); // can replace 1 with the column you want to sort on
		var tdb = $(b).find('td:eq(6)').text(); // this will sort on the second column
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

$("#sort_rate").change(function(){
	var type = $(this).val();
	sort_group_table(type);
});

$("#filter_subject,#filter_grade,#filter_classroom").change(function () {
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
