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
				<!--tabs-->
				<div class="editor_header">
					<div class="float-left">
						<div class="float-left">
							<ul class="nav" role="tablist" id="exam_type">
								@foreach($templates as $index => $template)
								<li>
									<a class="btn btn_editor {{($index ==0 )? 'active' : '' }}" onclick="dj(this)" data-toggle="tab" href="#template_{{$template->id}}" role="tab"
										aria-controls="template_{{$template->id}}" aria-selected="true">模組一</a>
								</li>
								@endforeach
								<li>
									<a class="btn btn_editor active" onclick="dj(this)" data-toggle="tab" href="#topic_1" role="tab"
										aria-controls="topic_1" aria-selected="true">模組一</a>
								</li>
								<li>
									<a class="btn btn_editor" onclick="dj(this)" data-toggle="tab" href="#topic_2" role="tab" aria-controls="topic_2"
										aria-selected="false">模組二</a>
								</li>
							</ul>
						</div>
						<div class="float-left">
							<button type="" class="btn edit_btn no_move" data-toggle="modal" data-target="#add_exam">+</button>
						</div>

						<!--要新增哪個題組彈跳視窗-->
						<div class="modal fade" id="add_exam" tabindex="-1" role="dialog" aria-labelledby="add_exam" aria-hidden="true">
							<div class="modal-dialog" role="document" >
								<div class="modal-content">
									<div class="modal-body pop-up text-center">
										<div class="form-group">
											<div><label for="teacher_city" class="lable_title">新增模組</label></div>
											<select class="browser-default custom-select" style="width: 300px;">
												<option value="1">模組一</option>
												<option value="2">模組二</option>
											</select>
										</div>
										<button type="button" class="btn btn_style" data-dismiss="modal">確定</button>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="float-right">
						<div class="btn-group">
							<button type="" class="btn btn_style">儲存</button>
							<button type="" class="btn btn_cancel"onclick="history.back()">返回</button>
						</div>
					</div>
				</div>

				<div class="tab-content mx-auto">
				@foreach($templates as $index => $template)
					<div class="tab-pane fade show active" id="topic_1" role="tabpanel"
						aria-labelledby="topic_tab_1">
						<div>
							@if($template->type == 1)
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
							@elseif($template->type == 2)
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
														<textarea id="editor_1"></textarea>
													</div>
												</form>
												<script>
													ClassicEditor
														.create(document.querySelector('#editor_1'))
														.then(editor => {
															console.log(editor);
														})
												</script>
											</div>
										</div>
										<div class="tab-pane fade" id="content_2" role="tabpanel" aria-labelledby="tab_2">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(二)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_2"></textarea>
													</div>
												</form>
												<script>
													ClassicEditor
														.create(document.querySelector('#editor_2'))
														.then(editor => {
															console.log(editor);
														})
												</script>
											</div>
										</div>
										<div class="tab-pane fade" id="content_3" role="tabpanel" aria-labelledby="tab_3">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(三)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_3"></textarea>
													</div>
												</form>
												<script>
													ClassicEditor
														.create(document.querySelector('#editor_3'))
														.then(editor => {
															console.log(editor);
														})
												</script>
											</div>
										</div>
										<div class="tab-pane fade" id="content_4" role="tabpanel" aria-labelledby="tab_4">
											<div class="edit_content">
												<p class="tab_title mb-0">內容(四)</p>
												<!--文字編輯器-->
												<form id="form1" runat="server">
													<div>
														<textarea id="editor_4"></textarea>
													</div>
												</form>
												<script>
													ClassicEditor
														.create(document.querySelector('#editor_4'))
														.then(editor => {
															console.log(editor);
														})
												</script>
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
					@endforeach
					
					<div class="tab-pane fade" id="topic_2" role="tabpanel" aria-labelledby="topic_tab_2">
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
													<textarea id="editor_1"></textarea>
												</div>
											</form>
											<script>
												ClassicEditor
													.create(document.querySelector('#editor_1'))
													.then(editor => {
														console.log(editor);
													})
											</script>
										</div>
									</div>
									<div class="tab-pane fade" id="content_2" role="tabpanel" aria-labelledby="tab_2">
										<div class="edit_content">
											<p class="tab_title mb-0">內容(二)</p>
											<!--文字編輯器-->
											<form id="form1" runat="server">
												<div>
													<textarea id="editor_2"></textarea>
												</div>
											</form>
											<script>
												ClassicEditor
													.create(document.querySelector('#editor_2'))
													.then(editor => {
														console.log(editor);
													})
											</script>
										</div>
									</div>
									<div class="tab-pane fade" id="content_3" role="tabpanel" aria-labelledby="tab_3">
										<div class="edit_content">
											<p class="tab_title mb-0">內容(三)</p>
											<!--文字編輯器-->
											<form id="form1" runat="server">
												<div>
													<textarea id="editor_3"></textarea>
												</div>
											</form>
											<script>
												ClassicEditor
													.create(document.querySelector('#editor_3'))
													.then(editor => {
														console.log(editor);
													})
											</script>
										</div>
									</div>
									<div class="tab-pane fade" id="content_4" role="tabpanel" aria-labelledby="tab_4">
										<div class="edit_content">
											<p class="tab_title mb-0">內容(四)</p>
											<!--文字編輯器-->
											<form id="form1" runat="server">
												<div>
													<textarea id="editor_4"></textarea>
												</div>
											</form>
											<script>
												ClassicEditor
													.create(document.querySelector('#editor_4'))
													.then(editor => {
														console.log(editor);
													})
											</script>
										</div>
									</div>
								</div>
							</div>                                                                                                  
						</div>
						<div class="edit_content_right">
							<p class="title-brown" style="float: none; text-align: center;">選取對應題目</p>
							<div class="select_question">
								<table class="table table-bordered text-center">
									<thead>
										<tr>
											<th>題號</th>
											<th>選取</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>01</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>02</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>03</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>04</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>05</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>06</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>07</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>08</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>09</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>10</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>11</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>12</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>13</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>14</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>15</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>16</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>17</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>18</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>19</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>20</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>21</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>22</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>23</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>24</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>25</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>26</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>27</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>28</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>29</td>
											<td class="text-center">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for=""></label>
												</div>
											</td>
										</tr>
										<tr>
											<td>30</td>
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
						</div>
					</div>
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

$("#exam_type").sortable({});

$("#exam_type").sortable({ cancel: ".no_move" });

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
