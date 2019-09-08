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
	
	@if(isset($template))
		<form action="{{url('templates/'.$id)}}" method="POST">
		@method('PUT')
	@else
		<form action="{{url('templates')}}" method="POST">
		<input name="group_id" value="{{ $group_id }}" hidden>
	@endif
		<div class="exam_content_editor">
			<p class="title-20" style="float: none;">@if(isset($template))修改@else新增@endif題組內容</p>
			<hr class="line">
			<div class="editor_section mb-5">
				<div class="editor_header">
					<div class="form-row">
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="模組名稱" name="content[name]">
						</div>
						<div class="col-md-6">
						  <select id="template_type" class="form-control" name="type">
							<option value="1">模組一</option>
							<option value="2">模組二</option>
						</select>
						</div>
					</div>
				</div>
				<div id="template_content" class="tab-content mx-auto">
					<div id="template" role="tabpanel"
						aria-labelledby="topic_tab_1">
						<div>
							<div id="template_1" class="edit_content_left">
								<!--button class="btn btn_editor" data-toggle="modal" data-target="#delete_exam" style="float: right; font-size: 14px; background-color: #B8B8B8!important; margin:0!important; ">刪除模組</button>
								<p class="title-brown" style="float: none;">新增模組一內容</p>
								<hr-->
								
								<div class="form-group">
									<label for="type1_img1" class="lable_title">圖片一</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="連結" name="content[picture][0]">
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">圖片二</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2"placeholder="連結" name="content[picture][1]">
								</div>
							</div>
							<div id="template_2" class="edit_content_left">
								<!--button class="btn btn_editor" data-toggle="modal" data-target="#delete_exam" style="float: right; font-size: 14px; background-color: #B8B8B8!important; margin:0!important; ">刪除模組</button>
								<p class="title-brown" style="float: none;">新增模組二內容</p>
								<hr-->
								<!--div class="form-group">
									<label for="type1_img1" class="lable_title">模組名稱</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="模組名稱" name="content['name']">
								</div-->
								<div class="form-group">
									<label for="type1_img1" class="lable_title">Banner圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img1" placeholder="連結" name="content[banner]">
								</div>
								<div class="form-group">
									<div><label for="teacher_city" class="lable_title">廣告位置</label></div>
									<select class="browser-default custom-select" style="width: 300px;" name="content[ads_type]">
										<option value="none">無</option>
										<option value="right">右側</option>
										<option value="bottom">下方</option>
									</select>
								</div>
								<div class="form-group">
									<label for="type1_img2" class="lable_title">廣告圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2" placeholder="連結" name="content[ads_pic]">
								</div>
								<!--div class="form-group">
									<div><label for="teacher_city" class="lable_title">是否開啟廣告</label></div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio1" value="option1">
										<label class="form-check-label" for="inlineRadio1">是</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="stu_question_1" id="inlineRadio1" value="option1">
										<label class="form-check-label" for="inlineRadio1">否</label>
									</div>
								</div-->
								<div class="form-group">
									<label for="type1_img2" class="lable_title">彈跳視窗圖片</label>
									<input style="width: 100%;" type="text" class="form-control" id="type1_img2" placeholder="連結" name="content[popup]">
								</div>
								<div class="row" style="margin:0;">
									<div class="form-group float-left">
										<div><label for="edit_student_id" class="lable_title">頁籤標題</label></div>
										<div class="mr-3 float-left">
											<input type="text" class="form-control tab_title_input" data-id="1" name="content[tab_title][0]" placeholder="頁籤一" style="width: 150px;">
										</div>
										<div class="mr-3 float-left">
											<input type="text" class="form-control tab_title_input" data-id="2" name="content[tab_title][1]" placeholder="頁籤二" style="width: 150px;">
										</div>
										<div class="mr-3 float-left">
											<input type="text" class="form-control tab_title_input" data-id="3" name="content[tab_title][2]" placeholder="頁籤三" style="width: 150px;">
										</div>
										<div class="mr-3 float-left">
											<input type="text" class="form-control tab_title_input" data-id="4" name="content[tab_title][3]" placeholder="頁籤四" style="width: 150px;">
										</div>
									</div>
									
								</div>
								<hr style="margin:30px 0;">
								<!--題組內四個頁籤-->
								<div class="exam_tab_section">
									<ul class="nav" style="margin-bottom: 20px;" role="tablist">
										<li>
											<a id="tab_1" class="active exam_tab" data-toggle="tab" href="#content_1" role="tab" aria-controls="content_1"
												aria-selected="true">頁籤(一)</a>
										</li>
										<li>
											<a id="tab_2" class="exam_tab" data-toggle="tab" href="#content_2" role="tab" aria-controls="content_2"
												aria-selected="false">頁籤(二)</a>
										</li>
										<li>
											<a id="tab_3" class="exam_tab" data-toggle="tab" href="#content_3" role="tab" aria-controls="content_3"
												aria-selected="false">頁籤(三)</a>
										</li>
										<li>
											<a id="tab_4" class="exam_tab" data-toggle="tab" href="#content_4" role="tab" aria-controls="content_4"
												aria-selected="false">頁籤(四)</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="content_1" role="tabpanel" aria-labelledby="tab_1">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(一)</p>
												<textarea id="editor_1" class="ckeditor" name="content[tab_content][0]"></textarea>
											</div>
										</div>
										<div class="tab-pane fade" id="content_2" role="tabpanel" aria-labelledby="tab_2">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(二)</p>
												<textarea id="editor_2" class="ckeditor" name="content[tab_content][1]"></textarea>
											</div>
										</div>
										<div class="tab-pane fade" id="content_3" role="tabpanel" aria-labelledby="tab_3">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(三)</p>
												<textarea id="editor_3" class="ckeditor" name="content[tab_content][2]"></textarea>
											</div>
										</div>
										<div class="tab-pane fade" id="content_4" role="tabpanel" aria-labelledby="tab_4">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(四)</p>
												<textarea id="editor_4" class="ckeditor" name="content[tab_content][3]"></textarea>
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
														<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="question_map[]" value="{{ $question->id }}">
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
				</div>
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn_style">@if(isset($template))修改@else新增@endif</button>
					<button type="" class="btn btn_cancel" onclick="history.back()">返回</button>
				</div>
			</div>
		</div>
	</form>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>

