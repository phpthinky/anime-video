<div class="post-index">
	<div class="panel-show-exam">
		
	<a class="btn btn-success btn-sm btn-show-exam" href="javascript:void(0);" data-exam="<?=$exam_id?>">Show exam</a>
	<input type="hidden" name="categories" id="categories" value="<?php echo isset($categories) ? $categories : false; ?>" 	\>

	</div>
	<div class="panel panel-exam-questions hidden">
		<div class="form-group">
			<form class="form form-horizontal" id="frmExam" method="post" action="">
				<div class="questions-id hidden">
					<input type="text" name="questions_id" id="questions_id" value=""/>
				</div>
				<div class="list-questions">
					
				</div>
				<div class="btn-submit">
					<div class="form-group">
						<label>&nbsp;&nbsp;&nbsp;</label><button class="btn btn-info btn-sm" id="btn_submit">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="panel panel-show-result">
		<center>
		<div class="loader hidden"></div>

		<div class="result hidden" style="font-size:30px; ">Result</div>
		
		</center>

	</div>

	<div class="panel panel-result-btn">

		<div class="col-md-12" style="">
			<div class="result-controls ">
			<div class="not-mobile">
				<button class="btn btn-stop hidden" id="btn_stop"><i class="fa fa-check"></i> Result</button>  <button class="btn btn-pause hidden" id="btn_pause" data-val='Pause'> <i class="fa fa-pause"></i></button>
				<button class="btn btn-info btn-next hidden" id="btn_next" data-val='Next'> <i class="fa fa-forward"></i></button>
			</div>


			</div>
			<div class="result-controls ">

			<div class="stopwatch">
	            <div class="controls hidden">
                <button class="start">Start</button>
                <button class="stop">Stop</button>
                <button class="reset">Reset</button>
	            </div>
	            <div class="display">
	                <span class="minutes">00</span><span class="seconds">00</span><span class="centiseconds">00</span>
	            </div>
       		</div>

			</div>
			<div class="result-controls ">
				<div class="answer-counter">
					<span class="answer-total">0</span>/<span class="exam-question">0</span>
				</div>
			</div>
		</div>

	</div>



</div>
<style type="text/css">

	.list-questions .panel-question{
		font-size: 16px;
	}
	.list-questions .panel-question p{
		display: inline;
	}

	.list-questions .panel-choices{
		font-size: 12px;
	}
</style>

<script type="text/javascript">

		var exam_id = 0;
		var category_id = 0;
		var a_category_id = 0;
		var i = 0;
		var i_question = 0;
		var i_answer = 0;
		var my_answer = false;
		var questions_id = false;
		var total_question = 0;


	$('.btn-show-exam').on('click',function() {
		// body...
		exam_id = $(this).data('exam');
		var categoy_id = $('#categories').val();
		
		category_id = categoy_id.split(',');
		a_category_id = category_id[i];

		var data = 'exam_id='+exam_id+'&category_id='+category_id[i] ;
		//console.log(category_id);
		//return false;
		questionaire(data);

	});

	
	$('#frmExam').on('submit',function(){
		var data = $(this).serialize();
		var timefinnish = $('.display .minutes').text()+':'+$('.display .seconds').text();

		data = data+'&exam_id='+exam_id+"&category_id="+a_category_id+"&questions_id="+JSON.stringify(questions_id)+'&timefinnish='+timefinnish;
		//console.log(questions_id);
		$('.loader').removeClass('hidden');
		$('.panel-exam-questions').addClass('hidden');
		if(i_question != 0 && i_question == i_answer){

			saveMyAnswer(data);



		}else{

		$('.panel-exam-questions').removeClass('hidden');
		$('.loader').addClass('hidden');

			if(i_question != i_answer){

				$('.navbar-coloftech').notify('You missed some question.You have only answer '+i_answer+' out of '+i_question+' questions.', { position:"bottom right", className:"warning" });
			}else{

				$('.navbar-coloftech').notify('Sorry you can\'t resubmit your answer. Reload the page to restart the exam.', { position:"bottom right", className:"warning" });
			}

		}

		return false;
	});

