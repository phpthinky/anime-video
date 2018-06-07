
<style type="text/css">
	

</style>
<div class="panel exam-info">
	<div class="panel-body exam-start">
		<h3><?=($examinfo[0]->quizes_title) ? $examinfo[0]->quizes_title : '';?></h3>
		<?php if ($examinfo[0]->category): ?>
				<ul class="list-unstyled" style="margin-left: 10px;"><h4>CATEGORY</h4>
					
			<?php $i=0; foreach ($examinfo[0]->category as $key): ?>
			<?php $catergories[] = $key->category_id; ?>
				<li><?=$key->category_name ?><input type="hidden" name="category[]" id="category<?=$i?>" value="<?=$key->category_id ?>"></li>
			<?php $i++; endforeach ?>

				</ul>

		<?php endif ?>
		<button class="btn btn-success" id="btn_start">Start exam</button>
	</div>
	<div class="panel-body exam-result hidden">
		<center>
			<h2>Your score</h2>
		<div class="exam-rating"></div>
		<div class="restart"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-info">Retake</a></div>
		</center>

	</div>

</div>
<div class="panel exam-starter" style="display: block;border-radius: 0;width: 100%;">
	<div class="on-pause">
		
		
	</div>
	<div class="panel-body panel-choices list-exam"></div>

	<br/>
	<br/>
	<br/>
	<div class="panel-body panel-result-btn">

		<div class="col-md-12" style="">
			<div class="result-controls ">
			<div class="not-mobile">
				<button class="btn btn-stop" id="btn_stop"><i class="fa fa-check"></i> Result</button>  <button class="btn btn-pause" id="btn_pause" data-val='Pause'> <i class="fa fa-pause"></i></button>
				<button class="btn btn-info btn-next" id="btn_next" data-val='Next'> <i class="fa fa-forward"></i></button>
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
					<span class="answer-total">0</span>/<span class="answer-question">0</span>
				</div>
			</div>
		</div>

	</div>
</div>





<script type="text/javascript" src="<?=base_url('public/assets/js/stopwatch.js')?>"></script>

<script type="text/javascript">
	function start_timer() {
	// body...
	/*
	var data = 'timer=start';
	$.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("timer/start"); ?>',
      dataType: 'json',
      success: function(resp){

      }
	});
	*/
}

function pause_timer() {
	// body...
	//alert('hey');
	/*var data = 'timer=start';
	$.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("timer/pause"); ?>',
      dataType: 'html',
      success: function(resp){

      	////
      }
	});
	*/
}

</script>


<script type="text/javascript">
	var btn_pause_2 = false;
	var btn_stop_2 = false;
	var btn_next = false;

    var j=0;
    var t=0;


	$('.btn-next').on('click',function() {

	if(catergories.length <= next_i){

			$('#btn_stop').removeAttr("disabled");
			$('#btn_stop').removeClass('disabled');
			$(this).attr('disabled',true);
	return false;
	}
	next = catergories[next_i];

	var data = 'exam_id='+exam_id+'&category_id='+next;

	next_i++;
	j = 0;t=0;

		$('.on-pause').hide('fast');

    show_questionaire(data);
});


var allow_result = false;
$('#btn_stop').on('click',function() {
	var timer = $('.minutes').text()+':'+$('.seconds').text();
	//console.log(timer);
	//return false;
	saveAnswer(my_asnwer);
	if(allow_result == false){
	return false;
	}


	var data = 'timer='+timer+'&catergories='+JSON.stringify(cat);

	////console.log(data);
	//return false;
	$('.reset').click();


        	$('.exam-info').show('fast');
        	$('.exam-starter').hide('slow');
        	in_answer = [];
        	j = 0;
        	t=0;
        	started = false;
        	$(this).attr('disabled',true);


	$.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("exam/show_result"); ?>',
      dataType: 'html',
      success: function(resp){

      	////;
      	if(resp.stats == true){
      		$('.exam-start').hide('fast');
      		$('.exam-result').removeClass('hidden');
      	$('.exam-rating').html(resp.result+'/'+resp.total_exam);
      }else{
      	console.log(resp.msg)
      }
      }
	});

	});

$('#btn_pause').on('click',function() {

	 var btn = $(this).text();
	 btn = btn.trim();

	 //////console.log(btn);

	 //return false;
	 if(btn_pause_2 == false){

		$('.stop').click();
		$('.on-pause').show('slow');
	 	pause_timer();
	 	btn_pause_2 = true;

	 $('#btn_pause-2').html('<i class="fa fa-undo"></i>')
	 $(this).html('<i class="fa fa-undo"></i> Return')
	 }else{

		$('.on-pause').hide('fast');
		$('.start').click();
	 	pause_timer();
	 	btn_pause_2 = false;
	 $('#btn_pause-2').html('<i class="fa fa-pause"></i>')
	 $(this).html('<i class="fa fa-pause"></i> Pause')
	 }
	
});


