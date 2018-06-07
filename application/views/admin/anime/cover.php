<div class="panel panel-info">
<div class="panel-heading"><h3>Cover page</h3></div>
	<div class="panel-body">

	<?php // var_dump($cover_page);exit(); ?>
		<form class="form" method="post" action="../save_cover">
		<div class="col-md-4">
			<div class="form-group">
			<div class="hidden">
				<input type="hidden" name="video_id" id="video_id" value="<?=$video_id ?>">
				<input type="hidden" name="cover_thumbnail" id="cover_thumbnail" value="<?=isset($cover_page->thumbnail) ? $cover_page->thumbnail : (isset($video_info->thumbnail) ? $video_info->thumbnail : '' ) ; ?>">
			</div>
				<label class="title">Cover Photo <a class="btn" href="#" data-toggle="modal" data-target="#modalupload"><i class="fa fa-camera"></i></a></label>
				<?php if(isset($cover_page->thumbnail)): ?>

				<img class="previewimg" src="<?=$cover_page->thumbnail ?>" style="width:100%;"></img>
				<?php else:  ?>
					<?php if (isset($video_info->thumbnail)): ?>
						<img  class="previewimg"  src="<?=$video_info->thumbnail?>"  style="width:100%;">
						<?php else: ?>
						<img class="previewimg" src="<?=base_url('public/images/default-img.jpg')?>" style="width:100%;"></img>
					<?php endif ?>
				<?php endif ?>

			</div>

			<div class="col-md-12"><label>Countdown</label> - <span class="countdown"  value='<?=isset($cover_page->expired_on) ? $cover_page->expired_on : "2018/06/12 10:00";?>'></span></div>
		
		</div>

		<div class="col-md-8">
			<div class="form-group">
				<label class="title">Title</label>
				<input type="text" name="cover_title" id="cover_title" class="form-control" value="<?=isset($cover_page->cover_title) ? $cover_page->cover_title : (isset($video_info->title) ? $video_info->title : '' ) ;?>">
			</div>

			<div class="form-group">
				<label class="title">Synopsis</label>
				<textarea class="form-control" name="cover_synopsis" id="cover_synopsis" rows="8"><?= isset($cover_page->synopsis) ? $cover_page->synopsis : (isset($video_info->sypnosis) ? $video_info->sypnosis : '' ) ; ?></textarea>
			</div>

			<div class="form-group">
				<label class="title">Genre</label>
				<textarea class="form-control" name="cover_genre" id="cover_genre" rows="8"><?= isset($cover_page->genre) ? $cover_page->genre : '' ; ?></textarea>
			</div>

			<div class="form-group">
				<label class="title">Release date</label>
				<input type="text" name="release_date" id="release_date" placeholder="2018/06/05" class="form-control" style="width:200px;display:inline-block;" value="<?=isset($cover_page->released_date) ? date('Y/m/d',strtotime($cover_page->released_date)) : "2018/06/12";?>">
				<input type="text" name="release_time" id="release_time" placeholder="12:00:00" class="form-control" style="width:100px;display:inline-block;" value="<?=isset($cover_page->released_date) ? date('h:m:s',strtotime($cover_page->released_date)) : "12:00:00";?>"> 
			</div>

			<div class="form-group">
				<label class="title">Expired date</label>
				<span class="form-control"  id="sexpired_date" style="width:200px;display:inline-block;"><?=isset($cover_page->released_date) ? date('Y/m/d',strtotime($cover_page->released_date)) : "2018/06/12";?></span>
				<span class="form-control"  id="sexpired_time"  style="width:100px;display:inline-block;"><?=isset($cover_page->released_date) ? date('h:m:s',strtotime($cover_page->released_date)) : "12:00:00";?></span>
				<input  type="hidden"  id="expired_date"  name="expired_date" placeholder="2018/06/12" class="form-control" style="width:200px;display:inline-block;" value="<?=isset($cover_page->released_date) ? $cover_page->released_date : "2018/06/12";?>">
				<input  type="hidden"  id="expired_time"  name="expired_time"placeholder="12:00:00" class="form-control" style="width:100px;display:inline-block;"> 
			</div>

			<div class="form-group">
				<label class="title">End of season</label>
				<input type="text" name="ending_date" id="ending_date" placeholder="2018/06/05" class="form-control" style="width:200px;display:inline-block;" value="<?=isset($cover_page->end_of_season) ? date('Y/m/d',strtotime($cover_page->end_of_season)) : "2018/06/12";?>">
				<input type="text" name="ending_time" id="ending_time" placeholder="12:00:00" class="form-control" style="width:100px;display:inline-block;" value="<?=isset($cover_page->end_of_season) ? date('h:m:s',strtotime($cover_page->end_of_season)) : "12:00:00";?>"> 
			</div>
			
			<div class="form-group">
				<label class="title">&nbsp;</label>
				<button class="btn btn-info" id="btnsave"><i class="fa fa-save"></i> Update</button>
			</div>
		</div>
			

		</form>
	</div>
