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
		<div class="exam_content_editor">
			<p class="title-20" style="float: none;">編輯題組內容</p>
			<hr class="line">
			<div class="editor_section mb-5">
				<div id="template_content" class="tab-content mx-auto">
					<div id="template_{{$template->id}}" role="tabpanel"
						aria-labelledby="topic_tab_1">
						<div>
							@if($template->type == 1)
							<div class="edit_content_left">
								<!--button class="btn btn_editor" data-toggle="modal" data-target="#delete_exam" style="float: right; font-size: 14px; background-color: #B8B8B8!important; margin:0!important; ">刪除模組</button>
								<p class="title-brown" style="float: none;">新增模組一內容</p>
								<hr-->
								<div class="form-group">
									<label for="type1_img1" class="lable_title">模組名稱</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="模組名稱">
								</div>
								<div class="form-group">
									<label for="type1_img1" class="lable_title">圖片一</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="連結">
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">圖片二</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2"placeholder="連結">
								</div>
							</div>
							@elseif($template->type == 2)
							<div class="edit_content_left">
								<!--button class="btn btn_editor" data-toggle="modal" data-target="#delete_exam" style="float: right; font-size: 14px; background-color: #B8B8B8!important; margin:0!important; ">刪除模組</button>
								<p class="title-brown" style="float: none;">新增模組二內容</p>
								<hr-->
								<div class="form-group">
									<label for="type1_img1" class="lable_title">模組名稱</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="模組名稱">
								</div>
								<div class="form-group">
									<label for="type1_img1" class="lable_title">Banner圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="連結">
								</div>
								<!--div class="form-group">
									<div><label for="teacher_city" class="lable_title">廣告位置</label></div>
									<select class="browser-default custom-select" style="width: 300px;">
										<option value="1">無</option>
										<option value="2">右側</option>
										<option value="3">下方</option>
									</select>
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">廣告圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2" placeholder="連結">
								</div-->
								<div class="form-group">
									<div><label for="teacher_city" class="lable_title">是否開啟廣告</label></div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio1" value="option1">
										<label class="form-check-label" for="inlineRadio1">是</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio1" value="option1">
										<label class="form-check-label" for="inlineRadio1">否</label>
									</div>
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">彈跳視窗圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2" placeholder="連結">
								</div>
								<hr style="margin:30px 0;">
								<!--題組內四個頁籤-->
								<div class="exam_tab_section">
									<ul class="nav" style="margin-bottom: 20px;" role="tablist">
										<li>
											<a class="active exam_tab" data-toggle="tab" href="#content_1" role="tab" aria-controls="content_1"
												aria-selected="true">頁籤(一)</a>
										</li>
										<li>
											<a class="exam_tab" data-toggle="tab" href="#content_2" role="tab" aria-controls="content_2"
												aria-selected="false">頁籤(二)</a>
										</li>
										<li>
											<a class="exam_tab" data-toggle="tab" href="#content_3" role="tab" aria-controls="content_3"
												aria-selected="false">頁籤(三)</a>
										</li>
										<li>
											<a class="exam_tab" data-toggle="tab" href="#content_4" role="tab" aria-controls="content_4"
												aria-selected="false">頁籤(四)</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="content_1" role="tabpanel" aria-labelledby="tab_1">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(一)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_1" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="content_2" role="tabpanel" aria-labelledby="tab_2">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(二)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_2" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="content_3" role="tabpanel" aria-labelledby="tab_3">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(三)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_3" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="content_4" role="tabpanel" aria-labelledby="tab_4">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(四)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_4" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>          
							</div>
							@endif
							<div class="edit_content_right">
								<p class="title-brown"  style="float: none; text-align: center;">選取對應題目</p>
								<div class="select_question">
									<table class="table table-bordered text-center">
										<thead>
											<tr>
												<th>題號</th>
												<th>選取</th>
											</tr>
										</thead>
										<tbody>
										@foreach($questions as $question)
											<tr>
												<td>{{ $question->no }}</td>
												<td class="text-center">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
														<label class="form-check-label" for=""></label>
													</div>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Clone 1 start-->
					<div class="tab-pane fade" id="clone_1" role="tabpanel" aria-labelledby="topic_tab_1">
						<div>
							<div class="edit_content_left">
								<button class="btn btn_editor" data-toggle="modal" data-target="#delete_exam" style="float: right; font-size: 14px; background-color: #B8B8B8!important; margin:0!important; ">刪除模組</button>
								<p class="title-brown" style="float: none;">新增模組一內容</p>
								<hr>
								<div class="form-group">
									<label for="type1_img1" class="lable_title">圖片一</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="連結">
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">圖片二</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2"placeholder="連結">
								</div>
							</div>
							<div class="edit_content_right">
								<p class="title-brown"  style="float: none; text-align: center;">選取對應題目</p>
								<div class="select_question">
									<table class="table table-bordered text-center">
										<thead>
											<tr>
												<th>題號</th>
												<th>選取</th>
											</tr>
										</thead>
										<tbody>
										@foreach($questions as $question)
											<tr>
												<td>{{ $question->no }}</td>
												<td class="text-center">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
														<label class="form-check-label" for=""></label>
													</div>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Clone 1 end-->
					<!-- Clone 2 start-->
					<div class="tab-pane fade" id="clone_1" role="tabpanel" aria-labelledby="topic_tab_1">
						<div>
							<div class="edit_content_left">
								<button class="btn btn_editor" data-toggle="modal" data-target="#delete_exam" style="float: right; font-size: 14px; background-color: #B8B8B8!important; margin:0!important; ">刪除模組</button>
								<p class="title-brown" style="float: none;">新增模組二內容</p>
								<hr>
								<div class="form-group">
									<label for="type1_img1" class="lable_title">Banner圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="連結">
								</div>
								<div class="form-group">
									<div><label for="teacher_city" class="lable_title">廣告位置</label></div>
									<select class="browser-default custom-select" style="width: 300px;">
										<option value="1">無</option>
										<option value="2">右側</option>
										<option value="3">下方</option>
									</select>
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">廣告圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2" placeholder="連結">
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">彈跳視窗圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2" placeholder="連結">
								</div>
								<hr style="margin:30px 0;">
								<!--題組內四個頁籤-->
								<div class="exam_tab_section">
									<ul class="nav" style="margin-bottom: 20px;" role="tablist">
										<li>
											<a class="active exam_tab" data-toggle="tab" href="#content_1" role="tab" aria-controls="content_1"
												aria-selected="true">頁籤(一)</a>
										</li>
										<li>
											<a class="exam_tab" data-toggle="tab" href="#content_2" role="tab" aria-controls="content_2"
												aria-selected="false">頁籤(二)</a>
										</li>
										<li>
											<a class="exam_tab" data-toggle="tab" href="#content_3" role="tab" aria-controls="content_3"
												aria-selected="false">頁籤(三)</a>
										</li>
										<li>
											<a class="exam_tab" data-toggle="tab" href="#content_4" role="tab" aria-controls="content_4"
												aria-selected="false">頁籤(四)</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="content_1" role="tabpanel" aria-labelledby="tab_1">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(一)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_1" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="content_2" role="tabpanel" aria-labelledby="tab_2">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(二)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_2" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="content_3" role="tabpanel" aria-labelledby="tab_3">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(三)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_3" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="content_4" role="tabpanel" aria-labelledby="tab_4">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(四)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_4" class="ckeditor"></textarea>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>                                                                                                  
							</div>
							<div class="edit_content_right">
								<p class="title-brown"  style="float: none; text-align: center;">選取對應題目</p>
								<div class="select_question">
									<table class="table table-bordered text-center">
										<thead>
											<tr>
												<th>題號</th>
												<th>選取</th>
											</tr>
										</thead>
										<tbody>
										@foreach($questions as $question)
											<tr>
												<td>{{ $question->no }}</td>
												<td class="text-center">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
														<label class="form-check-label" for=""></label>
													</div>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Clone 2 end-->
				</div>
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn_style" onclick="history.back()">新增</button>
					<button type="" class="btn btn_cancel" onclick="history.back()">返回</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--刪除模組-->
