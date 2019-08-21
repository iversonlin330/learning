@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container mb-5">
	<div class="teacher_class_list">
		<div class="top_right_button">
			<a class="btn btn_function" href="{{url('classrooms/create')}}">建立新班級</a>
		</div>
		<div class="class_list_table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width:12%;">班級ID</th>
						<th style="width:22%;">年級</th>
						<th style="width:22%;">班級</th>
						<th style="width:22%;">人數</th>
						<th style="width:22%;">功能</th>
					</tr>
				</thead>
				<tbody>
					@foreach($classrooms as $classroom)
						<tr data-id="{{$classroom->id}}">
							<td>{{ $classroom->class_number }}</td>
							<td>{{ $classroom->grade }}</td>
							<td>{{ $classroom->classroom }}</td>
							<td>{{ $classroom->number_student() }}</td>
							<td class="td-underline">
								<a href="{{url('classrooms/'.$classroom->id.'/edit')}}" style="float: left; margin-right: 10px;">編輯</a>
								<a class="delete" href="#">刪除</a>
							</td>
						</tr>
					@endforeach
					<!--tr>
						<td>A</td>
						<td>二</td>
						<td>甲班</td>
						<td>50</td>
						<td class="td-underline">
							<a href="UC2-PF11_class_edit.html" style="float: left; margin-right: 10px;">編輯</a>
							<a href="" data-toggle="modal" data-target="#delete" >刪除</a>
						</td>
					</tr-->
				</tbody>
			</table>
			<div class="application clearfix mb-5">
			  <a href="UC2-PF13_add_classNum.html">班級數量增加申請</a>
			  <a href="UC2-PF14_changeStudentID.html">學生ID更改申請</a>
			</div>
			<!-- 刪除確認-彈跳視窗 -->
			<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body pop-up text-center">
							<p>確認刪除此筆資料嗎？</p>
							<form action="{{url('classroom')}}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn_style">確認</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<button class="btn btn_style" onclick="location.href='{{url('groups')}}'">返回</button>
</div>
@endsection
 
@section('script')
@parent
<script>
$(".delete").click(function(){
	$("#delete form").attr('action',"{{url('classrooms/')}}/"+$(this).closest('tr').data('id'));
	$("#delete").modal('show');
})
   
</script>
@endsection
