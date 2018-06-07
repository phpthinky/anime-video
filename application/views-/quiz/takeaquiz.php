<style type="text/css">
	.choices {
		margin:0;
		padding: 0;
		padding-left: 20px;
		padding-top: 5px;

	}
	.form-group {
		margin:0;
		padding: 0;
	}
	.form-group > label {
		cursor: pointer;
		display: inline-block;
		font-size: 10px;
		font-weight: normal;
	}
	.form-group  > input{
		display: inline-block;
	}
</style>

	<?php if (isset($category)): ?>
		<form class="form  form-horizontal" method="get" action="./takeaquiz">
			<div class="form-group">
				
		<label for="category">Select Exam Category </label><?php echo $category; ?>

			</div>
			<div class="form-group" >
				<label for="btncategory">
					<button class="btn btn-info btn-sm" type="submit" id="btncategory">Set</button>
				</label>
			</div>
		</form>
	<?php endif ?>

<?php if (isset($lists) && is_array($lists)): ?>

	<form class="form form-horizontal" action="./result" method="post">
	<?php $i=1; foreach ($lists as $key ): ?>
	<div class="panel panel-info">
		<div class="panel-heading"><?=$key->post_question ?></div>
		<div class="pane-body choices">
			<?php 
			$choices = '';
			$choices = array($key->post_answer,$key->post_choice1, $key->post_choice2, $key->post_choice3, $key->post_choice4);
			shuffle($choices);
			?>
			<div class="form-group">

			<input type="radio" name="question_<?=$i ?>"  id="question_<?=$i ?>_A" class="" value="<?=$choices[0] ?>"> <label for="question_<?=$i ?>_A"> A) <?=$choices[0] ?></label></div>
			<div class="form-group">
				<input type="radio" name="question_<?=$i ?>" id="question_<?=$i ?>_B" class="" value="<?=$choices[1] ?>"> <label for="question_<?=$i ?>_B"> B) <?=$choices[1] ?></label></div>
			<div class="form-group">
				<input type="radio" name="question_<?=$i ?>" id="question_<?=$i ?>_C" class="" value="<?=$choices[2] ?>"> <label for="question_<?=$i ?>_C"> C) <?=$choices[2] ?></label></div>
			<div class="form-group">
				<input type="radio" name="question_<?=$i ?>" id="question_<?=$i ?>_D" class="" value="<?=$choices[3] ?>"> <label for="question_<?=$i ?>_D"> D) <?=$choices[3] ?></label></div>
			<div class="form-group">
				<input type="radio" name="question_<?=$i ?>" id="question_<?=$i ?>_E" class="" value="<?=$choices[4] ?>"> <label for="question_<?=$i ?>_E"> E) <?=$choices[4] ?></label></div>
				
			

				
			</div>
	</div>
	<?php $i++; endforeach ?>
	<div class="form-group">
		<label></label><button class="btn btn-success btn-sm">Submit</button>
	</div>
	</form>
<?php endif ?>