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
		<div class="teacher_addClassNum">
			<p style="margin-bottom: 15px; font-weight: bold;" class="title-20 text-center">班級數量新增申請</p>
			<form action="{{ url('add-class') }}" method="POST">
			<div class="teacher_addClassNum_main white_box_bg mb-30">
				<div class="row" style="margin:0;">
					<div class="form-group mr-30">
						<div class="mr-30">
							<div><label for="quantity" class="lable_title">欲申請數量</label></div>
							<select name="number_of_classroom" class="browser-default custom-select" style="width: 400px;">
							@for($i =1; $i<= $mount;$i++)
								<option value="{{$i}}">{{$i}}</option>
							@endfor
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn_style">申請</button>
					<button type="" class="btn btn_cancel" onclick="location.href='{{ url('classrooms') }}'">取消</button>
				</div>
			</div>
			</form>

			<!-- 班級資料建立成功-彈跳視窗 -->
			<div class="modal fade" id="teacher_addClassNum" tabindex="-1" role="dialog"
				aria-labelledby="teacher_addClassNum" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body pop-up text-center">
							<p>已申請成功<br>
							請待2至3個工作天，<br>或主動聯絡管理者 ling0611@tea.ntue.edu.tw</p>
							<button type="button" class="btn btn_style" data-dismiss="modal" onclick="location.href='{{ url('classrooms') }}'">確認</button>
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
			  $("#teacher_addClassNum").modal('show');
		  }else{
			  alert(data.message);
		  }
		});
		//$('form').submit();
	});
</script>
@endsection
