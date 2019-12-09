@extends('layouts.master')
 
@section('title', 'index')
 
@section('style')
@parent
<style>
	#assignation_exam button{
		margin-top:15px;
	}
	
	#assignation_exam img{
		width:100%;
	}
</style>
@endsection
 
@section('content')
<form action="{{ Request::url() }}" method="post">
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
				@foreach($new_question_no as $key => $value)
					<div id="no_{{ $key }}" class="question_no_default">{{ $value }}</div>
				@endforeach
					<!--div class="question_no_default question_no_now">1</div>
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
					<div class="question_no_default">21</div-->
				</div>
			</div>
			<div class="main_view">
				<div class="main_view_header">
					數位閱讀學習平台
				</div>
				<?php 
					$img_auto_change = []; 
				?>
				@foreach($templates as $template)
					@if($template->type == 1)
					<?php 
						$content = $template->content; 
						$img_auto_change[] = $template->order; 
					?>
					<div id="template_{{ $template->order }}" class="main_view_content">
						<img src="{{ $content['picture'][0] }}" alt="" style="width: 810px;height: auto;">
						@if(0)
						<img src="{{ $content['picture'][1] }}" alt="" style="width: 810px;height: auto;display:none;">
						@endif
					</div>
					@elseif($template->type == 2)
					<?php $content = $template->content ?>
					<div id="template_{{ $template->order }}" class="main_view_content" data-img="{{ $content['popup'] }}">
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
                                        <a class="{{ ($index == 0)? 'active' : '' }} exam_tab" data-toggle="tab" href="#topic_{{$template->id}}_{{$index}}" role="tab"
                                            aria-controls="topic_1" aria-selected="true">{{$value}}</a>
                                    </li>
									@endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($content['tab_content'] as $index => $value)
									<div class="tab-pane fade {{ ($index == 0)? 'show active' : '' }}" id="topic_{{$template->id}}_{{$index}}" role="tabpanel"
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
                                <img src="{{ $content['ads_pic'] }}" alt="" onclick="show_ads(this,{{$template->id}})">
                            </div>
							@endif
                        </div>
						@if($content['ads_type'] == 'bottom')
						<!--bottom-ad-->
                        <div class="ad_img_bottom">
                            <img src="{{ $content['ads_pic'] }}" alt="" onclick="show_ads(this,{{$template->id}})">
                        </div>
						@endif
                    </div>
					@endif
				@endforeach
				<div id="template_finish" class="main_view_content">
					<!--banner-->
					<div class="exam_banner">
						<img src="{{ asset('img/template3_banner.png') }}" alt="">
					</div>
					<div class="exam_finish">
						<div><p class="title-20">你已完成全部題目，要修改答案嗎？</p>
						</div>
						<div class="text-center">
							<div class="btn-group">
								<button type="submit" class="btn btn_style">送出答案</button>
								<button type="button" class="btn btn_cancel" onclick="change_template(1)">修改答案</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="question">
				<div class="question_header">
					<div style="position:relative;">
						<img src="{{ asset('img/mission.png') }}">
						<input type="button" value="返回" onclick="location.href='{{ url('groups') }}'" class="btn_function"
							style="position:absolute; right:10px; top:10px; padding:5px 10px; border-radius: 5px;" />
					</div>
				</div>
				<div class="question_content">
					@foreach($questions as $index => $question)
						<div id="q_{{$question->id}}" data-index="{{$question->id}}" class="question_each">
							<div class="question_each_title">
								{{array_key_exists($question->id,$new_question_no)? $new_question_no[$question->id] : ''}}. {{$question->name}}
							</div>
							<div class="question_each_content">
								<div class="question_each_content_img">
									<img src="{{ asset('img/student-pic.png') }}">
								</div>
								<div class="question_each_content_text">
									<div class="question_each_content_text_position">學生</div>
									<div class="question_each_content_text_descrition">
									@if($question->type == 1)
										<textarea name="answer[{{$question->id}}]"></textarea>
									@elseif($question->type == 2)
										<?php $item = json_decode($question->item,true) ?>
										@foreach($item as $index=>$val)
											<div class="answer_choose"><input type="radio" name="answer[{{$question->id}}]" value="{{chr(65+$index)}}">{{ $val }}</div>
										@endforeach
										
										@if(count($item) >= 4 && 0)
										<div class="answer_choose"><input type="radio" name="answer[{{$question->id}}]" value="A">{{ $item[0] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$question->id}}]" value="B">{{ $item[1] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$question->id}}]" value="C">{{ $item[2] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$question->id}}]" value="D">{{ $item[3] }}</div>
										@endif
									@elseif($question->type == 3)
										<?php $item = json_decode($question->item,true) ?>
										@foreach($item as $index=>$val)
											<div class="answer_choose"><input type="checkbox" name="answer[{{$question->id}}][]" value="{{chr(65+$index)}}">{{ $val }}</div>
										@endforeach
										@if(count($item) >= 4 && 0)
										<div class="answer_choose"><input type="checkbox" name="answer[{{$question->id}}][]" value="A">{{ $item[0] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$question->id}}][]" value="B">{{ $item[1] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$question->id}}][]" value="C">{{ $item[2] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$question->id}}][]" value="D">{{ $item[3] }}</div>
										@endif
									@endif
									@if(array_key_exists($question->id,$question_step))
									<div id="change_step">
										<div class="save_btn" onclick="change_template({{$question_step[$question->id]+1}})">下一步</div>
										@if($question_step[$question->id]-1 != 0)
                                        <div class="save_btn" style="margin-right:5px;" onclick="change_template({{$question_step[$question->id]-1}})">上一步</div>
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
</form>
<div class="modal fade" id="assignation_exam" tabindex="-1" role="dialog" aria-labelledby="assignation_exam"
				aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{ url('group_classrooms') }}" method="post">
			<div class="modal-body pop-up text-center">
			<img src="" style="max-height: 100vh;">
				<button type="button" class="btn btn_style" data-dismiss="modal">關閉</button>
			</div>
			</form>
		</div>
	</div>
