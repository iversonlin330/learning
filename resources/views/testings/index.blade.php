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
				<div class="main_view_content">
					<!--banner-->
					<div class="exam_banner">
						<img src="{{ asset('img/exam-banner.jpg') }}" alt="">
					</div>
					<div class="exam_main_section">
						<!--tabs-->
						<div class="exam_tab_section">
							<ul class="nav" style="margin-bottom: 40px;" role="tablist">
								<li>
									<a class="active exam_tab" data-toggle="tab" href="#topic_1" role="tab"
										aria-controls="topic_1" aria-selected="true">矮靈祭的由來</a>
								</li>
								<li>
									<a class="exam_tab" data-toggle="tab" href="#topic_2" role="tab"
										aria-controls="topic_2" aria-selected="false">矮靈祭儀式</a>
								</li>
								<li>
									<a class="exam_tab" data-toggle="tab" href="#topic_3" role="tab"
										aria-controls="topic_3" aria-selected="false">祭典中的器物</a>
								</li>
								<li>
									<a class="exam_tab" data-toggle="tab" href="#topic_4" role="tab"
										aria-controls="topic_4" aria-selected="false">矮靈祭新聞報導</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="topic_1" role="tabpanel"
									aria-labelledby="topic_tab_1">
									<div class="exam_content">
										<p class="exam_content_title">矮靈祭的由來</p>
										<p>很久以前上坪溪上游住著一群身軀只有三尺長的矮人，他們身材短小，但臂力驚人、擅長巫術，精於農耕，而且還將農耕技巧傳授給賽夏族人；因此每年稻栗成熟時，賽夏族人會邀請矮人們共同慶祝穀物豐收。
										</p>
										<p>矮人們認為長期協助賽夏族人改善農耕技術，漸漸自大起來，甚至常到部落欺負婦女，讓賽夏族人忍無可忍，但又不敢正面報復，於是開始密謀消滅矮人。</p>
										<p>賽夏族青年想到，每次豐年慶結束後，矮人們都會爬上兩族交界懸崖上的大樹休息，因此，他們決定暗中將那棵大樹底部切去大半，塗上泥巴偽裝。果然，那年的豐年慶後，矮人們喝完酒上了大樹休息。承受不了矮人重量的大樹就開始傾斜、倒塌！砰！樹上的矮人們一一掉進深潭中淹死了。
											其中有兩位矮人沒爬上樹，倖免於死，沿河逃命時，邊撕山棕葉子邊詛咒：「撕破這一片，山豬吃掉你們的農作物。再撕這一片，麻雀啄食你們的農作物。你們如果不按期舉行矮人祭，農作物會欠收，族群會滅亡！」不久後，賽夏族開始瘟疫流行，農作物欠收，認為是矮靈的報復，從此開始舉行矮靈祭，祭悼被害死的矮靈。
										</p>
										</p>
										<p>(文字參考原住民族委員會兒童版內容並略加修飾https://reurl.cc/eM7L7)</p>
									</div>
								</div>
								<div class="tab-pane fade" id="topic_2" role="tabpanel"
									aria-labelledby="topic_tab_2">
									<div class="exam_content">
										<p class="exam_content_title">矮靈祭的由來2</p>
										<p>很久以前上坪溪上游住著一群身軀只有三尺長的矮人，他們身材短小，但臂力驚人、擅長巫術，精於農耕，而且還將農耕技巧傳授給賽夏族人；因此每年稻栗成熟時，賽夏族人會邀請矮人們共同慶祝穀物豐收。
										</p>
										<p>矮人們認為長期協助賽夏族人改善農耕技術，漸漸自大起來，甚至常到部落欺負婦女，讓賽夏族人忍無可忍，但又不敢正面報復，於是開始密謀消滅矮人。</p>
										<p>賽夏族青年想到，每次豐年慶結束後，矮人們都會爬上兩族交界懸崖上的大樹休息，因此，他們決定暗中將那棵大樹底部切去大半，塗上泥巴偽裝。果然，那年的豐年慶後，矮人們喝完酒上了大樹休息。承受不了矮人重量的大樹就開始傾斜、倒塌！砰！樹上的矮人們一一掉進深潭中淹死了。
											其中有兩位矮人沒爬上樹，倖免於死，沿河逃命時，邊撕山棕葉子邊詛咒：「撕破這一片，山豬吃掉你們的農作物。再撕這一片，麻雀啄食你們的農作物。你們如果不按期舉行矮人祭，農作物會欠收，族群會滅亡！」不久後，賽夏族開始瘟疫流行，農作物欠收，認為是矮靈的報復，從此開始舉行矮靈祭，祭悼被害死的矮靈。
										</p>
										</p>
										<p>(文字參考原住民族委員會兒童版內容並略加修飾https://reurl.cc/eM7L7)</p>
									</div>
								</div>
								<div class="tab-pane fade" id="topic_3" role="tabpanel"
									aria-labelledby="topic_tab_3">
									<div class="exam_content">
										<p class="exam_content_title">矮靈祭的由來3</p>
										<p>很久以前上坪溪上游住著一群身軀只有三尺長的矮人，他們身材短小，但臂力驚人、擅長巫術，精於農耕，而且還將農耕技巧傳授給賽夏族人；因此每年稻栗成熟時，賽夏族人會邀請矮人們共同慶祝穀物豐收。
										</p>
										<p>矮人們認為長期協助賽夏族人改善農耕技術，漸漸自大起來，甚至常到部落欺負婦女，讓賽夏族人忍無可忍，但又不敢正面報復，於是開始密謀消滅矮人。</p>
										<p>賽夏族青年想到，每次豐年慶結束後，矮人們都會爬上兩族交界懸崖上的大樹休息，因此，他們決定暗中將那棵大樹底部切去大半，塗上泥巴偽裝。果然，那年的豐年慶後，矮人們喝完酒上了大樹休息。承受不了矮人重量的大樹就開始傾斜、倒塌！砰！樹上的矮人們一一掉進深潭中淹死了。
											其中有兩位矮人沒爬上樹，倖免於死，沿河逃命時，邊撕山棕葉子邊詛咒：「撕破這一片，山豬吃掉你們的農作物。再撕這一片，麻雀啄食你們的農作物。你們如果不按期舉行矮人祭，農作物會欠收，族群會滅亡！」不久後，賽夏族開始瘟疫流行，農作物欠收，認為是矮靈的報復，從此開始舉行矮靈祭，祭悼被害死的矮靈。
										</p>
										</p>
										<p>(文字參考原住民族委員會兒童版內容並略加修飾https://reurl.cc/eM7L7)</p>
									</div>
								</div>
								<div class="tab-pane fade" id="topic_4" role="tabpanel"
									aria-labelledby="topic_tab_4">
									<div class="exam_content">
										<p class="exam_content_title">矮靈祭的由來4</p>
										<p>很久以前上坪溪上游住著一群身軀只有三尺長的矮人，他們身材短小，但臂力驚人、擅長巫術，精於農耕，而且還將農耕技巧傳授給賽夏族人；因此每年稻栗成熟時，賽夏族人會邀請矮人們共同慶祝穀物豐收。
										</p>
										<p>矮人們認為長期協助賽夏族人改善農耕技術，漸漸自大起來，甚至常到部落欺負婦女，讓賽夏族人忍無可忍，但又不敢正面報復，於是開始密謀消滅矮人。</p>
										<p>賽夏族青年想到，每次豐年慶結束後，矮人們都會爬上兩族交界懸崖上的大樹休息，因此，他們決定暗中將那棵大樹底部切去大半，塗上泥巴偽裝。果然，那年的豐年慶後，矮人們喝完酒上了大樹休息。承受不了矮人重量的大樹就開始傾斜、倒塌！砰！樹上的矮人們一一掉進深潭中淹死了。
											其中有兩位矮人沒爬上樹，倖免於死，沿河逃命時，邊撕山棕葉子邊詛咒：「撕破這一片，山豬吃掉你們的農作物。再撕這一片，麻雀啄食你們的農作物。你們如果不按期舉行矮人祭，農作物會欠收，族群會滅亡！」不久後，賽夏族開始瘟疫流行，農作物欠收，認為是矮靈的報復，從此開始舉行矮靈祭，祭悼被害死的矮靈。
										</p>
										</p>
										<p>(文字參考原住民族委員會兒童版內容並略加修飾https://reurl.cc/eM7L7)</p>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
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
						<div id="q_{{$index}}" class="question_each">
							<div class="question_each_title">
								{{$index+1}}. {{$question->name}}
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
										<?php $item = explode(',',$question->item) ?>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="A">{{ $item[0] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="B">{{ $item[1] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="C">{{ $item[2] }}</div>
										<div class="answer_choose"><input type="radio" name="answer[{{$index}}]" value="D">{{ $item[3] }}</div>
									@elseif($question->type == 3)
										<?php $item = explode(',',$question->item) ?>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="A">{{ $item[0] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="B">{{ $item[1] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="C">{{ $item[2] }}</div>
										<div class="answer_choose"><input type="checkbox" name="answer[{{$index}}][]" value="D">{{ $item[3] }}</div>
									@endif
										<div class="save_btn " onclick="save_answer({{$index}});">儲存</div>
									</div>
								</div>
							</div>
							<hr class="style-one" />
						</div>
					@endforeach
				
					<!--div id="q_1" class="question_each">
						<div class="question_each_title">
							1. 單選題示意單選題示意單選題示意單選題示意?
						</div>
						<div class="question_each_content">
							<div class="question_each_content_img">
								<img src="{{ asset('img/mission.png') }}img/student-pic.png">
							</div>
							<div class="question_each_content_text">
								<div class="question_each_content_text_position">學生</div>
								<div class="question_each_content_text_descrition">
									<div class="answer_choose"><input type="radio" name="answer[2]" value="A">泰雅族</div>
									<div class="answer_choose"><input type="radio" name="answer[2]" value="B">排灣族</div>
									<div class="answer_choose"><input type="radio" name="answer[2]" value="C">賽夏族</div>
									<div class="answer_choose"><input type="radio" name="answer[2]" value="D">卑南族</div>
									<div class="save_btn " onclick="save_answer(2);">儲存</div>
								</div>
							</div>
						</div>
						<hr class="style-one" />
					</div>
					<div id="q_2" class="question_each">
						<div class="question_each_title">
							2. 複選題示意複選題示意複選題示意複選題示意複選題示意?
						</div>
						<div class="question_each_content">
							<div class="question_each_content_img">
								<img src="img/student-pic.png">
							</div>
							<div class="question_each_content_text">
								<div class="question_each_content_text_position">學生</div>
								<div class="question_each_content_text_descrition">
									<div class="answer_choose"><input type="checkbox" name="" value="A">泰雅族</div>
									<div class="answer_choose"><input type="checkbox" name="" value="B">排灣族</div>
									<div class="answer_choose"><input type="checkbox" name="" value="C">賽夏族</div>
									<div class="answer_choose"><input type="checkbox" name="" value="D">卑南族</div>
									<div class="save_btn " onclick="save_answer(2);">儲存</div>
								</div>
							</div>
						</div>
						<hr class="style-one" />
					</div>
					<div id="q_3" class="question_each">
						<div class="question_each_title">
							3. 簡答示意簡答示意簡答示意簡答示意簡答示意簡答示意?
						</div>
						<div class="question_each_content">
							<div class="question_each_content_img">
								<img src="img/student-pic.png">
							</div>
							<div class="question_each_content_text">
								<div class="question_each_content_text_position">學生</div>
								<div class="question_each_content_text_descrition">
									<textarea name="answer[7]"></textarea>
									<div class="save_btn" onclick="save_answer(7);">儲存</div>
								</div>
							</div>
						</div>
						<hr class="style-one" />
					</div>
					<div id="q_4" class="question_each">
						<div class="question_each_title">
							4. 最後一題最後一題示意
						</div>
						<div class="question_each_content">
							<div class="question_each_content_img">
								<img src="img/student-pic.png">
							</div>
							<div class="question_each_content_text">
								<div class="question_each_content_text_position">學生</div>
								<div class="question_each_content_text_descrition">
									<textarea name="answer[7]"></textarea>
									<div class="save_btn" onclick="location.href='exam_finish.html'">下一步</div>
								</div>
							</div>
						</div>
					</div-->
				</div>
			</div>
		</div>
	</div>
@endsection
 
@section('script')
@parent
<script>
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
</script>
@endsection