var catergories = <?php echo json_encode($catergories); ?>;
var next_i = 0;
var next = catergories[next_i];
var exam_id = <?=$exam_id?>;



$('#btn_start').on('click',function() {
////console.log(catergories);
//return false;
if(catergories.length <= next_i){
	return false;
}
next_i++;


	var data = 'exam_id='+exam_id+'&category_id='+next;
    show_questionaire(data);

    return false;
});

var cat = [];
function show_questionaire(data){

	cat.push(next);
$.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("exam/startexam"); ?>',
      dataType: 'json',

      success: function(resp){

        	//////;

        if(resp.stats == true){
        	$('.exam-info').hide('fast');
        	$('.exam-starter').show('slow');

        	//////console.log(resp.exam);
        	var i=1;
        	var question = '<ul class="list">';
        	$.each(resp.exam, function(k, v) {

    			//////console.log(v.q_id);

    			question = question + '<div class="panel panel-info"><div class="panel-heading"> <span class="counter-i">'+i+')</span> '+v.question_title+'</div><div class="panel-body">'+'<li class="list__item"><input type="radio" name="answer_'+v.question_id+'" id="choice_1_'+v.question_id+'" class="radio radio-inline radio-btn" onclick="myAnswer('+v.question_id+',\''+v.choice_1+'\')"><label for="choice_1_'+v.question_id+'" class="label" > A) '+v.choice_1+'</label></li>'+'<li class="list__item"><input type="radio" name="answer_'+v.question_id+'" id="choice_2_'+v.question_id+'" class="radio radio-inline radio-btn"  onclick="myAnswer('+v.question_id+',\''+v.choice_2+'\')"><label for="choice_2_'+v.question_id+'"  class="label" > B) '+v.choice_2+'</label></li>'+'<li class="list__item"><input type="radio" name="answer_'+v.question_id+'" id="choice_3_'+v.question_id+'" class="radio radio-inline radio-btn"  onclick="myAnswer('+v.question_id+',\''+v.choice_3+'\')"><label for="choice_3_'+v.question_id+'" class="label" > C) '+v.choice_3+'</label></li>'+'<li class="list__item"><input type="radio" name="answer_'+v.question_id+'" id="choice_4_'+v.question_id+'" class="radio radio-inline radio-btn"  onclick="myAnswer('+v.question_id+',\''+v.choice_4+'\')"><label for="choice_4_'+v.question_id+'"  class="label" > D) '+v.choice_4+'</label></li>'+'<li class="list__item"><input type="radio" name="answer_'+v.question_id+'" id="choice_5_'+v.question_id+'" class="radio radio-inline radio-btn"  onclick="myAnswer('+v.question_id+',\''+v.choice_5+'\')"><label for="choice_5_'+v.question_id+'"  class="label" > E) '+v.choice_5+'</label></li>'+'</div></div>';
    			i++;j++;my_asnwer = '';my_asnwer = [];
			});
			$('.answer-total').html('0');
			$('.answer-question').html(j);
			$('.list-exam').html(question+'</ul>');

				 


        }else{

                  $('.navbar-coloftech').notify('Warning! '+resp.msg, { position:"bottom right", className:"warning" }); 
                  setTimeout(function(){

        			window.location = '<?=base_url($_SERVER['REQUEST_URI']) ?>';

                  },1500);
        }
      }

    });
}


</script>



<script type="text/javascript">

var started = false;
var my_asnwer = [];

	function myAnswer(question,answer){

	if(started == false){
		started = true;

        	$('.start').click();
			start_timer();

	}

var kv ='';
kv = {id:question , answer: answer};
objIndex = my_asnwer.findIndex((obj => obj.id == question));
if(objIndex != -1){
my_asnwer[objIndex].answer = answer
//console.log(my_asnwer);
}else{
my_asnwer.push(kv);
t++;
$('.answer-total').html(t);
//console.log(my_asnwer);
}
}
function saveAnswer(answers) {
	// body...
	console.clear();
	if(answers.length <=0){

      	$('.navbar-coloftech').notify('No action done.',{position: "bottom right",className: "error"})
		return false;
	}

	if(t != j){

      	$('.navbar-coloftech').notify('You missed some questions. You only answer '+t+' out of '+j+' questions.',{position: "bottom right",className: "error"})
		return false;
	}
	allow_result = true;

	var data = 'isdone='+true+'&answers='+JSON.stringify(answers);
		$.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("examination/saveAnswer"); ?>',
      dataType: 'json',
      success: function(resp){
      	//////
      	//console.log(resp)
      	return false;
      	if(resp.stats == true){

      	$('.navbar-coloftech').notify(resp.msg,{position: "bottom right",className: "success"})
      	}else{

      	$('.navbar-coloftech').notify(resp.msg,{position: "bottom right",className: "error"})
      	}

      }
	});
}
</script>