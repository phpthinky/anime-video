<div class="wrapper admin-wrapper create">
	<div class="panel">
		<div class="panel-heading"><h4>Create user <button class="btn btn-default" id="addhost"><i class="fa fa-plus"></i></button></h4> </div>

		<div class="panel-body add-form" style="display:none;">
			<div class="col-md-12">

				<div class="form-responsive">
					<form class="form" method="post" action="<?=site_url('admin/add_site');?>" name="frmhostedsite" id="frmhostedsite">
						<div class="form-group">
							<label>User name</label><input type="text" name="user_name" id="user_name" class="form-control" />
						</div>

						<div class="form-group">
							<label>Password</label><input type="text" name="user_pass" id="user_pass" class="form-control"/>
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
						<th></th>
					</tr>
					</thead>
					<tbody>

						<?php if (!empty($hosted_site)): ?>
							<?php foreach ($hosted_site as $key): ?>
							<tr>
							<td><?=$key->site_id;?></td>
							<td><?=$key->site_name;?></td>
							<td><?=$key->site_path;?></td>
							<td width="100px;"><button class="btn"><i class="fa fa-edit"></i></button><button class="btn"><i class="fa fa-remove"></i></button></td>
						</tr>
							<?php endforeach ?>
						<?php endif ?>
						
					</tbody>
				</table>
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