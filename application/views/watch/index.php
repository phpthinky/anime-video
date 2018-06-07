<div class="col-md-12 post-index">
	
<div class="col-md-9">

		
<?php if(isset($video) && isset($video->title)): ?>

<div class="panel">
	<div class="panel-body"><label>Note: </label>If download button appear in a video screen. Please click X. For video with no advertisement find FB server below if available.  
	<?php if ($video->source_id == 8): ?>
		Vimeo video default password: <label>123456</label> or look in synopsis
	<?php endif ?>
	<div class="video-content" style="display:block;">
		
		
<?php if ($video->source_id != 7): ?>
		 <?php echo $video->embed; ?>
	<?php else: ?>
		<div class="panel cideo" style="">
			<div class="panel-body">
	<video  controls autoplay style="width:100%;margin-bottom:-5px;"><source src="" type="video/mp4">
	Your browser does not support the video tag.</video>
		</div>
		</div>

		<script type="text/javascript">
		getLink();
		function getLink(){
			$.ajax({
				data: 'video='+'<?=$video->slug?>',
				url: '<?=site_url("watch/v_url")?>',
				type: 'post',
				dataType: 'html',
				success: function(resp){
					console.log(resp);

					var video = document.createElement('video');

						video.src = resp;
						video.autoplay = true;
						video.controls = true;
						video.style = 'width:100%';
						video.className = 'video';
						$('.cideo .panel-body').html(video);
					//$('video').attr('src',resp);


		$('.video').click(function(){this.paused?this.play():this.pause();});

				}
			});
		}
	</script>
<?php endif ?>


	</div>
	<div class="video-title" style="display:block;"><h4><?php echo strtoupper($video->title) ;?> 
	<?php if ($this->permission->is_loggedin() == true): ?><a href="<?=site_url("video/info/$video->video_id")?>" class="btn"><i class="fa fa-edit">
                          </i></a><?php endif ?></h4><a class="btn btn-danger btn-sm pull-right" id="btnreport" href="#" data-toggle="modal" data-target="#modalupload"><i class="fa fa-exclamation-circle"></i> Report video error</a></div>

	</div>

</div>


<div class="panel">
	<div class="panel-heading"><h4>VIDEO SERVER</h4></div>
	<div class="panel-body">

	<div class="video-content" style="display:block;">
		<?php if (isset($mirrors)): ?>
			<?php //var_dump($mirrors) ?>
			<?php if (is_array($mirrors)): ?>

				<h5><a href="<?=site_url('watch/v/'.$video->slug) ?>">1) DEFAULT (<?php echo $this->auto_m->mirror($video->source_id); ?>)</a> </h5>
				<?php $i=2;$j=1; foreach ($mirrors as $m): ?>
					<?php 
					$mirror = $m->source_id;
					$m_name = $this->auto_m->mirror($mirror);
					 ?>
					
				<h5><a href="?mirror=<?=$m->source_id?>"><?=$i?>) MIRROR <?=$j?> (<?=$m_name?>)</a> </h5>
				<?php $i++;$j++; endforeach ?>
			<?php endif ?>
		<?php endif ?>
		
	</div>

	</div>

</div>
<?php else: ?>
	
<?php endif ?>





<script type="text/javascript">
	$(document).ready(function() {
    $('iframe').removeAttr('width');
    $('iframe').removeAttr('height');
});
</script>








</div>
<div class="col-md-3 side-bar">
	<div class="panel panel-search">
	<div class="panel-body" style="padding: 0;">
		<form action="<?=site_url('home/search');?>"><input class="form-control" placeholder="Search" id="search" name="q" /><button type="submit" class="btn btn-info pull-right" style="margin-left:-48px;position:absolute;">GO</button></form>
		</div>
	</div>
	<?php if (isset($video)  && isset($video->title)): ?>
		
	<div class="panel">
		<div class="panel-heading"><h4>SYNOPSIS</h4></div>
		<div class="panel-body"  style="max-height:300px;overflow:auto;">
			<p>
			<label><?php echo strtoupper($video->title) ?></label> <div class="fb-share-button" data-href="<?=$link?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode(site_url($link))?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div> -
				<?php echo !empty($video->sypnosis) ? $video->sypnosis : 'No information.'; ?>
			</p>
			
		</div>


	</div>

	<?php if (isset($playlist)): ?>
		<div class="panel" style="padding-bottom:10px;">
		<div class="panel-heading"><h4>PLAY LIST</h4></div>
		<div class="panel-body" style="max-height:300px;overflow:auto;">
			<ul class="recent-post">
				<?php echo $playlist ?>
			</ul>
		</div>


	</div>	
	<?php endif ?>
	<div class="panel">
		<div class="panel-heading"><h4>RATING</h4></div>
		<div class="panel-body">
			<ul class="recent-post">
				<?php //echo $this->auto_m->recent_post(5); ?>
			</ul>
		</div>


	</div>



	<?php endif ?>
	<div class="panel hidden">
		<div class="panel-heading"><h4>SHARE US NOW </h4>
			
		</div>
		<div class="panel-body">
		
      <p>
          <div class="fb-page" data-href="https://www.facebook.com/LewFoLui" data-tabs="about" data-width="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/LewFoLui/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/LewFoLui/">Watch Anime by Coloftech</a></blockquote></div>
      </p>
		</div>
	</div>
	<div class="panel">
		<div class="panel-heading"><h4>MESSAGE </h4>
			
		</div>
		<div class="panel-body">
		<p>
        
    	Want to have your own video portal. Message me now.<br/>Currently supported website youtube, dailymotion, mp4upload,openload and facebook video

      	</p>
      <p>
    	Contact: roy.rita@coloftech.com</p>
      
		</div>
	</div>