</div>

<div class="modal" id="modalupload" role="dialog" style="min-width:355px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h4>Upload cover</h4>
			</div>
			<div class="modal-body">
				<p>
					<input class="btn alert-info" type="file" id="cover" name="cover">
					<br/>
					<input type="text" id="cover_url" name="cover_url" class="form-control">
					<br />
					<button class="btn btn-info" id="btnupload">Upload</button>
					<div class="loader pull-right hidden" style="margin-top:-50px;"></div>


				</p>
			</div>
		</div>
	</div>
</div>

  <script src="<?=base_url('public/assets/plugin/jquery.countdown-2.2.0/jquery.countdown.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
	$('#cover_url').on('blur',function(){
		var url = $(this).val();
		if(url.length <= 0){
			return false;
		}
		$(this).val('');
				var img = $('.previewimg');
				
				img.attr('src',url);
				$('#cover_thumbnail').val(url);

				$('#modalupload').modal('hide');

	});
	$('#btnupload').on('click',function(){

		$(this).attr('disabled',true);
		$('.loader').removeClass('hidden');
		var cover = $('#cover');
		if(cover[0].files[0] !=  undefined){

			var file = cover[0].files[0];
			var frmdata = new FormData();
			frmdata.append('upload',file);
			frmdata.append('type','images');


	$.ajax({
		data: frmdata,
		type:'post',
		dataType:'json',
				processData: false,
				contentType: false,
		url: '<?php echo site_url("video/upload")?>',
		success: function(resp){
			console.log(resp);
			if(resp.stats == true){
				var img = $('.previewimg');
				img.attr('src',resp.msg);
				$('#cover_thumbnail').val(resp.msg)
				$('#modalupload').modal('hide');
				$('#cover_url').val(resp.msg);
			}
			$('.loader').addClass('hidden');
			$('#btnupload').attr('disabled',false);
		}
	});
			
		}
	})


	$(function(){
	$('.countdown').each(function(){
		$(this).countdown($(this).attr('value'), function(event) {
    	$(this).text(
      	event.strftime('%D days %H:%M:%S')
      );
		});
	});
	});

var tosubmit = true;

$('form').on('submit',function(){
	if(tosubmit == false){
		return false;
	}
});
$('#release_date').on('blur',function(){
	var dd = $(this).val();
	if(dd.length <= 0){
		return false;
	}
	var xp = covertdate(dd);


	if(xp == 'NaN/NaN/NaN'){
		//alert('Invalid time.')
		$(this).notify('Invalid date.',{position:'top right',className:'error'});
		$(this).focus();

		tosubmit = false;
		return false;
	}

		tosubmit = true;

	//console.log(expired_date);
	$('#expired_date').val(xp); 
	$('#sexpired_date').html(xp); 
})

$('#release_time').on('blur',function(){
	var dd =$('#release_date').val()
	var tt = $(this).val();
	if(tt.length <= 0){
		return false;
	}
	var dt = dd + ' ' + tt;
	
	var xt = convertime(dt);
	//console.log(xt);

	if(xt == 'NaN:NaN:NaN'){
		//alert('Invalid time.')
		$(this).notify('Invalid time.',{position:'top right',className:'error'});
		$(this).focus();

		tosubmit = false;
		return false;
	}

		tosubmit = true;
	$('#expired_time').val(xt); 
	$('#sexpired_time').html(xt); 

	//var nxt = xt.toUTCString();

	//console.log(xt)

	$('.countdown').attr('value', dt + ' ' + xt);
	});
function covertdate (tt) {
	// body...

	//var tt = document.getElementById('release_date').value;

    var date = new Date(tt);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + 7);

    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();



	if(mm.toString().length < 2){
		mm = '0'+mm;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	if(dd.toString().length < 2){
		dd = '0'+dd;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}


    var someFormattedDate = y + '/' + mm + '/' + dd;
    return someFormattedDate;
}

function convertime (tt) {
	// body...
	date = new Date(tt);

	// hours part from the timestamp
	var hours = date.getHours();

	// minutes part from the timestamp
	var minutes = date.getMinutes();

	// seconds part from the timestamp
	var seconds = date.getSeconds();

	// will display time in 10:30:23 format

	if(hours.toString().length < 2){
		hours = '0'+hours;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	if(minutes.toString().length < 2){
		minutes = '0'+minutes;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	if(seconds.toString().length < 2){
		seconds = '0'+seconds;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	var formattedTime =  hours + ':'  + minutes + ':' + seconds;
	//}
	//console.log(formattedTime);
	return formattedTime;
}

window.onload = function(){
	$('#release_date').blur();
	$('#release_time').blur();
}
</script>