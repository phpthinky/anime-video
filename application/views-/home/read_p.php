<div class="col-sm-12 col-md-12 col-lg-12 blank <?php echo isset($class) ? $class : '';?>">
	
	<div class="col-md-9"><h3><?php echo isset($subtitle) ? $subtitle : '';?></h3>
	<div class="breaker-full"></div>
	<?php if (isset($featured_image)): ?>
		<div class="featured_img"><img src="<?php echo urldecode($featured_image); ?>" alt="Featured Image"></div>
	<?php endif ?>
	<br />
	<?php echo urldecode($content); ?>
	</div>
	<div class="col-md-3">
		
		Visit: <?php $page = $this->pagecounter->get_pageUrl(); echo $this->pagecounter->visit_total($page);?>
	</div>

</div>

