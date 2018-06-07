<div class="wrapper admin-wrapper create">


<div class="col-md-4">
	<div class="panel">
	<div class="panel-heading"><h4>Change password</h4></div>
	<div class="pane-body">
		<form class="form form-horizontal" method="post" action="<?=site_url('user/change_pass')?>">
			<div class="form-group">
				<label>Password: </label> <input type="password" name="password" class="form-control">
			</div>

			<div class="form-group">
				<label>Re-password: </label> <input type="password" name="re_password" class="form-control">
			</div>
			
			<div class="form-group">
				<label></label> <button type="submit" name=" btn_change" class="btn btn-info">Change</button>
			</div>

		</form>
	</div>
</div>

</div>


</div>