</script>

<script type="text/javascript">
	
	/* ------------function only---------------- */

	function questionaire(data) {
		// body...

		$.ajax({
			data: data,
			type: 'post',
			url: '../../exam/test',			
	    	statusCode: {
	        404: function() {
                  $('.navbar-coloftech').notify('Error 404! page not found.', { position:"bottom right", className:"warning" });
	        },
	        505: function() {
                  $('.navbar-coloftech').notify('Error 505! page not found.', { position:"bottom right", className:"warning" });
	        }
   			 },
			dataType: 'json',
			beforeSend: function(){
				$('.loader').removeClass('hidden');
			},
			success: function(result) {
				// body...
				// console.log(result);

				$('.loader').addClass('hidden');
				if(result.stats == true){

					$('.panel-exam-questions').removeClass('hidden');
					$('.panel-show-exam').hide('fast');
					var num = 1;
					var list = '';
					 	questions_id = false;
					 	questions_id = [];
						i_question = 0;
						i_answer = 0;
					/*$.each(result.questions, function(key, exam) {

						/*list = list+'<div class="panel panel-default"><div class="panel-body panel-question"><i>'+num+')</i>&nbsp;<span>'+exam.question+'</span></div><div class="panel-body panel-choices"><ul class="list"><li class="list_item"> <input type="radio" value="'+exam.choice_1+'" onclick="saveanswer('+exam.quiz_id+')" class="radio radio-inline radio-btn" id="choice_1_'+exam.quiz_id+'" name="choice_'+exam.quiz_id+'"/><label for="choice_1_'+exam.quiz_id+'" class="label"> A) '+exam.choice_1+'</label></li><li class="list_item"> <input type="radio" value="'+exam.choice_2+'" onclick="saveanswer('+exam.quiz_id+')" class="radio radio-inline radio-btn" id="choice_2_'+exam.quiz_id+'" name="choice_'+exam.quiz_id+'"/><label for="choice_2_'+exam.quiz_id+'" class="label"> B) '+exam.choice_2+'</label></li><li class="list_item"> <input type="radio" value="'+exam.choice_3+'" onclick="saveanswer('+exam.quiz_id+')" class="radio radio-inline radio-btn" id="choice_3_'+exam.quiz_id+'" name="choice_'+exam.quiz_id+'"/><label for="choice_3_'+exam.quiz_id+'" class="label"> C) '+exam.choice_3+'</label></li><li class="list_item"> <input type="radio" value="'+exam.choice_4+'" onclick="saveanswer('+exam.quiz_id+')" class="radio radio-inline radio-btn" id="choice_4_'+exam.quiz_id+'" name="choice_'+exam.quiz_id+'"/><label for="choice_4_'+exam.quiz_id+'" class="label"> D) '+exam.choice_4+'</label></li><li class="list_item"> <input type="radio" value="'+exam.choice_5+'" onclick="saveanswer('+exam.quiz_id+')" class="radio radio-inline radio-btn" id="choice_5_'+exam.quiz_id+'" name="choice_'+exam.quiz_id+'"/><label for="choice_5_'+exam.quiz_id+'" class="label"> E) '+exam.choice_5+'</label></li></ul></div></div>';
						
					//console.log(exam.question);
						total_question++;
						num++;
						i_question++;
						questions_id.push(exam.quiz_id);
					});*/
					i_question = result.total;
					total_question = total_question + result.total;
					questions_id = result.arr_quiz_id;
					//console.log(questions_id);
					list = result.questions;
						$('.answer-total').html('0');
						$('.exam-question').html(i_question);
						$('.list-questions').html(list);
						i++;

				}else{
					 $('.navbar-coloftech').notify('No question available. Try again later.', { position:"bottom right", className:"warning" });
				}
        	
       	 }

		});

	}

	function saveMyAnswer(data) {
		// body...

		$.ajax({
			data: data,
			type: 'post',
			url: '../../examination/save_answer',			
	    	statusCode: {
	        404: function() {
                  $('.navbar-coloftech').notify('Error 404! page not found.', { position:"bottom right", className:"warning" });
	        },
	        505: function() {
                  $('.navbar-coloftech').notify('Error 505! page not found.', { position:"bottom right", className:"warning" });
	        }
   			 },
			dataType: 'json',
			beforeSend: function(){

						$('.loader').removeClass('hidden');
			},
			success: function(result) {
				
				if(result.stats == true){
					$('.loader').addClass('hidden');

					$('.list-questions').html('');
					 	questions_id = false;
					 	questions_id = [];
						i_question = 0;
						i_answer = 0;


						a_category_id = category_id[i];


					 $('.reset').click();

					showNext();


					 $('.navbar-coloftech').notify('Your answer save successfully', { position:"bottom right", className:"success" });

				}else{
					 $('.navbar-coloftech').notify('No question available. Try again later.', { position:"bottom right", className:"warning" });
				}
        	
       	 }

		});

	}
	function showRatings(data) {
		// body...

		$.ajax({
			data: data,
			type: 'post',
			url: '../../examination/results',			
	    	statusCode: {
	        404: function() {
                  $('.navbar-coloftech').notify('Error 404! page not found.', { position:"bottom right", className:"warning" });
	        },
	        500: function() {
                  $('.navbar-coloftech').notify('Error 500! Internal server error occured.', { position:"bottom right", className:"warning" });
	        }
   			 },
			dataType: 'json',
			beforeSend: function(){

						$('.list-questions').html('');
						$('.loader').removeClass('hidden');

			},
			success: function(result) {

				if(result.stats == true){
					$('.panel-exam-questions').hide('fast');
					$('.result').removeClass('hidden').html('<span style="font-size:16px;">Your score is</span> <span>'+result.total_exam+'/'+total_question+'</span><br /><button class="btn btn-info" onclick="retake();">Retake</button>');
					$('.loader').addClass('hidden');


					 $('.navbar-coloftech').notify('Score proccess successfully.', { position:"bottom right", className:"success" });
					 total_question = 0;

					 $('.stop').click();

				}else{
					 $('.navbar-coloftech').notify('No question available. Try again later.', { position:"bottom right", className:"warning" });
				}
        	
       	 }

		});

	}
	function saveanswer(quiz_id) {
		// body...
		if(my_answer == false){

			my_answer = [];
			my_answer.push(quiz_id);
			i_answer++;
			//$('.start').click();
			$('.answer-total').html(i_answer);
		}else{

			if (jQuery.inArray(quiz_id, my_answer)!='-1') {
	           
	            return false;
	        } else {
	           my_answer.push(quiz_id);
	           i_answer++;
				$('.answer-total').html(i_answer);
	        }
		}
		if(i_answer == i_question){
			$('#btn_stop').removeClass('hidden');
		}
	}
	$('#btn_stop').on('click',function() {
		// body...
		$('#frmExam').submit();
		$(this).addClass('hidden');
	})


	function showNext() {
		// body...

						if(i < category_id.length){

							$('.list-questions').html('');

							var data = 'exam_id='+exam_id+'&category_id='+a_category_id;

							console.log(a_category_id);
							questionaire(data);

						
						}else{

							var data = 'exam_id='+exam_id+'&category_id='+JSON.stringify(category_id);

							$('.panel-exam-questions').hide('fast');
							showRatings(data);
						}
	}

	function retake() {
		// body...
		location.reload();
	}

	window.onload = function(e){ 
		$('.btn-show-exam').click();
	}
	$('.btn-show-exam').on('click',function (e) {

		if(my_answer == false){

			$('.start').click();
		}
	})
</script>
<script type="text/javascript" src="<?=base_url('public/assets/js/stopwatch.js')?>"></script>