<div class="col-md-12 post-index">
	<div class="col-md-2">
		<div class="panel">
			<div class="panel-body">
				<a class="btn btn-sm" style="float: left;position: absolute;z-index: 1;color: yellow;background: rgba(0,0,0,0.2);"><i class="fa fa-camera"></i></a>
				<div class="profile-pic" style="border:solid 1px #e5e5e5;display: block;height: 150px;width: 150px;">
					<?php if ($profile_img = $this->user_m->settings('profile-img')): ?>

					<img src="<?=$profile_img  ?>" style="width: 100%;max-height: 150px;max-width: 150px;position: absolute;">
						<?php else: ?>
					<img src="../public/images/logo-only.png" style="width: 100%;max-height: 150px;max-width: 150px;position: absolute;">
					<?php endif ?>
					
					
				</div>
				<br />
				<div class="profile-username"><?=$profile[0]->first_name?> <?=$profile[0]->last_name?></div>
			</div>
			<div class="panel-body">
				<ul style="list-style: none;padding: 0;margin: 0;">
					<li><a href="" class="btn">Take new exam</a></li>
					<li><a href="" class="btn">Review my exam</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-10">
		<div class="panel">
			
			<div class="panel-body">
				
<table class="table table-hover">
	<thead>
		
	<tr>
		<th>Exam title</th>
		<th>No of times taken</th>
		<th>Best score</th>
		<th></th>
	</tr>
	</thead>	<tbody>
		<?php  //var_dump($ratings); ?>
<?php if (isset($ratings) && is_array($ratings)): ?>
	<?php $i=0; foreach ($ratings as $key ): ?>
		<?php 
		if (empty($key->exam_id)) {
			# code...
			return false;
		}

		  ?>
	<tr id="tr_<?=$key->exam_id ?>">
		<td><?=$key->exam_title ?></td>
		<td><?=$key->retake_total;?></td>
		<td  width="100px"><?=$key->results?>/<?php echo $this->Userexam_m->exam_total($key->exam_id); ?></td>
		<td width="80px"><a href="<?=site_url("exam/rating/$key->exam_id"); ?>" class="" style="display: inline-block; margin-left: 10px" title="More info"><i class="fa fa fa-list-ol"></i></a> <a href="<?=site_url("exam/take_exam/$key->exam_id"); ?>" class="" style="display: inline-block; margin-left: 10px"><i class="fa fa-rotate-left" style="color:green;" title="Re-Take this exam"></i></a></td>
	</tr>
	<?php endforeach ?>
<?php endif ?>

	</tbody>
</table>
			</div>
		</div>
	</div>
</div>
</div>