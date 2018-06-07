<div class="col-sm-12 col-md-12 col-lg-12 create">

<div class="col-md-9">
	<div class="panel">
	<div class="heading"><h3>Update post <a href="<?=site_url('ref=home&com=read_post&q='.$slug);?>" class="btn btn-default"><i class="fa fa-eye"></i></a></h3></div>
	<div class="body">
		<form class="form" id="frmupdate" name="frmcreate" method="post" action="">
			<div class="form-group">
				<p class="btn hidden " id="warning_msg"></p>
				<input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id; ?>">
			</div>
			<div class="form-group">
				<label for="title">Title</label><input type="text" class="form-control" name="title"  id="title" placeholder="Enter title here" value="<?php echo isset($p_title) ? $p_title : '';?>" required/>
				<p class="btn alert-danger hidden" id="intitle"></p>
			</div>	
			<div class="form-group">
				<label for="title">Description</label><textarea class="form-control" name="desc" id="desc" rows="7"><?php echo isset($p_content) ? urldecode($p_content) : '';?></textarea>
			</div>	
			<div class="form-group">
				<label for="title">Keyword</label><input type="text" class="form-control" name="keyword"  id="keyword" placeholder="Enter keyword here"  value="<?php echo isset($p_keyword) ? $p_keyword : '';?>" />
			</div>

			<div class="form-group">
				<label for="title"></label><button class="btn btn-info">Update</button>
			</div>		
		</form>
	</div>
</div>
</div>
<div class="col-md-3">
<div class="row">
	<div class="panel">
		<div class="panel-heading">&nbsp;</div>
		<div class="panel-body">
			<h4>Featured image</h4>
			<div class="featured">
				
			<div class="featuredImg" id="featuredImg"><?php echo !empty($p_img) ? '<img src="'.urldecode($p_img).'" title="'.$p_title.'" style="width:100%;height:100%;max-height:150px;"/>' : '';?></div>
			<input type="hidden" id="featuredimg_url" name="featuredimg_url" />

			<?php if ($edit == true): ?>
				
			<button class="btn btn-info" data-toggle="modal"  data-target="#uploadModal"type="button" ><i class="fa fa-camera"></i></button>
			<?php endif ?>

			<?php if ($edit == false): ?>
				<span>Upload image is temporary unavailable, please go to your profile to change this post featured image.</span>
			<?php endif ?>
			
			</div>
			<br />
			<h4>Category</h4>
			<div class="category">
				<select class="form-control" style="width:100%;" id="category" name="category">

				<?php
					echo isset($cat_n) ? '<option value="'.$cat_id.'">'.$cat_n.'</option>' : '';
					foreach ($category as $key) {
						# code...
						echo "<option value='$key->id'>$key->name</option>";
					}
				?>
				</select>
			</div>

			<br />
			<h4>Privacy</h4>
			<div class="category">
				<select class="form-control" style="width:100%;" id="privacy" name="privacy">
					<option value="2">Public</option>
					<option value="1">Private</option>
				</select>
			</div>

			<br />
			<h4>Group</h4>
			<div class="category">
				<select class="form-control" style="width:100%;" id="group" name="group">
					<option value="1">Default</option>
				</select>
			</div>


		</div>
	</div>
</div>

<div class="row">
	<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
<div class="modal-bg hidden">
	<!--span class="loader"></span -->
	<progress id="progressBar" value="0" maximum="100" style="width:300px;"></progress>
	<h3 id="status"></h3>
	<p id="loaded_n_total"></p>
</div>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Featured Image</h4>
      </div>
      <div class="modal-body">
        <p><div class="err_msg hidden"></div>			
		<form action="#" id="frmupload">
			<div class="form-group">

			<input type="file" name="image" class="btn alert-default"  accept="image/gif, image/jpeg, image/png"  onChange="readURL(this);" >
			<button class="btn btn-sm btn-info upload" type="submit" id="upload">Upload</button>
			<button type="button" class="btn btn-sm btn-danger cancel">Cancel</button>
				
			</div>


			<div class="progress progress-striped active" style="width:100%">
				<div class="progress-bar" style="width:0%;"></div>
			</div>

        		<div class="form-group" style="max-width:400px;">
        			<label>Preview</label><br><img src="" id="previewImg" class="hidden" style="width:100%;">
        			<input type="hidden" id="isselected" value="0">	
        		</div>
		</form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="clearform('frmupload');">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</div>

        <script type="text/javascript" src="<?=base_url('assets/js/dist/summernote.min.js');?>"></script>
        <script type="text/javascript">

var 
publish = 0;

	function clearform (frm) {
		// body...
		document.getElementById(frm).reset();
		$('#previewImg').addClass('hidden');
            $('#btnupload').addClass('hidden');
            
            	$('.progress .progress-bar').removeClass('progress-bar-success');            	
            	$('.progress .progress-bar').html('0%');

            	$('.progress .progress-bar').width(0+'%');
		return;
	}
