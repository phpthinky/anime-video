<div class="wrapper admin-wrapper create">
	<div class="panel">
		<div class="panel-heading"><h4>Add new page</h4></div>
		<div class="panel-body">
			<div class="form-responsive">
				<form class="form form-horizontal" id="frmpage" name="frmpage" >
					<div class="form-responsive">
						

              			<div class="form-group">


              				<div class="col-md-6">
              					<label>Site name</label>
              				<select class="form-control" id="opt_site" name="opt_site">
		              					
							<?php $i=0; if (isset($hosted_site)): ?>
								<?php foreach ($hosted_site as $key): ?>
									<?php if((int)$site_id === (int)$key->site_id){$i_site = 'selected'; }else{$i_site = '';} ?>
							<option value="<?=$key->site_id?>" <?=$i_site;?> ><?=$key->site_name?> <?php if($i == 0 ) {echo ' - (Default)'; } ?></option>
								<?php $i++; endforeach ?>
							<?php endif ?>
              					
              					<?php
              					?>
              				</select>
              				</div>

              				<div class="col-md-6">
              					
              					<label>Parent <a href="#" class="btn add-parent" style="padding: 5px;margin-top: -10px;font-size: 12px;" data-toggle="modal"  data-target="#parent-modal" ><i class="fa fa-plus"></i></a></label>
              				
              				<div class="select-parent">
              					
              				</div>
              				<select class="form-control" id="opt_parent" name="opt_parent">
		              					
							<?php if (isset($parents)): ?>
								<?php foreach ($parents as $key): ?>
									<?php if((int)$parent_id === (int)$key->parent_id){$i_parent = ' selected '; }else{$i_parent = '';} ?>
							<option value="<?=$key->page_id?>" <?=$i_parent;?> ><?=$key->page_title?></option>
								<?php endforeach ?>
							<?php endif ?>
              					
              					<?php
              					?>
              				</select>

              				</div>



              				<div class="col-md-12">
              					
              					<label>Page title</label>
              				
              					<input type="text" class="form-control" id="title" name="title" value="<?=isset($page_title) ? $page_title :'';?>" required>
              					<input type="hidden" name="" class="form-control" id="page_id" name="page_id" value="<?=isset($page_id) ? $page_id :0;?>">

              				</div>
              				
              				
              			</div>
              			<div class="form-group">
              				<div class="col-md-12">
              					
              				<label>Page content</label><textarea id="desc" name="desc" class="form-control" rows="12">
              					<?=isset($page_content) ? $page_content :'';?>
              					
              				</textarea>

              				</div>
              			</div>

              			<div class="form-group">
              				
              				<div class="col-md-12">
              					
              				<label></label><button type="submit" class="btn btn-success" id="btnpage">Publish</button> <button class="btn btn-warning pull-right hidden">Unpublish</button>
              					
              				
              				</div>
              	</div>

					</div>
				</form>
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
	
		$('#frmpage').on('submit',function(){

		var parent = $('#opt_parent').val();
		var page_title = $('#title').val();
		var page_id = $('#page_id').val();

		if(parent == 0){
			alert('Parent is required');
			return false;
		}
		if(page_title == ''){
			alert('Page Title is required');
			return false;
		}


			var data = $(this).serialize();

			$.ajax({
		      type: 'post',
		      url: '<?=site_url('pages/update_page');?>',
		      data: data+'&page_id='+page_id,
		      dataType:'json',
		      success: function (resp) {
		  
			  			console.clear();
						console.log(resp);

						if(resp.stats == true){

			            	$('.user-profile').notify('Page updated succesfully.', { position:"bottom right", className:"success"
			            	 }); 
			            	
			             setTimeout(function(){
			             	window.location.reload() = true;

		      			 },2000);
						}else{

			            	$('.user-profile').notify('Page not updated!', { position:"bottom right", className:"error" }); 
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

		      		console.clear();
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
		var site_id = $(this).val();
		var	parent_id = '<?=$parent_id;?>';
		$.ajax({
		 type: 'post',
		      url: '<?=site_url('pages/get_parent');?>',
		      data: 'opt_site='+site_id+'&parent_id='+parent_id,
		      dataType:'json',
		      success: function (resp) {
		      		console.clear();
					if(resp.stats == true){
					console.log(resp);
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
   	
						//$('#opt_site').change();
	});
</script>