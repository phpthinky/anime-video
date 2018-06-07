<div class="wrapper site-wrapper">
	<div class="container site-container" style="padding-bottom: 100px;">
		<h4><?php echo isset($page) ? $page : ''; ?></h4>

		<div class="col-md-8 page-content">
			<?=isset($about) ? $about : ''; ?>

		</div>
		<div class="col-md-4 side-bar">
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
						<li><a href="<?=site_url(''.$key->site_path.'/p/'.$key->page_title);?>"><?=$key->page_title?></a></li>
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