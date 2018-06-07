<div class="wrapper admin-wrapper create">
	<div class="panel">
		<div class="panel-heading"><h4>Add new page</h4></div>		
	</div>
	<div class="col-md-12" style="margin:0;padding: p0;">
			
		<form class="form form-horizontal" id="frmpage">
			<div class="form-responsive">
				<div class="col-md-8">
					<div class="panel">
					<div class="form-group">
						
              					
              					<label>Page title</label>
              				
              					<input type="text" class="form-control" id="title" name="title" required>

					</div>

              		<div class="form-group">
              					
              				<label>Page content</label><textarea id="desc" name="desc" class="form-control" rows="12">
              					
              				</textarea>

              		</div>
              		</div>


				</div>
				<div class="col-md-4" >
					<div class="panel">
					<div class="form-group">
              				<div class="col-md-12">
              					<label>Site name</label>
              				<select class="form-control" id="opt_site" name="opt_site">
		              					
							<?php $i=0; if (isset($hosted_site)): ?>
								<?php foreach ($hosted_site as $key): ?>
									
							<option value="<?=$key->site_id?>"><?=$key->site_name?> <?php if($i == 0 ) {echo ' - (Default)'; } ?></option>
								<?php $i++; endforeach ?>
							<?php endif ?>
              					
              					<?php
              					?>
              				</select>
              				</div>
              		</div>


              				<div class="form-group">
              					
              				<div class="col-md-12">
              					<label>Parent <a href="#" class="btn add-parent" style="padding: 5px;margin-top: -10px;font-size: 12px;" data-toggle="modal"  data-target="#parent-modal" ><i class="fa fa-plus"></i></a></label>
              				
              				<div class="select-parent">
              					
              				</div>
              				<select class="form-control" id="opt_parent" name="opt_parent">
		              					
							<?php if (isset($parents)): ?>
								<?php foreach ($parents as $key): ?>
									
							<option value="<?=$key->page_id?>"><?=$key->page_title?></option>
								<?php endforeach ?>
							<?php endif ?>
              					
              					<?php
              					?>
              				</select>

              				</div>
              			</div>

              			<div class="form-group">
              				
              				<div class="col-md-12">
              					
              				<label></label><button type="submit" class="btn btn-success" id="btnpage">Publish</button> <button class="btn btn-warning pull-right hidden">Unpublish</button>
              					
              				
              				</div>
              			</div>
              			<div class="form-group">
              				
              				<div class="col-md-12">
              					
              				<label>Add Gallery</label>
              				<br /><button type="button" class="btn btn-default" id="btngallery"  data-toggle="modal"  data-target="#galleryModal" ><i class="fa fa-image"></i></button> 
              					
              				
              				</div>
              			</div>
              		</div>

				</div>

			</div>
		</form>
	</div>

</div>

<!--- -->

<div class="row">
	<!-- Modal -->
<div id="galleryModal" class="modal fade" role="dialog">
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
        <button type="button" class="close" data-dismiss="modal"  onClick="clearform('gall_Image');">&times;</button>
        <h4 class="modal-title">Add photo gallery</h4>
      </div>
      <div class="modal-body">
      	
        <p>		
		<form action="#" id="gall_Image" name="gall_Image" class="form form-horizontal">
			<div class="row">
			<div class="col-md-8">
				
			<input type="file" id="file_input" name="file_input" multiple />
			<div id="thumb-output"></div>
			</div>


			<div class="col-md-4">
				<label style="width:12px;"></label><button class="btn btn-sm btn-info upload" type="submit" id="upload">Upload</button>
			</div>
			</div>
			<div class="row">
				
			    <div class="col-md-12">
			       <div class="col-md-12">
			        <div style="width:100%;margin-left:10px;text-align:left;" class="upload_img btn"></div> 
			        
			       
			          <br />
			        <div class="progress" id="progress-div" width="0%"><div class="bar" id="progress-bar"></div></div>
			    
			        </div>
			    </div>


			</div>
		</form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default hidden" data-dismiss="modal" onClick="clearform('frmImage');">Close</button>
      </div>
    </div>

  </div>
