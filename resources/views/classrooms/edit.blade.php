@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="teacher_class_edit" style="width:400px; margin:0 auto;">
		<div class="top_right_button">
			<!--新增學生ID彈跳視窗-->
			<button class="btn btn_function" data-toggle="modal" data-target="#add_student_id">新增</button>
			<div class="modal fade" id="add_student_id" tabindex="-1" role="dialog" aria-labelledby="add_student_id"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body pop-up text-center">
							<form action="{{ url('users') }}" method="POST">
							<div class="exam_table">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>年級</th>
											<th>班級</th>
											<th>學生ID</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $classroom->grade }}</td>
											<td>{{ $classroom->classroom }}</td>
											<td><span>{{ str_pad($classroom->teacher->id,3,'0',STR_PAD_LEFT) }}{{ $classroom->class_number }}</span>
												<label for="student_id" class="lable_title"></label>
												<input type="text" class="form-control" id="student_id" name="student_id" placeholder="編號" style="display:inline; width:60px; height: 30px;" maxlength="2" required>
												<input type="text" name="classroom_id" value="{{ $classroom->id }}" hidden>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="text-center">
								<div class="btn-group">
									<button type="submit" class="btn btn_style">新增</button>
									<button type="" class="btn btn_cancel" data-dismiss="modal" >取消</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="class_edit_table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width:75%;">學生ID</th>
						@if(0)
						<th style="width:25%;">功能</th>
						@endif
					</tr>
				</thead>
				<tbody>
				@foreach($classroom->students as $student)
					<tr data-id="{{$student->user->id}}">
						<td>{{$student->user->account}}</td>
						@if(0)
						<td class="td-underline">
							<a class="delete" href="#">刪除</a>
						</td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>
			<!-- 刪除確認-彈跳視窗 -->
			<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body pop-up text-center">
							<p>確認刪除此筆資料嗎？</p>
							<form id="delete_form" action="" method="POST">
								@csrf
								@method('DELETE')
							<button type="submit" class="btn btn_style">確認</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="" class="btn btn_style" data-toggle="modal" data-target="#teacher_creatClass">儲存</button>
					<button type="" class="btn btn_cancel" onclick="location.href='{{url('classrooms')}}'">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
/*
    $("#delete_form").submit(function(e) {
		console.log('123');
		e.preventDefault();
		$.ajax({
		  type: 'POST',
		  url: $("form").attr('action'),
		  data: $("form").serialize(),
		}).done(function(data) {
		  if(data.success){
			  $("#teacher_creatClass").modal('show');
		  }else{
			  alert(data.message);
		  }
		});
	});
	*/
	$(".delete").click(function(){
		$("#delete form").attr('action',"{{url('users/')}}/"+$(this).closest('tr').data('id'));
		$("#delete").modal('show');
	})
</script>
@endsection
