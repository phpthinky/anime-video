<div class="post-index">
	<div class="col-md-9">
		<div class="panel cideo" style="">
			<div class="panel-body">
	<video controls autoplay style="width:100%;margin-bottom:-5px;"><source src="" type="video/mp4">
	Your browser does not support the video tag.</video>
		</div>
		</div>
	</div>

	<script type="text/javascript">
		
		window.onload = function(){
			$.ajax({
				data: 'video='+'black-clover-18.mp4',
				url: '<?=site_url("home/video_url")?>',
				type: 'post',
				dataType: 'html',
				success: function(resp){
					console.log(resp);

					var video = document.createElement('video');

						video.src = resp;
						video.autoplay = true;
						video.controls = true;
						video.style = 'width:100%';
						$('.cideo .panel-body').html(video);
					//$('video').attr('src',resp);

				}
			});
		}
	</script>
	<div class="col-md-3"></div>
	</div>