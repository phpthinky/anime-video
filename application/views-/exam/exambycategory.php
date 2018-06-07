<div class="panel">
	<div class="panel-body">
		<h3><?=($examinfo[0]->quizes_title) ? $examinfo[0]->quizes_title : '';?></h3>
		<?php if ($examinfo[0]->category): ?>
				<ul class="list-unstyled" style="margin-left: 10px;"><h4>CATEGORY</h4>
					
			<?php foreach ($examinfo[0]->category as $key): ?>
				<li><?=$key->category_name ?></li>
			<?php endforeach ?>

				</ul>

		<?php endif ?>
		<button class="btn btn-success" id="btn_start">Start exam</button>
	</div>
</div>
<?php
//print_r($list_exam);

if(isset($list_exam) && is_array($list_exam)){
	$i = 1;$j=1;
		$category = 0;
?>
<?php foreach ($list_exam as $key): ?>

	
			
		<?php //echo $key->question_title; ?>
	<?php
		
		if ( $category != (int)$key->category_id) {
			$category = $key->category_id;
			?>
			<h3>Test <?php echo $j; ?> - <?php echo $key->category_name; ?></h3>
			<p>Directions: <?=($result = $this->quiz_m->getCategoryDirection($key->category_id,$exam_id)) ? $result : '' ;?></p>
			<?php
			 $j++;
		}
	?>

	<div class="panel panel-default">
		<div class="panel-heading panel-question">
			<?php echo "<span style='display: inline-block;font-weight:bold;font-size:15px;'>$i)</span> <span style='display: inline-block;font-weight:bold;font-size:15px;'>$key->question_title </span>"; ?>
				
		</div>
		<div class="panel-body panel-choices">
			<ul class="list">
				<li class="list__item">
					<input type="radio" name="answer_<?=$key->question_id;?>" id="choice_1_<?=$key->question_id;?>" class="radio radio-inline radio-btn"><label for="choice_1_<?=$key->question_id;?>"  class="label"> A. <?=$key->choice_1?></label>
				</li>

				<li class="list__item">
				<input type="radio" name="answer_<?=$key->question_id;?>" id="choice_2_<?=$key->question_id;?>" class="radio radio-inline radio-btn"><label for="choice_2_<?=$key->question_id;?>"  class="label"> B. <?=$key->choice_2?></label>
					
				</li>
				<li class="list__item">
				<input type="radio" name="answer_<?=$key->question_id;?>" id="choice_3_<?=$key->question_id;?>" class="radio radio-inline radio-btn"><label for="choice_3_<?=$key->question_id;?>"  class="label"> C. <?=$key->choice_3?></label>
					
				</li>
				<li class="list__item">
				<input type="radio" name="answer_<?=$key->question_id;?>" id="choice_4_<?=$key->question_id;?>" class="radio radio-inline radio-btn"><label for="choice_4_<?=$key->question_id;?>"  class="label"> D. <?=$key->choice_4?></label>
					
				</li>
				<li class="list__item">
				<input type="radio" name="answer_<?=$key->question_id;?>" id="choice_5_<?=$key->question_id;?>" class="radio radio-inline radio-btn"><label for="choice_5_<?=$key->question_id;?>"  class="label"> E. <?=$key->choice_5?></label>
					
				</li>
			</ul>
		</div>
	</div>



<?php $i++; endforeach ?>

<?php

}

;?>

<script type="text/javascript">

	/*
window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
};*/
</script>