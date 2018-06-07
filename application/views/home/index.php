<div class="col-md-12 post-index">
	
<div class="panel">
	<div class="panel-body">
		<form class="form" action="<?=site_url()?>/home/search">
			<input class="form-control" type="text" name="q" id="q" style="padding-right:50px"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-34px;"><i class="fa fa-search"></i></button>
		</form>
	</div>
	<div class="panel-body">
	<h3>Most view</h3>
		<?php if (isset($list_mostviews) && is_array($list_mostviews)): ?>
			<?php foreach ($list_mostviews as $key): ?>
				<div class="col-md-3 col-sm-4">
				<div class="panel panel-info">
					<div class="panel-body"  style="height:250px;overflow:hidden;">
					<a href="<?=site_url("watch/v/$key->slug")?>" title="<?=$key->title ?>"><?php if (!empty($key->thumbnail)): ?>
						<img src="<?php echo $key->thumbnail;?>"   class="img-thumbnail" >
					<?php else: ?>

						<img src="<?php echo base_url('public/images/default-img.jpg');?>"  class="img-thumbnail" >
					<?php endif ?></a>
					<a href="<?=site_url("watch/v/$key->slug")?>" title="<?=$key->title ?>"><?=$key->title.' ('.$key->episode_number.')' ?></a>
				</div>
				</div>
			</div>		
			<?php endforeach ?>
			
		<?php endif ?>
	</div>




</div>

<?php include 'livechart.php'; ?>