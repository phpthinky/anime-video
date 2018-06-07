<div class="wrapper site-wrapper">
	<br />
	<div class="container site-container">
<div class="col-md-9 site-index">

 

<?php 

$page = $this->input->get('p') ? $this->input->get('p') : 'bilar';
 ?>
		<?php if (isset($posts)): ?>
			<?php if (is_array($posts)): ?>
				<?php foreach ($posts as $key): ?>
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
								</a>

							</div>
							
						</div>
						<div class="col-md-6 post-content">
							<div class="post-title"><a href="<?=site_url("$key->site_path/$key->slug");?>"><h4><?=$this->auto_m->limit_title($key->post_title);?></h4></a></div>
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
				<?php endforeach ?>
			<?php endif ?>

		<?php endif ?>
		<?php if (empty($posts)): ?>
				
			<?php if (isset($list_pages)): ?>
			<?php if (is_array($list_pages)): ?>
				<?php foreach ($list_pages as $key): ?>
						<?php if(!empty($key->page_content)): ?>
							<div class="col-md-12" style="margin:0;padding:0;">
							<div class="panel">
								<div class="panel-heading"><h4><?=$key->page_title?></h4></div>
								<div class="panel-body"><?=$this->auto_m->limit_300($key->page_content);?></div>
							</div>
							</div>

						<?php endif ?>
					
				<?php endforeach ?>
			<?php endif ?>
			<?php endif ?>
		<?php endif  ?>

<div class="col-md-12"><?=isset($pagination) ? $pagination :"";?></div>
</div>
<div class="col-md-3 side-bar">
	<div class="panel panel-search">
	<div class="panel-body">
		<form class="form" action="<?=site_url($site_path.'/search/-q-');?> " method="GET">
		<input class="form-control" placeholder="Search" id="search" name="q" /><i class="fa fa-search pul"></i>
		</form>
	</div>
	</div>


	<div class="panel">
		<div class="panel-heading"><h4>ABOUT US</h4></div>
		<div class="panel-body">
			<ul class="recent-post">
				<?php if (isset($sidebar_pages)): ?>
					<?php foreach ($sidebar_pages as $key): ?>
						<li><a href="<?=site_url('c=site&f=view&p='.$key->site_path.'&i='.$key->page_title);?>"><?=$key->page_title?></a></li>
					<?php endforeach ?>
				<?php endif ?>
			</ul>
		</div>
	</div>

	<div class="panel">
		<div class="panel-heading"><h4>RECENT POST</h4></div>
		<div class="panel-body">
			<ul class="recent-post">
				<?php echo $this->auto_m->recent_post(); ?>
			</ul>
		</div>


	</div>

</div>
	</div>
</div>