</div>
</div>


<!-- category modal -->
<div class="row">
	<!-- Modal -->
<div id="parent-modal" class="modal fade" role="dialog">
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
        <h4 class="modal-title">Parent name</h4>
      </div>
      <div class="modal-body">
        <p><div class="err_msg hidden"></div>			
		<form action="<?=site_url("pages/add_parent")?>" nam='frmparent' id="frmparent" method="post">
			<div class="form-group">

			<input type="text" name="parent_title" id="parent_title" class="form-control" /><br />
				
			</div>
			<div class="form-group">

              					<label>Site name</label>
              				<select class="form-control" id="parent_site_id" name="parent_site_id">
		              					
							<?php $i=0; if (isset($hosted_site)): ?>
								<?php foreach ($hosted_site as $key): ?>
									
							<option value="<?=$key->site_id?>"><?=$key->site_name?> <?php if($i == 0 ) {echo ' - (Default)'; } ?></option>
								<?php $i++; endforeach ?>
							<?php endif ?>
              					
              					<?php
              					?>
              				</select>
			</div>
			<div class="form-group">
			<button class="btn btn-sm btn-info upload" type="submit" id="addparent">Add</button>
		</div>


			<div class="progress progress-striped active" style="width:100%">
				<div class="progress-bar" style="width:0%;"></div>
			</div>

        		<div class="form-group" style="max-width:400px;">

        			<input type="hidden" id="isselected" value="0">	
        		</div>
		</form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="clearform('frmcat');">Close</button>
      </div>
    </div>

  </div>
</div>
</div>


<script type="text/javascript">
	
	$('#gall_Image').on('submit',function(e){
			e.preventDefault();

    		var btnInput = 'file_input';

			//if (selected > 0) {

				    var frmdata = new FormData();
				    var sfile = $('#'+btnInput).val() ;
				    var file = $('#'+btnInput);
				    ///alert(btnInput);return false;
				    var ins = document.getElementById(btnInput).files.length;
				    for (var x = 0; x < ins; x++) {
				        frmdata.append(btnInput+"[]", document.getElementById(btnInput).files[x]);
				    }
				    frmdata.append('btnInput',btnInput);

				uploadImageGal(frmdata);

			//}else{
			//	console.log('No file selected');
			//}

		});

    		var i = 0;
    		var percentComplete;
    		var xhr;
    		var	gall_input = [];
		function uploadImageGal(data) {

		     console.clear();
			$.ajax({


          	   xhr: function() {
          	   		

		                xhr = new window.XMLHttpRequest();

		                xhr.upload.addEventListener("progress", function(evt) {
		                  if (evt.lengthComputable) {
		                    percentComplete = evt.loaded / evt.total;
		                    percentComplete = parseInt(percentComplete * 100);
		                    $('.upload_img').html('Upload on progress with '+percentComplete+' % to complete.');
		                    //console.log(percentComplete);
		                   
		                    
		                    if (percentComplete < 10) {
		                      $('.upload_img').addClass('alert-danger');
		                    }
		                    if (percentComplete >=10 && percentComplete < 25) {
		                      $('.upload_img').removeClass('alert-danger');
		                    }
		                    if (percentComplete >= 25 && percentComplete < 50) {
		                      $('.upload_img').removeClass('alert-danger');
		                      $('.upload_img').addClass('alert-warning');
		                    }
		                    if (percentComplete >= 50 && percentComplete < 75) {
		                      $('.upload_img').removeClass('alert-warning');
		                      $('.upload_img').addClass('alert-info');
		                    }
		                    if (percentComplete === 100) {
		                      $('.upload_img').removeClass('alert-info');
		                      $('.upload_img').addClass('alert-success');
		                      $('.upload_img').html('proccessing...');

		                    }

		                  }
		                }, false);

		                return xhr;
          	   },

		      type: 'post',
		      url: '<?=site_url('post/add_gallery');?>',
		      data: data,
		      processData: false,
		      contentType: false,
		      dataType:'json',
		      success: function (resp) {
		      		console.clear();
					console.log(resp);
					if(resp.stats == true){
						//$('#txtgallery').val(resp.u_key);
							$.each(resp.link, function(i, item) {
							    console.log(item.link);

							    $('.gallery-preview').append('<div class="col-md-4 preview-gal" id="'+item.u_key+'" ><i class="fa fa-remove btn pull-right" onclick="remove_gal(\''+item.u_key+'\')"></i><img sr"<?=base_url();?>'+item.link+'" alt="Preview '+i+'" style="width:100%;" /></div>');

							    gall_input.push(item.u_key);

							});
							console.log(gall_input.join());
							$('#gall_input').val(gall_input.join())
						}
		      },
		         complete: function() {
		          // setting a timeouti--;
		              if (i <= 0) {
		                      $('.upload_img').removeClass('alert-success');
		                      $('.upload_img').removeClass('btn');
		                  		$('.upload_img').html('');
		                  

		              }
		          }
			});


      		return false;
		}
