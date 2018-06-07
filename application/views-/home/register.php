<div class="post-index">
	<div class="panel">
		<div class="panel-heading">
			


		</div>
		<?php if (($this->input->get('stats')) && ($this->input->get('stats') == true) && (isset($this->session->to_verify)) && ($to_verify == true)): ?>

		<div class="panel-body">
			<div class="form-responsive">
				<form class="form form-horizontal" method="post" action="verify">

					<div class="form-group">
						<label for="vpassword">Enter code: </label><input type="text" name="verify" id="verify" class="form-control" style="max-width: 200px;" required>
					</div>
					<div class="form-group">
						<label for="submit"></label><button class="btn btn-info" type="submit">Verify</button>
					</div>


				</form>
				<p>Notes: Check your email inbox for verification code. Sometime it was sent into your spam folder.</p>
				<p>Verify later: <a href="<?=site_url('login')?>">Click to login.</a></p>
			</div>
		</div>
		<?php else: ?>
		<div class="panel-body" style="max-width: 400px;">
			<div class="form-responsive">
				<form class="form form-horizontal" method="post" action="verify">
					<div class="form-group">
						<label for="email">Username</label><input type="text" name="username" id="username" class="form-control" minlength="4" style="max-width: 400px;"  required>
					</div>
					<div class="form-group">
						<label for="email">Email</label><input type="email" name="mail" id="mail" class="form-control" style="max-width: 400px;"  required>
					</div>

					<div class="form-group">
						<label for="password">Password</label><input type="password" name="pass_word" id="pass_word" class="form-control" style="max-width: 400px;" minlength="6"  required>
					</div>

					<div class="form-group">
						<label for="vpassword">Retype Password</label><input type="password" name="vpassword" id="vpassword" class="form-control" style="max-width: 400px;" minlength="6"  required>
					</div>
					<div class="form-group">
						<label for="submit"></label><button class="btn btn-info" type="submit">Signup</button>
					</div>
					<div class="form-group">
						<div class="msg"></div>
					</div>
				</form>
			</div>
		</div>


		<?php endif ?>

	</div>
</div>

<script type="text/javascript">
	$('form').on('submit',function(){
		var p = $('#pass_word');
		var vp = $('#vpassword');

		if(p.val() != vp.val()){
			$('.msg').addClass('alert alert-danger').html('Password do not match. Please try again')
			setTimeout(function(){
				$('.msg').removeClass('alert alert-danger').html('')
			},5000);

			return false;
		}

	});
</script>