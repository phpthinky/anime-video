<div class="wrapper site-wrapper">
    <br />
</div>
<div class="wrapper site-wrapper">
	<div class="container site-container">
		
		<div class="col-md-9">
			<div class="post-read">
				<?php if (isset($post)): ?>
			   	<?php if (is_array($post)): ?>
			   		<?php foreach ($post as $key): ?>
			   			
			   			<div class="post-featured-img">
			   				<a href="#">

									<?php if ($img_link = $this->post_m->get_featuredImg($key->post_id)): ?>
										
									<img src="<?=base_url($img_link)?>"  onclick="zoomImg(this)"  id="gallery_img" />
									<?php endif ?>
								</a>
			   			</div>
			   			<div class="post-content">
			   				<div class="col-md-12 post-title">

			   					<h3><?php echo $key->post_title; ?> <a href="<?=site_url("post/edit/$key->post_id");?>"><i class="btn fa fa-edit"></i></a></h3>
			   					</div>
			   				<div class="col-md-12 post-content-desc">
			   					<?php echo $key->post_content; ?>


						   			<div class="col-md-12 col-md-12 post-gallery">
						   				<?php if ($gallery = $this->post_m->get_gallImg($key->post_id)): ?>
						   					<?php foreach ($gallery as $gal): ?>
						   						<div class="col-md-6" style="margin:0;padding: 1px;"><img src="<?=base_url($gal->link)?>" onclick="zoomImg(this)"  id="gallery_img"  /></div>
						   					<?php endforeach ?>
						   				<?php endif ?>
						   				<br />
						   				<br />
						   			</div>

			   				</div>

			   				<div class="col-md-12 post-options">
			   					<div class="posted-by"><?=$this->post_m->posted_by($key->user_id);?> | <?=date('F d, Y',strtotime($key->date_posted));?> | <div class="fb-share-button" data-href="<?=site_url("$site_path/$key->slug");?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=site_url("$site_path/$key->slug");?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></div>
			   				</div>
			   			</div>


			   		<?php endforeach ?>
			   	<?php endif ?>
			   <?php endif ?>
			</div>
		   

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

<div id="preview_img" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<style type="text/css">

#gallery_img {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#gallery_img:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    animation-name: zoom;
    animation-duration: 0.6s;
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<script type="text/javascript">
	function zoomImg(img) {

			var modal = document.getElementById('preview_img');

			var modalImg = document.getElementById("img01");
			var captionText = document.getElementById("caption");
			    modal.style.display = "block";
			    modalImg.src = img.src;
			    captionText.innerHTML = img.alt;

			var span = document.getElementsByClassName("close")[0];

			span.onclick = function() { 
			  modal.style.display = "none";
			}
	}




</script>