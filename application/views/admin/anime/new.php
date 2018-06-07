<div class="panel">         
<div class="panel-heading"><h3>Add video</h3></div>         
<div class="panel-body">
<div class="col-md-12"> 
	<form class="form from-horizontal" id="frmsearch"method="post" action="video/search" >
				<div class="form-group">                     
				<label>Title of video</label>
				<input type="text" id="q" name="q" class="form-control" required/>
				</div>

				<div class="form-group">
					<label></label>
					<input type="submit" id="btnsearch" name="btnsearch" class="btn btn-info btn-sm" style="border-radius:0;margin:0;" value="Go" />
				</div>
				<div class="form-group list-video">
					<ul id="list_here"></ul>
					
				</div>
	</form>
</div>
<div class="col-md-12">
			<form class="form form-horizontal hidden" id="frmaddvideo" action="" method="post" >

				<div class="col-md-8">
				<div class="form-group if-exist">
					<label>Title</label>
					<input type="text" id="txttitle" name="txttitle" placeholder="Enter title here..." class="form-control" required>
				</div>

				<div class="form-group if-episode">
					<label>Episode number</label>
					<input type="number" id="episodenumber" name="episodenumber" placeholder="Enter episode number here..." class="form-control" value="1">
				</div>

				<div class="form-group if-episode">
					<label>Sypnosis/Description</label>
					
					<textarea class="form-control" id="sypnosis" name="sypnosis" placeholder="Enter sypnosis here..." rows="5"></textarea>
				</div>

				<div class="form-group">
					<label>Source</label>
					<select class="form-control" id="videosource" name="videosource">
						<option value="0">-SELECT HERE-</option>
						<option value="1">MP4UPLOAD</option>
						<option value="2">YOUTUBE</option>
						<option value="3">FACEBOOK</option>
						<option value="4">DAILYMOTION</option>
						<option value="5">OPENLOAD</option>
					</select>
				</div>
				<div class="form-group hidden" id="video-url">
				<ul class="nav nav-tabs" id="ul_new">
				  <li class="li_link active"><a data-toggle="tab" href="#tab_link" class="tab_link">Video url</a></li>
				  <li class="li_embed"><a data-toggle="tab" href="#tab_embed" class="tab_embed">Embed</a></li>

				</ul>

					<div class="tab-content">

			  		<div id="tab_link" class="tab-pane fade in active">
			   		 <h3>Video url</h3>
			    	
					<input type="text" id="txtlink" name="txtlink" placeholder="Enter link here..." class="form-control">
					<br />
					<span style="font-size:12px;">Paste the video url above this line.</span>
					</div>
			  		<div id="tab_embed" class="tab-pane fade">
			   		 <h3>Embeded</h3>
			    	
					<textarea class="form-control" rows="8" id="txtembed" name="txtembed"></textarea>
					<br />
					<span style="font-size:12px;">Please add this line inside iframe attribute-><i> class="watch" </i></span>
					<br />
					<span>ex: <?php echo htmlentities('<iframe class="watch" src="https://youtube.com/embed/XMLFepyz1lE"></iframe>'); ?></span>
					</div>
					</div>
				</div>

				<div class="form-group">
					<label>Keywords <span style="font-size:12px;font-weight:normal;">(Press <i>Tab key</i>)</span></label><br />
					<input type="text" id="txttags" name="txttags" placeholder="Enter title here..." class="form-control" data-role="tagsinput">
					<br />

				</div>
				</div>

				<div class="col-md-1">
				</div>
				<div class="col-md-3">
					
				<div class="form-group if-exist">
					<label>Video type</label>
					<select class="form-control" id="videotype" name="videotype">
						<option value="1">Anime</option>
						<option value="2">Movie</option>
					</select>
				</div>
				<div class="form-group">
					<label>Thumbnail <span class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalupload"><i class="fa fa-plus"></i></span></label>
					<input class="form-control" type="text" name="thumbnail" id="thumbnail" />
					<br / >
					<div class="preview-image hidden">
						<img src="http://anime-vid.eo/public/images/logo-only.png" id="imgpreview" style="200px;height:200px;">
					</div>
				</div>
				</div>
				<div class="col-md-12">
					
				<div class="form-group">
					<label></label>
					<input type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-info btn-sm" />
				</div>
				</div>
			</form>

