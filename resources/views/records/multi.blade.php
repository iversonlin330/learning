@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
</style>
@endsection
 
@section('content')
 <div class="container mb-5">
	<div class="top_right_button">
		
			<button class="btn btn_function" onclick="location.href='{{url('record/multi-export?'.$url)}}'">匯出題組資料</button>
			<button class="btn btn_function" onclick="location.href='{{url('record/multi-export2?'.$url)}}'">匯出詳細資料</button>
		@if(Auth::user()->role == 99)
		@else
			<!--button class="btn btn_function" onclick="location.href='{{url('record/multi-export?'.$url)}}'">資料匯出</button-->
		@endif
	</div>
	<div class="teacher_view_all_result mb-5">
		<div class="row">
			<div class="all_result_table">
			@foreach($multi_result as $multi)
			<?php $result = $multi['result']; ?>
				<div class="exam_detial_table ">
					<p class="title-brown">{{ $multi['group']->subject }}/{{ $multi['group']->grade }}/{{ $multi['group']->title }}</p>
					<table class="table table-bordered" id="result_table">
						<thead>
							<tr>
								<th style="width:20%">題號</th>
								<th style="width:80%">正確率</th>
							</tr>
						</thead>
						<tbody class="scroll_section">
							@foreach($multi['questions'] as $question)
							<tr>
								<td style="width:20%">{{ $question->no }}</td>
								<td style="width:80%">
									@if($question->type==1)
										@if(array_key_exists($question->id,$result))
										@foreach($result[$question->id] as $v)
											・{{$v}}<br>
										@endforeach
										@endif
									@elseif($question->type==2)
									<div style="width: 220px; height: 220px">
									  <canvas class="canvasPie" data-rate="{{ implode(',',$result[$question->id]) }}"></canvas>
									</div>
									@elseif($question->type==3)
									<div style="width: 220px; height: 220px">
									  <canvas class="canvasPie" data-rate="{{ implode(',',$result[$question->id]) }}"></canvas>
									</div>
									@endif
								</td>
							</tr>
							
							@endforeach
							
							
							
							<!--tr>
								<td style="width:20%">1</td>
								<td style="width:80%">
									<div style="width: 220px; height: 220px">
										<canvas id="correct_rate_1"></canvas>
									</div>
								</td>
							</tr>
							<tr>
								<td style="width:20%">2</td>
								<td style="width:80%">
									・簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答
									文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字。<br>
									・簡答文字簡答文字簡答文字簡答文字簡答 ・
								</td>
							</tr>
							<tr>
								<td style="width:20%">3</td>
								<td style="width:80%">
									・簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答
									文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字文字簡答文字簡答文字簡答文字簡答文字簡答文字簡答文字。<br>
									・簡答文字簡答文字簡答文字簡答文字簡答簡答文字簡答文字簡答文字簡答文字
								</td>
							</tr-->
						</tbody>
					</table>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<button type="" class="btn btn_style"  onclick="location.href='{{url('record/index')}}'">返回</button>
</div>
@endsection
 
@section('script')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script>
//資料標題
    var labels = ['A', 'B','C','D'];

$(".canvasPie").each(function(){
	var rate = $(this).data('rate');
	
    var pieChart = new Chart($(this), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                //答案比例
                data: rate.split(","),
                backgroundColor: [
                    //資料顏色
                    "#FDC777",
                    "#E57878",
                    "#78A0E5",
                    "#88725B"
                ],
            }],
        }
    });
	
	
})


    var ctx = document.getElementById('canvasPie').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                //答案比例
                data: [10,30,20,40],
                backgroundColor: [
                    //資料顏色
                    "#FDC777",
                    "#E57878",
                    "#78A0E5",
                    "#88725B"
                ],
            }],
        }
    });
</script>
@endsection
