<?php 

if(isset($info) && is_array($info)){
	foreach ($info as $key) {
		# code...
		echo "
			<div class='panel'>
				<div class='panel-heading'><h3>$key->quizes_title</h3></div>
				<div class='panel-body'>
					<p><h4>Exam category</h4>
					";
					if(isset($key->category) && is_array($key->category)){
						echo "<ul>";
						foreach ($key->category as $cat) {
							# code...
							echo "<li>$cat->category_name</li>";

						}

						echo "</ul>";
					}

					echo "
					</p>
				</div>
			</div>
		";

	}
	echo "<a href='' class='btn btn-success btn-sm' data-title='Click to try this exam.' id='btn-try'><i class='fa fa-book'></i> Try this exam</a>";
	echo '<div class="fb-share-button btn" data-href="'.base_url($_SERVER['REQUEST_URI']).'" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.base_url($_SERVER['REQUEST_URI']).'&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore btn btn-primary btn-sm"><i class="fa fa-facebook"></i> Share</a></div>';
	echo "<a href='".site_url('guest/exam/'.$info[0]->exam_id)."' class='btn-guest btn btn-warning btn-sm hidden' data-title='This will only save your result for 30 days.'>Continue as guest</a>";
}

 ?>

 <script type="text/javascript">
 	var showBtn_Guest = false;
 	$('#btn-try').on('mouseover	',function(){
 		$(this).notify($(this).data('title'),{ position:"top left", className:"success" });

 		return false;
 	})
 		$('#btn-try').on('mouseout',function(){

  		$('.notifyjs-wrapper').trigger('notify-hide');

 		return false;
 	})
 		$('.btn-guest').on('mouseover	',function(){
 		$(this).notify($(this).data('title'),{ position:"top left", className:"success" });

 		return false;
 	})
 		$('.btn-guest').on('mouseout',function(){

  		$('.notifyjs-wrapper').trigger('notify-hide');

 		return false;
 	})
 		$('#btn-try').on('click',function(){

  			var is_login = false;
  			 <?php if ($this->permission->is_loggedin()): ?>
  			 	is_login = true;
  			 <?php endif ?>
  			 if(is_login == true){
  			 	showBtn_Guest = false;
  			 	window.location = '<?php echo site_url("/exam/take_exam/".$info[0]->exam_id);?>';
  			 }else{

 				$(this).notify('Please login to continue...',{ position:"top left", className:"error" });
 				if(is_login == false && showBtn_Guest == false){
 				$('.btn-guest').removeClass('hidden');
 				}
  			 }
 		return false;
 	})
 </script>