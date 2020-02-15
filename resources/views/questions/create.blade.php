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
			<p style="margin-bottom: 15px; font-weight: bold;" class="title-20 text-center">@if(isset($question))修改@else新增@endif題目</p>
			
			@if(isset($question))
				<form action="{{url('questions/'.$id)}}" method="POST">
				@method('PUT')
			@else
				<form action="{{ url('questions') }}" method="post">
			@endif
			
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
							<textarea style="width: 390px; height: 170px;" type="text" class="form-control" id="que_content"  name="name" required></textarea>
						</div>
						<div class="form-group">
							<label for="que_content" class="lable_title">選項</label>
							<textarea style="width: 390px; height: 170px;" type="text" class="form-control" id="que_item"  name="item" placeholder="A@B@C@D"></textarea>
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
					<button type="submit" class="btn btn_style">@if(isset($question))確認@else新增@endif</button>
					<button type="button" class="btn btn_cancel" onclick="location.href='{{ url('groups/'.$group_id) }}'">返回</button>
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
@if(isset($question))
	var question = {!! json_encode($question) !!};
	$("[name='name']").val(question.name);
	$("[name='item']").val(question.item);
	$("[name='type']").val(question.type);
	$("[name='correct_answer']").val(question.correct_answer);
	$("[name='grade']").val(question.grade);
	$("[name='history']").val(question.history);
	$("[name='goal']").val(question.goal);
	/*
	
	$("[name='gender']").filter('[value='+user.gender+']').prop('checked', true);
	
	
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
</script>
@endsection
