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
			<button class="btn btn_function" onclick="location.href='{{ url('ads/export/?group_id=All') }}'">匯出總資料</button>
		</div>
		<div class="exam_table mb-5">
			<table id="group_table" class="table table-bordered">
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
				@foreach($groups as $group)
				<tr>
					<td>{{ $group->g_id }}</td>
					<td>{{ $group->subject }}</td>
					<td>{{ $group->grade }}</td>
					<td>{{ $group->title }}</td>
					<td>{{ $group->ad_count }}</td>
					<td class="td-underline"><a href="{{ url('ads/export/?group_id='.$group->id) }}">匯出此廣告資料</a></td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<button type="" class="btn btn_style" onclick="location.href='{{ url('groups') }}'">返回</button>
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

