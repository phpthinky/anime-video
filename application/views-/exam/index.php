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
	<div class="col-md-7">
		<div class="panel">
			
			<div class="panel-body">
				
<table class="table table-hover">
	<thead>
		
	<tr>
		<th>Date added</th>
		<th>Exam title</th>
		<th>Category</th>
		<th>Total exam</th>
		<th></th>
	</tr>
	</thead>	<tbody>
<?php if (isset($lists) && is_array($lists)): ?>
	<?php $i=0; foreach ($lists as $key ): ?>
		<?php 

		//print_r($lists);exit();
		$i++;
		$added_q = 0;
		

		 	$choices = 'No';
		if ($key->shuffle_choices == 1) {
		 	$choices = 'Yes';
		 }

		 	$questions = 'No';
		if ($key->suffle_questions == 1) {
		 	$questions = 'Yes';
		 }
		 $Status = 'Draft';
		if ($key->status == 1) {
		 	$Status = 'Publish';
		 }

		  ?>
	<tr id="tr_<?=$key->exam_id ?>">
		<td width="100px"><?=date('Y-m-d',strtotime($key->date_posted)) ?></td>
		<td><?=$key->quizes_title ?></td>
		<td><?php if(!empty($key->category_names)) echo implode(', ', $key->category_names);?></td>
		<td  width="100px"><?=$key->exam_total?></td>
		<td width="50px"><a href="<?=site_url("exam/take_exam/$key->exam_id"); ?>"><i class="fa fa-briefcase btn" style="color:green;" title="Take this exam"></i></a></td>
	</tr>
	<?php endforeach ?>
<?php endif ?>

	</tbody>
</table>
			</div>
		</div>
	</div>
	<div class="col-md-3 side-bar">
	<div class="panel panel-search">
	<div class="panel-body" style="padding: 0;">
					<div class="form-responsive">
					<form class="form" method="GET" action="exam/search">
						<div class="form-group">
							
		<input class="form-control" placeholder="Search" id="search" name="q" /><i class="fa fa-search pul"></i></div>
						</div>
					</form>
				</div>
	</div>
	</div>

</div>
</div>