</script>


<script type="text/javascript">
	$(document).ready(function(){
    $('#file_input').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            $('#thumb-output').html(''); //clear html of output element
            var data = $(this)[0].files; //this file data
            
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                        $('#thumb-output').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    });
});

</script>


<script type="text/javascript">
	
		$('#frmpage').on('submit',function(){
			var data = $(this).serialize();
				//console.log(data);
				//return false;
			$.ajax({

		      type: 'post',
		      url: '<?=site_url('pages/save_page');?>',
		      data: data,
		      dataType:'json',
		      success: function (resp) {
		  
			  			//console.clear();
						//console.log(resp);

						if(resp.stats == true){

			            	$('.user-profile').notify('Page added succesfully.', { position:"bottom right", className:"success"
			            	 }); 

			             setTimeout(function(){
			             	window.location.reload() = true;

		      			 },2000);
						}else{

			            	$('.user-profile').notify('Page not added!', { position:"bottom right", className:"error" }); 
						}	
		      }
			});


      		return false;
		});

</script>

<script type="text/javascript">
	$('#frmparent').on('submit',function(){

		var data = $(this).serialize(); /*'opt_site='+site+'&opt_parent='+parent+'&title='+page_title+'&desc='+content;*/


		$.ajax({
		 	  type: 'post',
		      url: '<?=site_url('pages/add_parent');?>',
		      data: data,
		      dataType:'json',
		      success: function (resp) {

		      		//console.clear();
					//console.log(resp);
					if(resp.stats == true){
						$('#opt_site').change();
					}else{

					console.log(resp);
					}
		      }
			});
		
		return false;
	});
</script>
<script type="text/javascript">
	$('#opt_site').on('change',function(){
		var data = $(this).val();
		$.ajax({
		 type: 'post',
		      url: '<?=site_url('pages/get_parent');?>',
		      data: 'opt_site='+data,
		      dataType:'json',
		      success: function (resp) {
		      		//console.clear();
					//console.log(resp);
					if(resp.stats == true){
						//$('#opt_parent').innerHTML(resp.msg);

                    $('#opt_parent').empty();
                    $('#opt_parent').html(resp.msg);
					}else{

                    $('#opt_parent').empty();
                    $('#opt_parent').html(resp.msg);
					}
		      }
			});

		return false;
	});
</script>


<script type="text/javascript">
	$('.add-parent').on('click',function(){
			var selected = $('#opt_site').val();
			$("#parent_site_id option[value="+selected+"]").attr('selected', 'selected');

	});
	

	function clearform(){

	}
	$( document ).ready(function() {
   	
						$('#opt_site').change();
	});
</script>