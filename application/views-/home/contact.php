<div class="row contact">
<div class="col-md-9 post-content">
	<div class="panel">
		<div class="panel-heading"><h3>Contact Us!</h3></div>
		<div class="panel-body">
			<form class="form" action="#" method="post" name="frmcontact" id="frmcontact">
				<div class="form-group">
					<label>Email</label><input type="email" name="email" id="email" class="form-control"  placeholder="Enter your email">
				</div>
				<div class="form-group">
					<label>Subject</label><input type="email" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
				</div>
				<div class="form-group">
					<label>Message</label><textarea id="message" name="message" class="form-control" rows="5" placeholder="Enter your message"></textarea >
				</div>
				<div class="math-captcha form-inline" >
					<canvas id='canvas' class="form-control" style="width:220px;display:inline-block;background:#e5e5e5;height:50px;"></canvas>
					
					<input type="number" id="total" name="total" class="form-control" placeholder="Enter total here">
				</div>	
					<br />
				<div class="form-group">
					<label></label><button type="button" class="btn btn-info" style="width:100px;">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-md-3 post-sidebar">
	
</div>
</div>

<script type="text/javascript">

function draw() {
  var ctx = document.getElementById('canvas').getContext('2d');
  ctx.font = '78px serif';
  ctx.fillText('<?php echo $number1;?> + <?php echo $number2;?>' , 20, 100);
}
draw();

</script>