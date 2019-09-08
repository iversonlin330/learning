@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
<div class="container container_exam">
	<div class="row">
		<div class="exam" id="final" >
			<div class="main_view">
				<div class="main_view_header">
					數位閱讀學習平台
				</div>
				<div class="main_view_content">
					<div class="exam_final">
							<p class="title-brown" style="vertical-align:bottom;">作答結果</p>
							<div class="top_right_button">
								<div class="btn timer" style="float: right">
									<div>答對率
									</br>
										<label id="answer_rate">{{ $rate }}%</label>
									</div>
								</div>
							</div>
							<div class="answer_table">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="width:8%;">題號</th>
											<th style="width:46%;">作答答案</th>
											<th style="width:46%;">參考答案</th>
										</tr>
									</thead>
									<tbody>
									@foreach($questions as $index => $question)
										<tr>
											<td>{{ $index+1 }}</td>
											@if($question->type == 3)
												@if(array_key_exists($question->id,$user_answers))
													<td>{{ implode(',',json_decode($user_answers[$question->id])) }}</td>
												@else
													<td></td>
												@endif
											<td>{{ implode(',',json_decode($question->correct_answer)) }}</td>
											@else
												@if(array_key_exists($question->id,$user_answers))
													<td>{{ $user_answers[$question->id] }}</td>
												@else
													<td></td>
												@endif
												<td>{{ $question->correct_answer }}</td>
											@endif
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						<div class="text-center">
							<div class="btn-group">
								<button class="btn btn_style" onclick="location.href='{{ url('groups') }}'">確認</button>
							</div>
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
/*
var question_map = {!! json_encode(1) !!}
console.log(question_map);
function question_no_change(num){
	$(".question_no div").removeClass('question_no_now');
	
	if(num == 0){
		num = 1;
	}
	num = num.toString().split("_")[0];
	//num = num.toString().substr(0,1);
	num = num -1;
	$(".question_no div:eq("+num+")").addClass('question_no_now');
}
change_template(1);
function change_template(num){
	$(".main_view_content").hide();
	$(".question_content .question_each").hide();
	$('#template_'+num).show();
	console.log(Object.keys(question_map).length);
	if(num > Object.keys(question_map).length){
		//Final
		$('#template_finish').show();
	}else{
		for(x in question_map[num]){
			console.log('#q_'+question_map[num][x]);
			$('#q_'+question_map[num][x]).show();
		}
	}
}
*/


</script>
@endsection
