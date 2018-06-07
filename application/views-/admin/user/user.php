<div class="wrapper admin-wrapper create">
	<div class="panel">
		<div class="panel-heading"><h4>User <button class="btn btn-default" id="addhost"><i class="fa fa-plus"></i></button></h4> </div>

		<div class="panel-body add-form" style="display:<?=$display;?>">
			<div class="col-md-12">

				<div class="form-responsive">
					<form class="form" method="post" action="<?=site_url('user/add_user');?>" name="frmusers" id="frmusers">
						<div class="col-md-6">
						<div class="form-group">
							<label>User name <i style='color:red'>*</i></label><input type="text" name="username" id="username" class="form-control" />
						</div>

						<div class="form-group">
							<label>Password <i style='color:red'>*</i></label><input type="password" name="password" id="password" class="form-control"/>
						</div>

						<div class="form-group">
							<label>Re-Password <i style='color:red'>*</i></label><input type="password" name="re_password" id="re_password" class="form-control"/>
						</div>

						<div class="form-group">
							<label>Email</label><input type="text" name="email" id="email" class="form-control" />
						</div></div>
						<div class="col-md-6">
						<div class="form-group">
							<label>First name</label><input type="text" name="first_name" id="first_name" class="form-control" />
						</div>
						<div class="form-group">
							<label>Middle name</label><input type="text" name="middle_name" id="middle_name" class="form-control" />
						</div>
						<div class="form-group">
							<label>Last name</label><input type="text" name="last_name" id="last_name" class="form-control" />
						</div>


						<div class="form-group">
							<label></label><button type="submit" class="btn btn-success">Save</button>
						</div>

						<div class="form-group">
							<p class="alert hidden" ></p>
						</div>
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
						<th>Username</th>
						<th>Site path</th>
						<th></th>
					</tr>
					</thead>
					<tbody>

						<?php if (!empty($list_user)): ?>
							<?php foreach ($list_user as $key): ?>
							<tr>
							<td><?=$key->user_id;?></td>
							<td><?=$key->user_name;?></td>
							<td><?=$key->user_email;?></td>
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

<script type="text/javascript">
	$('#frmusers').on('submit',function(){
		var data = $(this).serialize();
		//console.log(data);
		$.ajax({
			type: 'post',
			dataType: 'json',
			data: data,
			url: '<?=site_url('user/add_user');?>',
			success: function(res){
				console.log(res);
				if(res.stats == true){

             $('.user-profile').notify(res.msg, { position:"bottom right", className:"success" }); 
             $('.alert').removeClass('hidden').addClass('alert-success').html(res.msg);
             setTimeout(function(){
             	window.location.reload() = true;
             },2000);
             return false;
         	}else{

             $('.user-profile').notify(res.msg, { position:"bottom right", className:"error" }); 
	
             $('.alert').removeClass('hidden').addClass('alert-danger').html(res.msg);
         	}

			}
		});
		return false;

	});
</script>