
<div class="wrapper admin-wrapper create">
	<div class="panel">
		<div class="panel-heading"></div>
		<div class="panel-body">
		<div class="pull-right" style="text-align:right;"><form class="form form-horizontal"><div class="form-inline"><input type="text" name="q" id="q" class="form-control" /><button class="btn btn-default"><i class="fa fa-search"></i></button></div></form></div>
			<table class="table table-hover tbl-list-post"><h4>List all post</h4><p><label>Quick edit</label> - Double click on the category, status.</p>
				<thead><tr><th>#</th><th>Title</th><th>Category</th><th>Site</th><th>Action</th></tr></thead>
				<tbody>
					<?php 
						if(isset($listall)){
							if (is_array($listall)) {
								foreach ($listall as $key) {								
								?>
								<tr id="tr-<?=$key->post_id;?>">
									<td><?=$key->post_id;?></td>
									<td><?=$key->post_title;?></td>
									<td><?php 

								if($category = $this->post_m->get_categories($key->post_id)){
									foreach ($category as $cat) {
										
										echo "<span class='category-item'>$cat->cat_name</span> ";
									}
								}

								?></td>
									<td><?=$key->site_path;?></td>
									<td><a href="<?=site_url("post/edit/$key->post_id");?>"><i class="btn fa fa-edit"></i></a> <a href="javascript:void(0)" id="remove_post" onclick="remove_post(<?=$key->post_id;?>)"><i class="btn fa fa-remove"></i></a></td>
								</tr>
								<?php
								}
							}
						}
					?>
				</tbody>
			</table>
			<div class="col-md-12">

			<div class="pull-right"  style="text-align:right;"><?php echo isset($pagination) ? $pagination : '';?></div>
			<div class="pull-left total-records"  style="text-align:right;">
			<div style="text-align:right;padding-top:20px;font-size:18px;font-weight:bold;">Record: 
			<?php 
			if (isset($listall)) {
					/*
				echo $start+1;
				echo ' - ';
				echo $list_total+$start;
				echo ' of ';
				echo $total_posted;
				/*/
			}
			//echo $records =$total_posted-$list_total;

			?>

			</div></div>
			</div>
	
		</div>
	</div>
</div>
<script type="text/javascript">
$('#selectcategory').change(function(){
    var category = $(this).val();
    var selectedcategory = category.join(", "); // there is a break after comma

    //alert (selectedmeals); // just for testing what will be printed

})
	var options = false;
	/*$.notify.addStyle("success", { html: "<span style='color:lime;display:inline-block:min-width:150px;'> Update success. </span>" });*/

	function buttonClick(id,url) {
		// body...
		window.location = '<?=site_url();?>/'+url;
	}

	function updatecats(id,uoption){


		var txtcategories = $('#txtcategories'+id).val();
		var frmdata = 'category='+txtcategories+'&post_id='+id+'&type='+uoption;

			$('#spancat'+id).show();
			$('#divcat'+id).hide();
			options = false;
				$.ajax({
						type: 'post',
						url: '../post/update_post',
						data: frmdata,
						dataType:'json',
						success: function(response){
							console.clear();
							console.log(response);	
							if(response.stat == true){
							
							$('#spancat'+id).html(response.option);


								$("table").notify(
									  uoption+" Updated " + response.msg,
									  {position: "top right",autoHide:true,className:"success"}
									);

							}else{

								$("table").notify(
									  uoption+" Update error "+response.msg,
									  {position: "top right",autoHide:true,className:"error"}
									);

							}

						}
					});


			return false;
	}
	function updatestats(id,uoption){


		var status = $('#select'+id).val();
		//alert(status);return false;
		var frmdata = $('#frm'+id).serialize();
		frmdata = frmdata+'&post_id='+id+'&type='+uoption;


			$('#span'+id).show();
			$('#div'+id).hide();
			options = false;
				$.ajax({
						type: 'post',
						url: '../post/update_post',
						data: frmdata,
						dataType:'json',
						success: function(response){
							console.clear();
							console.log(response);	
							if(response.stat == true){
							
							$('#span'+id).html(response.option);


								$("table").notify(
									  uoption+" Updated " + response.msg,
									  {position: "top right",autoHide:true,className:"success"}
									);

							}else{

								$("table").notify(
									  uoption+" Update error "+response.msg,
									  {position: "top right",autoHide:true,className:"error"}
									);

							}

						}
					});


			return false;
	}
	function editstatus (id) {
		// body...
		if (options == false) {

		$('#span'+id).hide();
		$('#div'+id).show();
		options = true;
		return false;
	}else{

		$('#span'+id).show();
		$('#div'+id).hide();
		options = false;;
		return false;
	}

	}

	function editcategory (id) {
		// body...
		if (options == false) {

		$('#spancat'+id).hide();
		$('#divcat'+id).show();
		options = true;


		$('#selectcategory'+id).change(function(){
	    var category = $(this).val();
	    var selectedcategory = category.join(", ");
		    $('#txtcategories'+id).val(selectedcategory);
		    
		})
		return false;
	}else{

		$('#spancat'+id).show();
		$('#divcat'+id).hide();
		options = false;;
		return false;
	}

	}

	function remove_post(post_id){

				$.ajax({
						type: 'post',
						url: '<?=site_url("post/remove_post");?>',
						data: 'post_id='+post_id,
						dataType:'json',
						success: function(response){
							console.clear();
							console.log(response);	

							$('#tr-'+post_id).remove();
		             		$('header').notify('Post successfully remove', { position:"bottom right", className:"success" }); 
							
						}
					});
	}
</script>