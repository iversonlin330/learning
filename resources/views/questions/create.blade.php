@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="col-12">
		<div class="admin_add_question">
			<p style="margin-bottom: 15px; font-weight: bold;" class="title-20 text-center">新增題目</p>
			<form action="{{ url('questions') }}" method="post">
			<input name="group_id" value="{{$group_id}}" hidden>
			<div class="admin_add_question_main white_box_bg mb-30">
				
					<div class="row" style="margin:0;">
						<div class="form-group mr-30">
							<label for="que_type" class="lable_title">題型</label>
							<select style="width: 180px;" type="text" class="form-control" id="que_type" name="type">
								<option value="1">簡答</option>
								<option value="2">單選</option>
								<option value="3">多選</option>
							</select>
						</div>
						<div class="form-group">
							<label for="que_grade" class="lable_title">適合年級</label>
							<input style="width: 180px;" type="text" class="form-control" id="que_grade" name="grade">
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="form-group">
							<label for="que_read" class="lable_title">閱讀歷程</label>
							<input style="width: 390px;" type="text" class="form-control" id="que_read" name="history">
						</div>
						<div class="form-group">
							<label for="que_content" class="lable_title">題目內容</label>
							<textarea style="width: 390px; height: 170px;" type="text" class="form-control" id="que_content"  name="name"></textarea>
						</div>
						<div class="form-group">
							<label for="que_answer" class="lable_title">參考答案</label>
							<textarea style="width: 390px; height: 100px;" type="text" class="form-control" id="que_answer" name="correct_answer"></textarea>
						</div>
						<div class="form-group">
							<label for="que_indicator" class="lable_title">數位指標</label>
							<input style="width: 390px;" type="text" class="form-control" id="que_indicator"  name="goal">
						</div>
					</div>
				
			</div>
			<div class="text-center">
			   <div class="btn-group" >
					<button type="submit" class="btn btn_style">新增</button>
					<button type="" class="btn btn_cancel"onclick="history.back()">返回</button>
				</div> 
			</div>
			</form>
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
</script>
@endsection
