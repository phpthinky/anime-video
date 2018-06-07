<?php if(isset($list_video) && is_array($list_video)): ?>

<div class="post-index col-md-12">
	
<div class="panel">
	<div class="panel-body">
		<form class="form hidden" action="<?=site_url()?>/home/search">
			<input class="form-control" type="text" name="q" id="q" style="padding-right:50px"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-34px;"><i class="fa fa-search"></i></button>
		</form>
	</div>
	<div class="panel-body">
	<h3>List videos</h3>
	<?php foreach ($list_video as $key): ?>
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
			<div class="panel panel-info">
				<div class="panel-body"  style="height:250px;overflow:hidden;margin-bottom:5px;margin-top:-10px;">
				<a style="height:45px;display:block;" href="<?=site_url("video/info/$key->video_id")?>" title="<?=$key->title ?>"><?=$key->title.' ('.$key->episode_number.')' ?></a>
					<a href="<?=site_url("video/info/$key->video_id")?>" title="<?=$key->title ?>"><?php if (!empty($key->thumbnail)): ?>
						<img src="<?php echo $key->thumbnail;?>"   class="img-thumbnail" >
					<?php else: ?>

						<img src="<?php echo base_url('public/images/default-img.jpg');?>"  class="img-thumbnail" >
					<?php endif ?></a>
					
				</div>
				

			</div>
		</div>
	<?php endforeach ?>
</div>
</div>
</div>
	

<?php endif ?>