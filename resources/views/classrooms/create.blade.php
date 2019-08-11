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
		<div class="teacher_creatClass">
			<p style="margin-bottom: 15px; font-weight: bold;" class="title-20 text-center">班級資料表建立</p>
			<form action="{{url('classrooms')}}" method="post">
			@csrf
			<div class="teacher_creatClass_main white_box_bg mb-30">
				<div class="row" style="margin:0;">
					<div class="form-group">
						<label for="class_id" class="lable_title">班級ID</label>
						<input style="width: 350px;" type="text" class="form-control" id="class_id" name="class_number" placeholder="只能輸入一個英文字母">
					</div>
					<div class="form-group mr-30">
						<div class="mr-30">
							<div><label for="class_grade" class="lable_title">年級</label></div>
							<select class="browser-default custom-select" name="grade" style="width: 350px;">
								<option value="1">二</option>
								<option value="2">三</option>
								<option value="3">四</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="class_name" class="lable_title">班級</label>
						<input style="width: 350px;" type="text" class="form-control" id="class_name" name="classroom">
					</div>
					<div class="form-group">
						<label for="class_people" class="lable_title">班級人數</label>
						<input style="width: 350px;" type="text" class="form-control" id="class_people" name="number_of_poeple">
					</div>
				</div>
			</div>
			<div class="text-center">
			   <div class="btn-group" >
					<button type="submit" class="btn btn_style" data-toggle="#modal" data-target="#teacher_creatClass">建立</button>
					<a type="" class="btn btn_cancel" href="{{url('classrooms')}}" >取消</a>
				</div> 
			</div>
			</form>
			
			
			<!-- 班級資料建立成功-彈跳視窗 -->
			<div class="modal fade" id="teacher_creatClass" tabindex="-1" role="dialog" aria-labelledby="teacher_creatClass"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body pop-up text-center">
							<p>班級資料表已建立成功!<br>
							學生ID已一併建置完畢<br>
							如欲查看，請至「功能/編輯」</p>
							<button type="button" class="btn btn_style" data-dismiss="modal" onclick="location.href='UC2-PF10_class_list.html'" >確認</button>
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
    $(function() {
    });
</script>
@endsection
