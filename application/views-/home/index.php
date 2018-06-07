<div class="col-md-12 post-index">
	
<div class="col-md-9">

		<?php if (isset($posts)): ?>
			<?php // print_r($posts) ?>
			<?php if (is_array($posts)): ?>
				<?php foreach ($posts as $key): ?>

					<div class="post">
						<div class="col-md-6 post-featured-img">
							<div class="year"><?=date('Y',strtotime($key->date_posted));?></div>
							<div class="month"><?=date('M',strtotime($key->date_posted));?></div>
							<div class="day"><?=date('d',strtotime($key->date_posted));?></div>
							<div class="blured">
								<a href="<?=site_url("exam/info/$key->slug");?>">

									
									<div class="tiles">
										<div class="tile" data-scale="1.1" data-image="<?=base_url('public/images/default-img.png')?>"></div>
									</div>
							</div>
							
						</div>
						<div class="col-md-6 post-content">
							<div class="post-title"><a href="<?=site_url("exam/info/$key->slug");?>" title='<?=$key->quizes_title?>'><h4><?=$this->auto_m->limit_title($key->quizes_title);?></h4></a></div>
							<div class="post-content-desc"><?=$key->e_description ?></div>
							<div class="post-options">
								<div class="posted-by"></div>
								<div class="post-category" style="font-size:11px;"><b stlye="color:black">Exam categories: </b><br /><?php 
								//if(isset($key->category_names)){
								//	echo implode(',',$key->category_names);
								//}
								echo "<ul>";
								if(isset($key->category) && is_array($key->category)){
									foreach ($key->category as $cat) {
										# code...
										echo "<li><a href='#trylater'>$cat->category_name</a></li>";
									}
								}
								echo "<ul>";
								/*$j = 1;
								foreach ($category as $cat) {
									# code...
								echo "<p>$j) $cat->cat_name</p>";
								$j++;
								}*/

								?></div>
								<div class="post-details"><a href="<?=site_url("exam/info/$key->slug");?>" class="btn btn-default">Details <i class="fa fa-angle-right"></i></a href="#"></div>
							</div>
						</div>
					</div>
						
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
		<div class="panel-heading"><h4>REVIEWER RATING</h4></div>
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
        
    	Welcome to Online Review Center - a free online review for government licensure examination and civil service exam.

      	</p>
      <p>
    	Contact: roy.rita@coloftech.com</p>
      <!-- p>
          <div class="fb-page" data-href="https://www.facebook.com/coloftech/" data-tabs="about" data-width="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/coloftech/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/coloftech/">Coloftech - State of the Art &amp; Technology</a></blockquote></div>
      </p -->
		</div>
	</div>

</div>
</div>
