<div class="wrapper site-wrapper">
	<br />
	<div class="container site-container">
<div class="col-md-9 search-index">

 
				<div class="col-md-12 post-search">
					<form class="form form-horizontal" method="GET" action="" id="frmsearch" name="frmsearch">
						<div class="form-group">

							<div class="col-md-11"><input type="text" name="q" id="q" class="form-control"></div><div class="col-md-1"><button class="btn btn-default"><i class="fa fa-search"></i></button></div>
						</div>
					</form>
				</div>

		<?php if (isset($posts)): ?>

			<?php if (is_array($posts)): ?>
				<?php foreach ($posts as $key): ?>
					<div class="col-md-12 post">
						<div class="col-md-6 post-featured-img">

							<div class="year"><?=$key->post_year;?></div>
							<div class="month"><?=$key->post_month;?></div>

							<div class="day"><?=$key->post_day;?></div>

							<div class="blured">
								<a href="<?=site_url("site/read/$key->site_path/$key->slug");?>">

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
							<div class="post-title"><a href="<?=site_url("c=site&f=read&p=$key->site_path&i=$key->slug");?>"><h4><?=$this->auto_m->limit_title($key->post_title);?></h4></a></div>
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
								<div class="post-details"><a href="<?=site_url("/site/read/$key->site_path/$key->slug");?>" class="btn btn-default">Details <i class="fa fa-angle-right"></i></a href="#"></div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			<?php endif ?>

		<?php endif ?>

<div class="col-md-12"><?=isset($pagination) ? $pagination :"";?></div>
</div>
<div class="col-md-3 side-bar">
	<div class="panel panel-search hidden">
	<div class="panel-body">
		<input class="form-control" placeholder="Search" id="search" name="q" /><i class="fa fa-search pul"></i></div>
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

