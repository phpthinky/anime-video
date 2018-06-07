<div class="col-md-12">
	<div class="panel profile">
		<div class="pane-heading"><h4>Profile</h4></div>
		<div class="panel-body">
			<div class="col-md-12">
					<div class="col-md-2">
					<div class="row profile-pic">

					<div class="control"><button class="btn btn-default"><i class="fa fa-camera"></i></button></div>
						<img src="<?=base_url();?>public/images/android.png">
					</div>
					<div class="rown profile-name" title="username"><i class="fa fa-user"></i>
						<?php echo $this->session->userdata('username') ? $this->session->userdata('username') : "" ;?>
					</div>
					<div class="rown profile-name" title="Email"><i class="fa fa-envelope"></i>
						<?php echo $this->session->userdata('email') ? $this->session->userdata('email') : "" ;?>
					</div>
					<div class="rown profile-name" title="phone"><i class="fa fa-phone"></i>
						<?php echo $this->session->userdata('mobile') ? $this->session->userdata('mobile') : "" ;?>
					</div><br />
					<div class="rown profile-name" title="Name"><i class="fa fa-check"></i>
						<?php echo $this->session->userdata('mobile') ? $this->session->userdata('mobile') : "" ;?>
					</div>
					<div class="break"><br /></div>
					<div class="breaker-full"></div>
					<div class="row post-menu">

					<ul>
					<li><a href="">My Post (<?php echo $totalpost ?>)</a></li>
					<li><a href="">My Template</a></li>
					<li><a href="">My Project</a></li>
					</ul>
					</div>
					</div>
					<div class="col-md-8">
						<div class="panel">
							<div class="panel-heading"><h4>My post <a href="<?=site_url('ref=post&com=create');?>" class="btn btn-default">New</a></h4></div>
							<div class="panel-body">
							<style type="text/css">
							</style>
							<?php foreach ($listpost as $key): ?>
								<div class="col-md-12 u-post">
									<div class="col-md-4 u-f-img"><div class="u-f-img-cover"><i class="fa fa-exclamation-circle"></i></div>
									<?php if (!empty($key->imgs)): ?>										
									<img src="<?=urldecode($key->imgs);?>">
									<?php endif ?>
									<?php if (empty($key->imgs)): ?>										
									<img src="<?=base_url();?>public/images/blank.jpg">
									<?php endif ?>									

									</div>
									<div class="col-md-8 u-p-title"  style="margin-top:10px;"><a href="ref=home&com=read_post<?=$key->slug;?>"><?=$key->title;?></a> 
									<?php if ($key->status < 1): ?>
										<?php echo "<i class='i-stat-$key->page_id'>(Draft)</i>" ?>
									<?php endif ?>
									<?php if ($key->status == 1): ?>
										<?php echo "<i class='i-stat-$key->page_id'>(Published)</i>" ?>
									<?php endif ?>
									</div>
									<div class="col-md-4 u-p-details"></div>
									<div class="col-md-8 u-p-details">
									<span class="post_category">
									<?php


									$listallcat = $this->post_model->listpostcategory($key->page_id);

									if (is_array($listallcat)) {
										# code...

										$total = count($listallcat);
										$cat = '';
										foreach ($listallcat as $key2) {
										$name = $this->post_model->categoryname_by_id($key2->category_id);
										$cat[] = $name;
										}
									}
									if(count($cat) > 0){
										if (is_array($cat)) {
											# code...
										$post_category = implode(', ',$cat);
										}else{

										$post_category = $cat;
										}


									}else{ $post_category='';}

									 ?>



									Category: <span class="category" id='categoryid<?php echo $key->page_id; ?>'><?php echo $post_category; ?></span> </span> <i id="editcat<?=$key->page_id;?>" class="fa fa-edit u-i-edit" title="Quick edit" onClick="javascript:showedit(<?=$key->page_id;?>,'cat')"></i><br />
									<?php echo "
									<div id='divcat".$key->page_id."' style='display:none;'><input type='text' name='txtcategories' id='txtcategories".$key->page_id."' class='form-control' /><select id='selectcategory".$key->page_id."' class='form-control' multiple>$categories</select><button type='button' class='btn btn-success' style='margin:5px 0;padding:2px 5px;display:inline-block;' onClick=\"quickedit($key->page_id,'cat')\"><i class='fa fa-check'></i></button></div>";


									 ?>
									<span class="date_created">Date posted: <?php echo $key->date_created; ?></span> <i id="editdate<?=$key->page_id;?>" class="fa fa-edit u-i-edit" title="Quick edit" onClick="javascript:quickedit(<?=$key->page_id;?>,'deyt')"></i><br />
									</div>
									<div class="col-md-8 u-p-details"></div>
									<div class="col-md-8 u-p-btn">
									<a href="<?=site_url('ref=post&com=edit&id=');?><?=$key->page_id;?>" class="btn btn-default">Edit</a> | 
									<a href="" class="btn btn-danger">Delete</a> |
										<div class="stats<?=$key->page_id;?>" style="display:inline-block;">
									<?php if ($key->status == 1): ?>
									<a href="javascript:void(0)" class="btn btn-warning" title="Click to unpublish this post" onclick="javascript:changestatus(0,<?=$key->page_id;?>)">Draft</a> 										
									<?php endif ?>
									<?php if ($key->status < 1): ?>
									<a href="javascript:void(0)" class="btn btn-success" title="Click to publish this post" onclick="javascript:changestatus(1,<?=$key->page_id;?>)">Publish</a> 									
									<?php endif ?>
										</div>
									</div>
								
									<div class="breaker-full"></div>
								</div>
							<?php endforeach ?>
							<div class="records" style="display:inline-block;margin:10px;padding:0;">
							<div class="total_record" style="display:inline-block;">
							<ul class="pagination"><li><a href="javascript:void(0)"><?php 
								echo $start+1;
								echo ' - ';
								echo $list_total+$start;
								echo ' of ';
								echo $totalpost;?></a></li> 
								

								</div>
							<?php echo isset($links) ? $links : ''; ?></div>
							
							</div>
						</div>
						<div class="panel hidden">
							<div class="panel-heading"><h4>My template</h4></div>
							<div class="panel-body">

							</div>
						</div>

						<div class="panel hidden">
							<div class="panel-heading"><h4>My project</h4></div>
							<div class="panel-body">

							</div>
						</div>
					</div>
					<div class="col-md-2">
					<div class="panel">
						<div class="pane-heading"><h4>More settings</h4></div>
					</div></div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