</div>
</div>
</div>
<div id="modalupload" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload thumbnail</h4>
      </div>
      <div class="modal-body">
        <p>
        <form class="form" id="frmupload"  method="post" action="./upload" enctype="multipart/form-data">
        	
        	<label>Select image</label>
        	<input class="btn alert-info" type="file" name="uploadthumb" id="uploadthumb"  accept="image/*" />
        	<br />
        	<input	type="submit" id="btnupload" name="btnupload" value="Upload" class="btn btn-info" />

			<div class="progress">
				<div class="progress-bar" role="progressbar"></div>
			</div>

			<div class="with-error"></div>
        </form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	

	$('#q').on('keyup',function(){

		var search = $(this).val();
		if(search.trim().length == 0){
				$(this).val('');
			}
		if(search.trim().length < 3){
			
			return false;
		}

	});

	$('#frmsearch').on('submit',function(){

		var frmdata = $(this).serialize();
		var q = $('#q').val();
		$('#list_here').html('');
		console.clear();
		$.ajax({
			data:frmdata,
			url:'./video/search',
			dataType: 'json',
			type: 'post',
			success: function(resp){
				console.log(resp);
				if(resp.stats == true){
					var n = 0;
					var v = resp.msg;
					$.each(v, function(i) {

			           		$('#list_here').append('<li><a href="video/info/'+v[i].video_id+'">'+v[i].title+'</a></li>')
			           		
			           
			            n++;
			          });
					$('#list_here').append('<li>Not in the list? <a href="javascript:void(0)" onclick="showform(\''+q+'\')">Click to add as new video</a></li>');
				}else{
					$('#list_here').append('<li>Not in the list? <a href="javascript:void(0)" onclick="showform(\''+q+'\')">Click to add as new video</a></li>');
					
				
				}
			}
		});
		return false;
	});

	function showform (title='',elem='') {

		if(title.length > 0){
			$('#txttitle').val(title);
		}
		$('#frmaddvideo').removeClass('hidden');
		$('#frmsearch').addClass('hidden');

	}

</script>

<script type="text/javascript">
	$('#videosource').on('blur',function(e){

		$('#txtlink').val('');
		$('#txtembed').val('');

		if($(this).val() > 0){
			$('#video-url').removeClass('hidden');
		}else{
			$('#video-url').removeClass('hidden');
			$('#video-url').addClass('hidden');
		}
		return false;
	})
	$('.li_link').on('click',function(){
		$('#txtembed').val('');
	})

	$('.li_embed').on('click',function(){
		$('#txtlink').val('');
	})

	$('#frmupload').on('submit',function(){

		return false;
	})
	$('#txtlink').on('blur',function(){
		//console.log('test link')
		var link = $(this).val();
		if(link.length == 0){
			return false;
		}
						
		var thumb = $('#thumbnail').val();

		if(thumb.length > 0 ){
			return false;
		}
		$.ajax({
			data: $('#frmaddvideo').serialize(),
			url: '<?=site_url("video/ytthumb")?>',
			type: 'post',
			dataType: 'html',
			success: function(resp){
				if(resp.length > 0){

					$('.preview-image').removeClass('hidden');
					var img = $('#imgpreview');
						img.attr('src',resp);
						console.log(resp)
						$('#thumbnail').val(resp);
				}else{
					console.log('NO thumbnail')

						$('.preview-image').removeClass('hidden').addClass('hidden');
				}
			}

		})
	})
</script>


<script type="text/javascript">
	$('#frmaddvideo').on('submit',function(){

		var data = $(this).serialize();
		$.ajax({
			data: data,
			url: './video/savevideo',
			type: 'post',
			dataType: 'json',
			success: function(resp){
				console.log(resp)
				if(resp.stats == true){
					//setTimeout(function(){
						window.location = '<?php echo site_url(); ?>/video/info/'+resp.video_id;
					//})
				}else{
					alert(resp.msg);
				}
			}
		})
		return false;
	});


	$('#uploadthumb').change(function(){
		$('.progress-bar').text('0%');
		$('.progress-bar').width('0%');
	});
	$('#btnupload').on('click', function() {

		console.clear();

		$('.with-error').removeClass('alert alert-danger').html('');
		$('.progress-bar').text('0%');
		$('.progress-bar').width('0%');
		var uploadInput = $('#uploadthumb'); 

		if (uploadInput[0].files[0] != undefined) {
			var formData = new FormData();
			formData.append('upload', uploadInput[0].files[0]);
			formData.append('type','images');

			$.ajax({
				url: './video/upload',
				type: 'POST',
				data: formData,
				//processType: false, WRONG syntax
				processData: false,
				contentType: false,
		      	dataType:'json',
				success: function(data) {
					//$('#uploadthumb').val('');
					console.log(data);
					if(data.stats == true){
						$('.preview-image').removeClass('hidden');

						$('#thumbnail').val(data.msg);
						var img = $('#imgpreview');
						img.attr('src',data.msg);

						setTimeout(function () {
							$('#modalupload').modal('hide');
						},1000);
					}else{
						$('.with-error').addClass('alert alert-danger').html(data.msg)

					}
				},
				xhr: function() {
					var xhr = new XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(e) {
						if (e.lengthComputable) {
							//var uploadPercent = e.loaded / e.total; typo uploadpercent (all lowercase)
							var uploadpercent = e.loaded / e.total; 
							uploadpercent = (uploadpercent * 100); //optional Math.round(uploadpercent * 100)
							$('.progress-bar').text(uploadpercent + '%');
							$('.progress-bar').width(uploadpercent + '%');
							if (uploadpercent == 100) {
								$('.progress-bar').text('Completed');
							}
						}
					}, false);
					
					return xhr;
				}
			})
		}
    });
</script>