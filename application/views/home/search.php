<div class="col-md-12 post-index">
	
<div class="panel">
	<div class="panel-body">
		<form class="form" action="<?=site_url()?>/home/search">
			<input class="form-control" type="text" name="q" id="q" style="padding-right:50px" value="<?php echo ($this->input->get('q')); ?>"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-34px;"><i class="fa fa-search"></i></button>
		</form>
	</div>

	<div class="panel-body">
		<?php if (isset($search_result) && is_array($search_result)): ?>
			<?php //var_dump($search_result) ?>
			<?php foreach ($search_result as $key): ?>
				
			<div class="col-md-12" style="margin-bottom:10px;">
				<div class="col-md-4">
					<a href="<?=site_url("watch/v/$key->slug")?>">
					<?php if (!empty(trim($key->thumbnail)) > 0): ?>
						<img src="<?=$key->thumbnail?>" style="width:100%;max-height:175px;overflow:hidden;">
					<?php else: ?>
						<img src="<?=base_url('public/images/default-img.jpg')?>"	 style="width:100%;max-height:175px;overflow:hidden;">
					<?php endif ?></a>
				</div>
				<div class="col-md-8">
					<a href="<?=site_url("watch/v/$key->slug")?>"><label><?=$key->title.'('.$key->episode_number.')';?></label></a>
					<p><?php echo $key->sypnosis?></p>
				</div>
			</div>

			<?php endforeach ?>

		<?php else: ?>
			<div class="col-md-12"><label>No video found.</label></div>
		<?php endif ?>
	</div>
</div>
	
</div>