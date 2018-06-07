<div class="wrapper site-wrapper">
	<br />
	<div class="container
	site-container">
		<div class="col-md-12">
						<div class="col-md-4"></div>	
						<div class="col-md-4">
			<div class="panel">
				<div class="panel-heading">
					<h4>Login Area</h4>
				</div>
					<div class="panel-body">
						<div class="col-md-12">
							
						<div class="form-reponsive">
							<form class="form form-horizontal" method="post" action="<?=site_url('site/check_login');?>" id="frmlogin" name="frmlogin">
								<div class="form-group">
									<label for="username">Username</label><input type="text" class="form-control" name="user_name" id="user_name" />
								</div>
								<div class="form-group">
									<label for="username">Password</label><input type="password" class="form-control" name="user_pass" id="user_pass" />
								</div>
								<div class="form-group">
									<label for="username"></label><button type="submit" class="btn btn-info">Login</button>
								</div>
							</form>
						</div>	
						</div>	
					</div>
			</div>
						</div>
						<div class="col-md-4"></div>
		</div>
	</div>
</div>
			<script>
				  $('#frmlogin').on('submit',function(){
				    var data = $(this).serialize();
				    $.ajax({
				      type: 'post',
				      dataType: 'json',
				      data: data,
				      url: 'check_login',
				      success: function(res){
				      	console.log(res);
				        if(res.stats){

				             $('header').notify(res.msg, { position:"bottom right", className:"success" }); 

				             setTimeout(function(){
				              window.location.reload() = true;// = '".base_url($redirect)."';//.reload() = true;
				             },2000);
				             return false;
				          }else{

				             $('header').notify(res.msg, { position:"bottom right", className:"error" }); 
				          }

				      }
				    });
				    return false;

				  });
				  </script>