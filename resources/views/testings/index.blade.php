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
		<div class="exam">
			<div class="left_side">
				<div class="timer">
					<div>Time
						</br>
						<label id="hours">00</label>:<label id="minutes">00</label>:<label id="seconds">00</label>
					</div>
				</div>
				<div class="question_no">
					<div class="question_no_default question_no_now">1</div>
					<div class="question_no_default">2</div>
					<div class="question_no_default">3</div>
					<div class="question_no_default">4</div>
					<div class="question_no_default">5</div>
					<div class="question_no_default">6</div>
					<div class="question_no_default">7</div>
					<div class="question_no_default">8</div>
					<div class="question_no_default">9</div>
					<div class="question_no_default">10</div>
					<div class="question_no_default">11</div>
					<div class="question_no_default">12</div>
					<div class="question_no_default">13</div>
					<div class="question_no_default">14</div>
					<div class="question_no_default">15</div>
					<div class="question_no_default">16</div>
					<div class="question_no_default">17</div>
					<div class="question_no_default">18</div>
					<div class="question_no_default">19</div>
					<div class="question_no_default">20</div>
					<div class="question_no_default">21</div>
				</div>
			</div>
			<div class="main_view">
				<div class="main_view_header">
					數位閱讀學習平台
				</div>
				@foreach($templates as $template)
					@if($template->type == 1)
					<div id="template_{{ $template->order }}" class="main_view_content">
						<img src="{{ asset('img/exam_type_img.jpg') }}" alt="">
					</div>
					@elseif($template->type == 2)
					<?php $content = $template->content ?>
					<div id="template_{{ $template->order }}" class="main_view_content">
                        <!--banner-->
                        <div class="exam_banner">
                            <img src="{{ $content['banner'] }}" alt="">
                        </div>
						<div class="exam_main_section" 
						
						@if($content['ads_type'] == 'right')
						{!! 'style="padding: 0;"' !!}
						@endif
						>
                            <!--tabs-->
							 <div class="
								@if($content['ads_type'] == 'right')
									exam_tab_section_left
								@else
									exam_tab_section
								@endif
							">
                                <ul class="nav" style="margin-bottom: 40px;" role="tablist">
                                    @foreach($content['tab_title'] as $index => $value)
									<li>
                                        <a class="{{ ($index == 0)? 'active' : '' }} exam_tab" data-toggle="tab" href="#topic_{{$index}}" role="tab"
                                            aria-controls="topic_1" aria-selected="true">{{$value}}</a>
                                    </li>
									@endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($content['tab_content'] as $index => $value)
									<div class="tab-pane fade {{ ($index == 0)? 'show active' : '' }}" id="topic_{{$index}}" role="tabpanel"
                                        aria-labelledby="topic_tab_1">
                                        <div class="exam_content">
                                            <p class="exam_content_title">{{ $content['tab_title'][$index] }}</p>
                                            {!! $value !!}
                                        </div>
                                    </div>
									@endforeach
                                </div>
                            </div>
							@if($content['ads_type'] == 'right')
							<!--right-ad-->
                            <div class="ad_img_right">
                                <img src="{{ $content['ads_pic'] }}" alt="">
                            </div>
							@endif
                        </div>
						@if($content['ads_type'] == 'bottom')
						<!--bottom-ad-->
                        <div class="ad_img_bottom">
                            <img src="{{ $content['ads_pic'] }}" alt="">
                        </div>
						@endif
                    </div>
					@endif
				@endforeach
			</div>
			<div class="question">
				<div class="question_header">
					<div style="position:relative;">
						<img src="{{ asset('img/mission.png') }}">
						<input type="button" value="返回" onclick="history.back()" class="btn_function"
							style="position:absolute; right:10px; top:10px; padding:5px 10px; border-radius: 5px;" />
					</div>
				</div>
				<div class="question_content">
					@foreach($questions as $index => $question)
						<div id="q_{{$question->no}}" class="question_each">
							<div class="question_each_title">
								{{$new_question_no[$question->no]}}. {{$question->name}}
							</div>
							<div class="question_each_content">
								<div class="question_each_content_img">
									<img src="{{ asset('img/student-pic.png') }}">
								</div>
								<div class="question_each_content_text">
									<div class="question_each_content_text_position">學生</div>
									<div class="question_each_content_text_descrition">
									@if($question->type == 1)
										<textarea name="answer[{{$index}}]"></textarea>
									@elseif($question->type == 2)
										<?php $item = explode('@',$question->item) ?>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="A">{{ $item[0] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="B">{{ $item[1] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="C">{{ $item[2] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="D">{{ $item[3] }}</div>
									@elseif($question->type == 3)
										<?php $item = explode('@',$question->item) ?>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="A">{{ $item[0] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="B">{{ $item[1] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="C">{{ $item[2] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="D">{{ $item[3] }}</div>
									@endif
									@if(array_key_exists($index+1,$question_step))
									<div id="change_step">
										<div class="save_btn" onclick="change_template({{$question_step[$index+1]+1}})">下一步</div>
										@if($question_step[$index+1]-1 != 0)
                                        <div class="save_btn" style="margin-right:5px;" onclick="change_template({{$question_step[$index+1]-1}})">上一步</div>
										@endif
									</div>
									@endif
									</div>
								</div>
							</div>
							<hr class="style-one" />
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection
 
@section('script')
@parent
<script>
var question_map = {!! json_encode($question_map) !!}
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
	//console.log(question_map[num]);
	for(x in question_map[num]){
		console.log('#q_'+question_map[num][x]);
		$('#q_'+question_map[num][x]).show();
	}
}



</script>
@endsection
