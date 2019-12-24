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
		<div class="admin_import_exam">
			<p style="margin-bottom: 15px; font-weight: bold;" class="title-20 text-center">匯入學生問券</p>
			<form action="{{ url('surveys') }}" method="post" enctype="multipart/form-data">
			<div class="admin_import_exam_main white_box_bg mb-30">
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<div>
							<div><label for="quantity" class="lable_title">檔案上傳</label></div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFileLang" lang="zh-TW" style="width:350px;" name="file" required>
								<label class="custom-file-label" for="customFileLang">選擇文件</label>
							</div>
							<div class="status_text">*檔案上傳成功!</div>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn_style">上傳</button>
					<button type="button" class="btn btn_cancel" onclick="location.href='{{ url('surveys') }}'">取消</button>
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

$(".status_text").hide();

$('#customFileLang').on('change',function(e){
	//get the file name
	var fileName = e.target.files[0].name;
	//replace the "Choose a file" label
	$(this).next('.custom-file-label').html(fileName);
	$(".status_text").show();
})

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