$("#template_type").change(function(){
	$("#template_1,#template_2").hide();
	var type = $(this).val();
	$("#template_"+type).show();
});

$(".tab_title_input").bind("keyup change",function(){
	var tab_val = $(this).val();
	var tab_id = $(this).data('id');
	$("#tab_"+tab_id).text(tab_val);
});


var allEditors = document.querySelectorAll('.ckeditor');
for (var i = 0; i < allEditors.length; ++i) {
  ClassicEditor.create(allEditors[i]);
}

@if(isset($template))
	var template = {!! json_encode($template) !!};
	$("[name='content[name]']").val(template.content.name);
	$("[name='type']").val(template.type);
	
	$("[name='content[picture][0]']").val(template.content.picture[0]);
	$("[name='content[picture][1]']").val(template.content.picture[1]);
	$("[name='content[banner]']").val(template.content.banner);
	$("[name='content[ads_type]']").val(template.content.ads_type);
	$("[name='content[ads_pic]']").val(template.content.ads_pic);
	$("[name='content[popup]']").val(template.content.popup);
	$("[name='content[tab_title][0]']").val(template.content.tab_title[0]);
	$("[name='content[tab_title][1]']").val(template.content.tab_title[1]);
	$("[name='content[tab_title][2]']").val(template.content.tab_title[2]);
	$("[name='content[tab_title][3]']").val(template.content.tab_title[3]);
	$("[name='content[tab_content][0]']").val(template.content.tab_content[0]);
	$("[name='content[tab_content][1]']").val(template.content.tab_content[1]);
	$("[name='content[tab_content][2]']").val(template.content.tab_content[2]);
	$("[name='content[tab_content][3]']").val(template.content.tab_content[3]);
	
	for(x in template.question_map){
		$("[name^='question_map']").filter('[value='+template.question_map[x]+']').prop('checked', true);
	}
	
	/*
	$("[name='gender']").filter('[value='+user.gender+']').prop('checked', true);
	$("[name='city_id']").val(teacher.city_id);
	$("[name='school_id']").val(teacher.school_id);
	$("[name='grade']").val(teacher.grade);
	$("[name='classroom']").val(teacher.classroom);
	$("[name='account']").val(user.account);
	$("[name='password']").val(user.password);
	$("#teacher_password_again").val(user.password);
	
	for(x in teacher.subject){
		$("[name^='subject']").filter('[value='+teacher.subject[x]+']').prop('checked', true);
	}
	*/
@endif
$("#template_type").trigger('change');
</script>
@endsection