</div>
@endsection
 
@section('script')
@parent
<script>
var question_map = {!! json_encode($question_map) !!}
var img_auto_change = {!! json_encode($img_auto_change) !!}
console.log(question_map);
console.log(img_auto_change);

var sec = 0;
function pad ( val ) { return val > 9 ? val : "0" + val; }
setInterval( function(){
	$("#seconds").html(pad(++sec%60));
	//$("#minutes").html(pad(parseInt(sec/60,10)));
	$("#minutes").html(pad(parseInt((sec/60)%60,10)));
	$("#hours").html(pad(parseInt(sec/3600,10)));
}, 1000);

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
	/*
	if(img_auto_change.indexOf(String(num)) > -1){
		$('#template_'+num).find('img:eq(0)').show();
		$('#template_'+num).find('img:eq(1)').hide();
		
		setTimeout(function (){
			$('#template_'+num).find('img:eq(0)').hide();
			$('#template_'+num).find('img:eq(1)').show();
		},3000);
	}
	*/
	
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

function show_ads(obj,template_id){
	$.ajax({
	  type: 'POST',
	  url: "{{url('/ads')}}",
	  data: {template_id:template_id},
	}).done(function(data) {
		console.log(data);
	});
	$("#assignation_exam img").attr('src',$(obj).attr('src'));
	$("#assignation_exam").modal('show');
}

$(".tab-content a").click(function(event){
	event.preventDefault();
	var img_url = $(this).closest('.main_view_content').data('img');
	$("#assignation_exam img").attr('src',img_url);
	$("#assignation_exam").modal('show');
})

$("[name^='answer']").change(function(){
	//console.log('123');
	//if($(this).val()){
	var q_id = $(this).closest('.question_each').data('index');
	//console.log(q_id.slice(2, 4));
	$("#no_"+q_id).addClass('question_no_now');
	//}
});

</script>
@endsection
