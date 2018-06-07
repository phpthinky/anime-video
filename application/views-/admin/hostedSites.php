<div class="wrapper admin-wrapper create">


	<div class="panel">
		<div class="panel-heading"><h4>Hosted Site <button class="btn btn-default" id="addhost"><i class="fa fa-plus"></i></button></h4> </div>

		<div class="panel-body add-form" style="display:<?=$is_display;?>">
			<div class="col-md-12">

				<div class="form-responsive">
					<form class="form" method="post" action="<?=site_url('admin/add_site');?>" name="frmhostedsite" id="frmhostedsite">
						<div class="form-group">
							<label>Site name</label><input type="text" name="site_name" id="site_name" class="form-control" />
						</div>

						<div class="form-group">
							<label>Site path</label><input type="text" name="site_path" id="site_path" class="form-control"/>
						</div>

						<div class="form-group">
							<label>Site category</label>
							<select class="form-control" name="category" id="category" required>
								<?php foreach ($site_category as $key ): ?>
									<option value="<?=$key->id?>"><?=$key->name?></option>
								<?php endforeach ?>
							</select>
							
							
						</div>	
						<div class="form-group">
							<label></label><button class="btn btn-info">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						
					<tr>
						<th>ID #</th>
						<th>Site name</th>
						<th>Site path</th>
						<th>Action</th>
						<th>Users</th>
					</tr>
					</thead>
					<tbody>

						<?php if (!empty($hosted_site)): ?>
							<?php foreach ($hosted_site as $key): ?>
							<tr>
							<td><?=$key->site_id;?></td>
							<td><?=$key->site_name;?></td>
							<td><?=$key->site_path;?></td>
							<td width="100px;"<button class="btn"><i class="fa fa-edit"></i></button> <button class="btn"><i class="fa fa-remove"></i></button></td>

							<td><button class="btn"  data-toggle="modal"  data-target="#usermodal" ><i class="fa fa-plus"></i> Add user</button></td>
						</tr>
							<?php endforeach ?>
						<?php endif ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- category modal -->
<div class="row">
	<!-- Modal -->
<div id="usermodal" class="modal fade" role="dialog">
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
        <h4 class="modal-title">Add user</h4>
      </div>
      <div class="modal-body">
        <p><div class="err_msg hidden"></div>	
        <style type="text/css">
        	 ul#list_users{
        		list-style: none;
        		padding: 0;
        		margin: 0;
        		margin-top: -2px;
        		text-decoration: none;
        		display: none;
        		width: 99% !important;
        		position: absolute;
        	}
        	 ul#list_users li{
        		list-style: none;
        		padding: 5px;
        		margin: 0;
        		margin-top: -10px;
        		text-decoration: none;
        		background-color: #000;
        		color: #fff;
        	}
        </style>		
		<form action="#" id="frmcat">

			<div class="form-group">

			<div class="col-md-12" style="margin:0;padding:0;margin-bottom: 10px;"><input type="text" name="txt_user_name" id="txt_user_name" class="form-control" style="padding: 2px;" /></div>
			<div class="col-md-12"  style="margin:0;padding:0;margin-bottom: 10px;">
			<ul id="list_users"><li>username</li></ul></div>
			</div>

			<div class="form-group">
				<select class="form-control" id="site_id" name="site_id"></select>
				
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
	
var is_addhost = false;

$('#addhost').on('click',function(){
	
	if (is_addhost == true) {
		$('.add-form').hide('fast');
		is_addhost = false;
	}else{

		$('.add-form').show('slow');
		is_addhost = true;
	}
});
</script>


<script type="text/javascript">
	$('#txt_user_name').on('keyup',function(){
		var user = $(this).val();

		if(user.length > 2){

		$('#list_users').show('slow');
	}else{

		$('#list_users').hide('fast');
	}

	});
</script>