<div class="modal fade" id="delete_exam" tabindex="-1" role="dialog" aria-labelledby="delete_exam" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body pop-up text-center">
				<p>確認要刪除此模組嗎？</p>
				<button type="button" class="btn btn_style" data-dismiss="modal">確認</button>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>

$("#clone_tab,#clone_1,#clone_2").hide();

$("#exam_type").sortable({});

$("#exam_type").sortable({ cancel: ".no_move" });

var allEditors = document.querySelectorAll('.ckeditor');
for (var i = 0; i < allEditors.length; ++i) {
  ClassicEditor.create(allEditors[i]);
}

if(0){
	$("#exam_type .btn_editor:eq(0)").click();
}


$("#add_exam button").click(function(){
	var add_val = $("#add_exam select").val();
	
	if(add_val == 1){
		var new_template = $("#clone_1").clone();
		var new_tab = $("#clone_tab").clone().find('a').text("模板一").show();
	}else if(add_val == 2){
		var new_template = $("#clone_2").clone();
		var new_tab = $("#clone_tab").clone().find('a').text("模板二").show();
	}
	
	$("#template_content").append(new_template);
	$("#exam_type").append(new_tab);
})

/*
$(".template").hide();
$(".template:eq(0)").show();
*/

function dj(dom) {
	var collection = $(".btn_editor");
	$.each(collection, function () {
		$(this).removeClass("end");
		$(this).addClass("start");
	});
	$(dom).removeClass("start");
	$(dom).addClass("end");
}

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
