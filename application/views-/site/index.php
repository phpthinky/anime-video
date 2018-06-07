<div class="wrapper site-wrapper">
	<div class="container site-container">

<div class="col-md-12 post-index">
	
<div class="col-md-9">

		<?php if (isset($posts)): ?>
			<?php if (is_array($posts)): ?>
				<?php foreach ($posts as $key): ?>
					<?php if (!empty($key->site_path)): ?>
					<div class="post">
						<div class="col-md-6 post-featured-img">
							<div class="year"><?=$key->post_year;?></div>
							<div class="month"><?=$key->post_month;?></div>
							<div class="day"><?=$key->post_day;?></div>
							<div class="blured">
								<a href="<?=site_url("$key->site_path/$key->slug");?>">

									
									<?php if ($img_link = $this->post_m->get_featuredImg($key->post_id)): ?>
										
									<div class="tiles">
										<div class="tile" data-scale="1.1" data-image="<?=base_url($img_link)?>"></div>
									</div>
											<?php else: ?>
									<div class="tiles">
										<div class="tile" data-scale="1.1" data-image="<?=base_url('public/images/post-img.png')?>"></div>
									</div>
										<?php endif ?>
							</div>
							
						</div>
						<div class="col-md-6 post-content">
							<div class="post-title"><a href="<?=site_url("$key->site_path/$key->slug");?>" title='<?=$key->post_title?>'><h4><?=$this->auto_m->limit_title($key->post_title);?></h4></a></div>
							<div class="post-content-desc"><?=$this->auto_m->limit_300($key->post_content)?></div>
							<div class="post-options">
								<div class="posted-by"><?php echo ucfirst($key->site_path); /*$this->post_m->posted_by($key->user_id); */
								?></div>
								<div class="post-category"><?php 

								if($category = $this->post_m->get_categories($key->post_id)){
									foreach ($category as $cat) {
										
										echo "<span class='category-item'>$cat->cat_name</span> ";
									}
								}

								?></div>
								<div class="post-details"><a href="<?=site_url("$key->site_path/$key->slug");?>" class="btn btn-default">Details <i class="fa fa-angle-right"></i></a href="#"></div>
							</div>
						</div>
					</div>
						
					<?php endif ?>
				<?php endforeach ?>
			<?php endif ?>
		<?php endif ?>
<div class="col-md-12"><?=isset($pagination) ? $pagination : '';?></div>
</div>
<div class="col-md-3 side-bar">
	<div class="panel panel-search">
	<div class="panel-body" style="padding: 0;">
		<input class="form-control" placeholder="Search" id="search" name="q" /><i class="fa fa-search pul"></i></div>
	</div>
	<div class="panel">
		<div class="panel-heading"><h4>RECENT POST</h4></div>
		<div class="panel-body">
			<ul class="recent-post">
				<?php //echo $this->auto_m->recent_post(5); ?>
			</ul>
		</div>


	</div>

	<div class="panel">
		<div class="panel-heading"><h4>SHARE US NOW </h4>
			
		</div>
		<div class="panel-body">
		     <p>
        
    Hello! I am Roy, a PHP Developer and COLFTECH is my programming blog. I'm fond of developing modern web applications.<br />

    Contact me, I accept paid work.<br /><br />

    roy.rita@coloftech.com
      </p>
      <!-- p>
          <div class="fb-page" data-href="https://www.facebook.com/coloftech/" data-tabs="about" data-width="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/coloftech/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/coloftech/">Coloftech - State of the Art &amp; Technology</a></blockquote></div>
      </p -->
		</div>
	</div>

</div>
</div>
	</div>
</div>