</div>
</div>


<div class="modal fade" role="dialog" id="modalupload">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<div class="modal-title"><h4>Report video</h4></div>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="canvas" style="display:block;">
						<canvas id="reportcanvas" style="width:100%;max-width:300px;height:100px;border:1px solid #000000;"></canvas>
					</div>
					<div class="textbox" style="display:block;">
						<input type="text" class="form-control" style="width:100%;max-width:300px;" id="txtreport" name="txtreport" placeholder="Type the text above.">
						<br />
						<button class="btn btn-info " id="btnsend" type="button">Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var reported = false;
	var reportedtxt = false;

	var video_id = 0;
	var video_title = false;
	var source_id = 0;

			<?php if(isset($video->video_id)): ?>

			video_id = <?=$video->video_id?>;
			video_title = '<?=$video->title?>';
			source_id = <?=$video->source_id?>;
			
			<?php endif ?>

	$('#btnreport').on('click',function(){
		console.log(reported);
		if(reported == false){
			//reported == true;


		var txt = randomtext();
		reportedtxt = txt;
		console.log(txt);
		var c = document.getElementById("reportcanvas");
		var ctx = c.getContext("2d");

		ctx.clearRect(0, 0, c.width, c.height);

		ctx.font = "55px Georgia";
		ctx.fillText(txt, 15, 75);


		}else{

				$(this).notify('You already reported this video!',{position:('top right'),className:'error'})
				return false;
		}


	});

	$('#btnsend').on('click',function(){
		if(reported == false && video_id > 0){
			var input = $('#txtreport').val();
			if(input.length <= 0){
				return false;
			}
			if(reportedtxt.toUpperCase() != input.toUpperCase()){
				$('#txtreport').notify('Text not match!',{position:('top right'),className:'error'})
				return false;
			}
			$('#modalupload').modal('hide');
			//reported == true;
			var report = reportHistory();

			$.ajax({
				data:'video_id='+video_id+'&source_id='+source_id,
				url:'../../watch/reported',
				type:'post',
				dataType:'json',
				success: function(res){
				    alert('Thank you. We\'ll try to update the link');
				    console.log('Thank you');
				}
			})

		}


	});


	function randomtext() {
	  var text = "";
	  var possible = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz23456789";

	  for (var i = 0; i < 6; i++)
	    text += possible.charAt(Math.floor(Math.random() * possible.length));

	  return text;
	}


	function reportHistory(){


				if(sessionStorage){

					var videos = sessionStorage.getItem("video_"+video_id);

					if(videos != null){

					
						console.log(videos);


						$('#btnreport').addClass("hidden");



					}else{

						$('#btnreport').addClass("hidden");

						sessionStorage.setItem("video_"+video_id, video_title);


					}


				}else{

					alert('Report failed. Maybe your browser is not supported.');

				}
	}

window.onload = function() {
  //console.log('window - onload'); // 4th


  if(video_id > 0){

				if(sessionStorage){

					var videos = sessionStorage.getItem("video_"+video_id);

					if(videos != null){

						reported == true;
						console.log(videos);


						$('#btnreport').addClass("hidden");

						return true;


					}

				}
				reported == true;
  }else{
  	reported = false;
  }

};
</script>

<?php 
$time = date('H',time());
$showadds= '
<script type="text/javascript" src="//go.oclasrv.com/apu.php?zoneid=1734346"></script>';
switch ($time) {
	case '6':
		# code...
	echo $showadds;
		break;
	
	case '9':
		# code...
	echo $showadds;
		break;
	case '12':
		# code...
	echo $showadds;
		break;
	case '1':
		# code...
	echo $showadds;
		break;
	case '4':
		# code...
	echo $showadds;
		break;
	default:
		# code...
	echo "";
		break;
}
 ?>