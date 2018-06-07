<div class="col-md-12">
<div class="col-md-9">
	<div class="panel">
		<div class="panel-heading"><h4><label><?=$title;?></label></h4></div>
		<div class="panel-body">
		<p class="btn alert-info hidden" id="msg"></p>
		<form class="form" action="" method="post" name="frmcreate" id="frmcreate">
			<div class="form-group">
			<label for="title">Username</label><input type="text" class="form-control" name="username"  id="username" placeholder="Enter username here" autocomplete="off" required/>
				<p class="btn alert-danger hidden" id="inusername"></p>
			</div>	
			<div class="form-group">
				<label for="title">Email</label><input type="email" class="form-control" name="email"  id="email" placeholder="Enter email here" required/>
			</div>
			<div class="form-group">
				<label for="title">Password</label><input type="password" class="form-control" name="password"  id="password" placeholder="Enter password here" required/>
			</div>
			<div class="form-group">
				<label for="title">Confirm Password</label><input type="password" class="form-control" name="cpassword"  id="cpassword" placeholder="Re-type password here" required/>
			</div>
			<br />
			<br />
			<h4><label>Other information</label></h4>
			<div class="form-group">
				<label for="title">Mobile #</label><input type="text" class="form-control" name="mobile"  id="mobile" placeholder="Enter mobile here" />
			</div>

			<div class="form-group">
				<label for="title">First name</label><input type="text" class="form-control" name="firstname"  id="firstname" placeholder="Enter first name here" />
			</div>

			<div class="form-group">
				<label for="title">Last name</label><input type="text" class="form-control" name="lastname"  id="lastname" placeholder="Enter last name here" />
			</div>
			<div class="form-group">
				<label for="title">Bio</label><textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Enter short biograph here"></textarea>
			</div>
			<div class="form-group">
				<label for="title"></label><button type="submit" class="btn btn-info" style="min-width:100px;" name="create" id="create">Create</button>

			</div>
			

		</form>	
		</div>
	</div>
</div>
<div class="col-md-3">
	
</div>
</div>

<script type="text/javascript">
var isallowed = false;
	$(function () {
		// body...
		$('#frmcreate').on('submit',function(){
			var msg = $('#msg');
			var formdata = $('#frmcreate').serialize();

			//console.log(formdata);

    		
    		$.ajax({
    			type: 'post',
    			data: formdata,
    			url: '<?=site_url("u/save_user2");?>',
    			success: function(resp2){
    				console.clear();
    				alert(resp2);
    				
    			}
    		});

			return false;
		})

		$('#username').keypress(function( e ) {
       if(e.which === 32) 
         return false;
    });
	});

    	$('#username').on('keyup',function(){
    		var username = $('#username');
    		var inusername = $('#inusername');
    		if (username.val().length < 3) {

								if($(inusername).hasClass('alert-success')){
								inusername.removeClass('alert-success');									
								}

								if($(inusername).hasClass('alert-danger')){
								inusername.removeClass('alert-danger');									
								}
						inusername.html('Warning: Username is too short or empty!')
    					inusername.removeClass('hidden');
    					inusername.addClass('alert-danger');
    					isallowed = false;
    			return false;
    		};
    		$.ajax({
    			type: 'post',
    			data: 'username='+username.val(),
    			url: '<?=site_url("u/ifuserexist");?>',
    			dataType: 'json',
    			success: function(resp2){
    				if (resp2.stat) {

								if($(inusername).hasClass('alert-danger')){
								inusername.removeClass('alert-danger');									
								}

    					inusername.removeClass('hidden');
    					inusername.addClass('alert-success');
    					inusername.html(resp2.msg);
    					isallowed = true;

    				}else{

								if($(inusername).hasClass('alert-success')){
								inusername.removeClass('alert-success');									
								}

    					inusername.removeClass('hidden');
    					inusername.addClass('alert-danger');
    					inusername.html(resp2.msg);
    					isallowed = false;
    				}
    				
    			}
    		});
    		return false;
    	});

</script>