	
<?php if(isset($livechart) && is_array($livechart)): ?>
<div class="panel">
<div class="panel-heading"><h3>Anime live chart</h3> 
<div class="fb-share-button" data-href="<?=$link?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode(site_url($link))?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
</div>
	<div class="panel-body">
		<div class="col-md-12">
			
			<?php foreach ($livechart as $key): ?>
				<div class="col-md-3"  style="border:solid 1px #e5e5e5;height:350px;overflow:auto;padding:5px;">
				
					<div  class="col-md-12"  style="background-color:rgba(0,0,0,0.8);width:100%;padding:5px;color:#fff;">
					<?php 
						$currentD = date('Y/m/d');

						$currentT = date('H:i:s');

						$expired_onD = date('Y/m/d',strtotime($key->next_episode));

						$expired_onT = date('H:i:s',strtotime($key->next_episode));
						if($key->status == 0){

						if($currentD == $expired_onD && $currentT > $expired_onT){
							echo '<span>Now showing</span>';
						}else{
							?>
						<span class="countdown"  value='<?=isset($key->next_episode) ? $key->next_episode : "";?>'></span>
							<?php
						}
					}else{
						echo "<span>Season completed</span>";
					}
					 ?>
						<?php $slug = $this->auto_m->getLatest($key->video_id); ?>
					 <a class="btn btn-default btn-sm pull-right" href="<?=site_url('watch/v/'.$slug)?>"><i class="fa fa-sign-out"></i></a>
					</div>
					<div class="col-md-12" style="min-height:250px;max-height:250px;overflow:hidden;">
					
					
					<img src="<?=$key->thumbnail?>" style="width:100%;">
					</div>
					<div class="col-md-12"><?=$key->cover_title?></div>
					<div class="col-md-12">
					</div>
				</div>
				
			<?php endforeach ?>
		</div>
	</div>
</div>


</div>


<script type="text/javascript">
	
	$(function(){
	$('.countdown').each(function(){
		$(this).countdown($(this).attr('value'), function(event) {
    	$(this).text(
      	event.strftime('%D days %H:%M:%S')
      );
		});
	});
});


</script>
<?php 

endif

?>