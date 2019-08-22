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
		<div class="teacher_studentId_change">
			<p style="margin-bottom: 15px; font-weight: bold;" class="title-20 text-center">學生ID更改申請</p>
			<form action="{{ url('change-id') }}" method="post">
			<div class="teacher_studentId_change_main white_box_bg mb-30">
				<div class="row" style="margin:0;">
					<div class="form-group">
						<label for="original_student_id" class="lable_title">原學生ID</label>
						<input style="width: 350px;" type="text" class="form-control" id="original_student_id" required>
					</div>
					<div class="new_student_id">
						<label for="class_name" class="lable_title">新學生ID</label>
						<input style="width: 350px;" type="text" class="form-control" id="new_student_id" required>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn_style" data-toggle="modal"
						data-target="#teacher_studentId_change" >申請</button>
					<button type="" class="btn btn_cancel" onclick="history.back()">取消</button>
				</div>
			</div>
			</form>

			<!-- 學生ID更改申請-彈跳視窗 -->
			<div class="modal fade" id="teacher_studentId_change" tabindex="-1" role="dialog"
				aria-labelledby="teacher_studentId_change" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body pop-up text-center">
							<p>已申請成功<br>
							請待2至3個工作天，或主動聯絡管理員<br>
							ling0611@tea.ntue.edu.tw</p>
							<button type="button" class="btn btn_style" data-dismiss="modal" onclick="location.href='UC2-PF10_class_list.html'">確認</button>
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
	$("form").submit(function(e) {
		e.preventDefault();
		$.ajax({
		  type: 'POST',
		  url: $("form").attr('action'),
		  data: $("form").serialize(),
		}).done(function(data) {
		  if(data.success){
			  $("#teacher_studentId_change").modal('show');
		  }else{
			  alert(data.message);
		  }
		});
		//$('form').submit();
	});
</script>
@endsection