var showhidden = false;
	function showedit (id,options) {
		// body...


		if (options == 'cat') {

			if (showhidden) {

								$("#categoryid"+id).notify(
									  "Edit canceled! ",
									  {position: "top right",autoHide:true,className:"error"}
									);

			$('#divcat'+id).hide();
			showhidden = false;
			}else{
	
			$('#divcat'+id).show();

			$('#selectcategory'+id).change(function(){
		    var category = $(this).val();
		    var selectedcategory = category.join(", ");
			    $('#txtcategories'+id).val(selectedcategory);
			    
			});
			showhidden = true;

			}



			return false;
		}else if(options == 'deyt'){

			return false;
		}

	}
	function quickedit (id,options) {
		// body...
		if (options == 'cat') {
			editcategory(id);
			return false;
		}else if(options == 'deyt'){
			editdeytposted(id);
			return false;
		}
	}
	function editcategory (id) {
		// body...
		var cat = $('#txtcategories'+id).val();
		var postdata = 'post_id='+id+'&type=category'+'&category='+cat;


				$.ajax({
						type: 'post',
						url: '?ref=post&com=update_post',
						data: postdata,
						dataType:'json',
						success: function(response){
							console.clear();
							console.log(response);	
							if(response.stat == true){
							
							$('#categoryid'+id).html(response.option);							
							$('#divcat'+id).hide();



								$("#categoryid"+id).notify(
									  "Category " + response.msg,
									  {position: "top right",autoHide:true,className:"success"}
									);

							}else{

								$("#categoryid"+id).notify(
									  "Update error "+response.msg,
									  {position: "top right",autoHide:true,className:"error"}
									);

							}

						showhidden = false;

						}
					});
	}
	function editdeytposted(id){
		alert('Date');
	}

	function changestatus (stat,id) {
		// body...

								if (stat == 0) {
									var stat_is = 1;
								}else{
									var stat_is = 0;
								}


		var	postdata = 'select='+stat+'&post_id='+id+'&type=status';
						$.ajax({
						type: 'post',
						url: '?ref=post&com=update_post',
						data: postdata,
						dataType:'json',
						success: function(response){
							console.clear();
							console.log(response);	
							if(response.stat == true){
							

								if (stat == 0) {

									$('.stats'+id).html('<a href="javascript:void(0)" class="btn btn-success" title="Click to unpublish this post" onclick="javascript:changestatus(1,'+id+')">Publish</a> ');
									$('.u-p-title i.i-stat-'+id).html('(Draft)');
									//return false;
								};

								if (stat == 1) {
									$('.stats'+id).html('<a href="javascript:void(0)" class="btn btn-warning" title="Click to unpublish this post" onclick="javascript:changestatus(0,'+id+')">Draft</a> ');
									$('.u-p-title i.i-stat-'+id).html('(Published)');
									//return false;
								};


								$('.u-p-title i.i-stat-'+id).notify(
									  " Post " + response.msg,
									  {position: "top right",autoHide:true,className:"success"}
									);

							}else{

								$('.u-p-title i.i-stat-'+id).notify(
									  " Post error "+response.msg,
									  {position: "top right",autoHide:true,className:"error"}
									);

							}

						}
					});
	}
</script>