function ispublish (stat) {
	// body...
	if (stat == 1) {
		publish = 1;
	}else{

		publish = 0;
	}
}
	$(document).on('submit','form',function(e){
			e.preventDefault();

			$form = $(this);

              var selected = $('#isselected').val();
			//console.log(input.files[0])
			if (selected > 0) {

			uploadImage($form);
			}

		});
		function readURL(input) {

		 if (!window.FileReader) {
        alert("Oops! This browser isn't supported yet. Please use higher browser to continue.");
        return false;
    	}
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewImg')
                	.removeClass('hidden')
                    .attr('src', e.target.result)
                    .width('70%')
                    .height('70%');
                   $('#isselected').val(1);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


		function uploadImage($form){
			$form.find('.progress-bar').removeClass('progress-bar-success')
										.removeClass('progress-bar-danger');

			var formdata = new FormData($form[0]); //formelement
			if (window.XMLHttpRequest){
			        xmlhttp=new XMLHttpRequest();
			    }else{
			        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			    }

			var request = new XMLHttpRequest();

			//progress event...
			request.upload.addEventListener('progress',function(e){
				var percent = Math.round(e.loaded/e.total * 100);
				$form.find('.progress-bar').width(percent+'%').html(percent+'%');
			});

			request.open('post', '<?=site_url("ref=files&com=upload_image");?>');
			request.send(formdata);
				request.onreadystatechange = function() {
								

								request.addEventListener('load',function(e){


								        if(request.readyState == 4 && request.status == 200) {
								        	
								        	var data = JSON.parse(request.responseText);
								        	console.clear();
								        	console.log(data);
								        	if(data.stat == true ){

												$form.find('.progress-bar').addClass('progress-bar-success').html(data.msg);

												$form.find('input').val('');
												//$form.find('img').setAttribute('src','');

												var elem = document.createElement("img");
												elem.setAttribute("src", '<?=base_url();?>'+data.getlink);
												elem.setAttribute("style", "max-height:200px;max-width:200px;");
												$('#featuredImg').html(elem);
												$('#featuredimg_url').val('<?=base_url();?>'+data.getlink);

												setTimeout(function () {

							        			$('#uploadModal').modal('hide');
							        			clearform('frmupload');

												},1000);



								        	}else{
								        		request.abort();

													$form.find('.progress-bar')
														.addClass('progress-bar-danger')
														.removeClass('progress-bar-success')
														.html(data.msg);
												
								        	}

								        }else{
								        		request.abort();


													$form.find('.progress-bar')
														.addClass('progress-bar-danger')
														.removeClass('progress-bar-success')
														.html(request.responseText.msg);
								        }
								});
				}

			$form.on('click','.cancel',function(){
				request.abort();

				$form.find('.progress-bar')
					.addClass('progress-bar-danger')
					.removeClass('progress-bar-success')
					.html('upload aborted...');
			});

		}
</script>
<script type="text/javascript">




    $(function(){

    	var timer;
    	$('#title').on('keyup',function(){

    		var title = $('#title');

    		var str = title.val();

    		if($.trim(str).length <= 0){
    			title.val('');
    		    return false;
    		}
    		if($.trim(str).length < 2){
    		    return false;
    		}
   
		  clearTimeout(timer);       // clear timer
		  timer = setTimeout(verifytitle, 2000);

    		return false;
    	});
    	$('#title').on('keydown',function(){

		  clearTimeout(timer);       // clear timer
    	});

    	function verifytitle(title){

    		var title = $('#title');
    		var intitle = $('#intitle');
    		var post_id =$('#post_id').val();

					obj = { "title":title.val(),"post_id":post_id};
					dbParam = JSON.stringify(obj);
					xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					        resp = JSON.parse(this.responseText);
					        
					        console.log(resp.msg);

					        if(resp.stat == true){	
					        	title.notify("Title "+resp.msg,
					        		{position:"bottom left",className:"success"}
					        		);

    						isallowed = true;
					        }else if(resp.stat == false){

					        	title.notify("Title "+resp.msg,
					        		{position:"bottom left",autoHide:false,className:"error"}
					        		);
    						isallowed = false;
					        }else{

    						isallowed = true;

					        }
					    }
					};
					xmlhttp.open("POST", "<?=site_url('ref=post&com=istitlechange');?>", true);
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.send("x=" + dbParam);
					
    	}

    	$('#frmupdate').on('submit',function(){

    	var keyword =$('#keyword').val();
    	var post_id =$('#post_id').val();

    	if(keyword.length <= 0){
    		keyword = 'NULL';
    	}
    	var imgs = $('#featuredimg_url').val();
    	if(imgs.length <= 0){
    		imgs = false;
    	}


  		var content = $('#desc').summernote('code');

  		var createformdata  = 'content='+content+'&title='+$('#title').val()+'&keyword='+keyword+'&featuredImg='+imgs+'&category='+$('#category').val()+'&group='+$('#group').val()+'&post_id='+post_id;
  		


							//console.log(createformdata);return false;
					$.ajax({
						type: 'post',
						dataType: 'json',
						url: '<?=site_url("ref=post&com=update_content");?>',
						data: createformdata,
						beforeSend: function(){
							$('.modal-bg').removeClass('hidden');
						},
						success: function(response){
							console.clear();
							console.log(response);

							$('.modal-bg').addClass('hidden');

							if (response.stat == true) {
								//alert(response.msg);
								$('#warning_msg').removeClass('hidden');

								if($('#warning_msg').hasClass('alert-danger')){
								$('#warning_msg').removeClass('alert-danger');									
								}
								$('#warning_msg').addClass('alert-success');
								$('#warning_msg').html(response.msg);
								setTimeout(function(){
								window.location.reload();
    							},3000);
								return false;
							}else{
								$('#warning_msg').removeClass('hidden');
								if($('#warning_msg').hasClass('alert-success')){
								$('#warning_msg').removeClass('alert-success');									
								}
								$('#warning_msg').addClass('alert-danger');
								$('#warning_msg').html(response.msg);
								return false;

							}



						}
					});


  		return false;
    	});


});
</script>

<script type="text/javascript">
	
$('#desc').summernote({
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    }
});
  $('#desc').summernote({
  toolbar: [
    ['fontname', ['fontname'],
    ['font', ['bold', 'italic', 'underline', 'clear']],
    ['style', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['view',['codeview']]
  ],
  height: 250
});
</script>