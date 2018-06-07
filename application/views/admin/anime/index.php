<div class="col-md-12">
	<form class="form from-horizontal" id="frmsearch"method="post" action="" >
				<div class="form-group">                     
				<label>Search video</label>
				<input type="text" id="q" name="q" class="form-control" required/>
				</div>

				<div class="form-group">
					<label></label>
					<input type="submit" id="btnsearch" name="btnsearch" class="btn btn-info btn-sm" style="border-radius:0;margin:0;" value="Search" />
				</div>
				<div class="form-group list-video">
					<ul id="list_here"></ul>
					
				</div>
			</form>

</div>


<script type="text/javascript">
	

	$('#q').on('keyup',function(){

		var search = $(this).val();
		if(search.trim().length == 0){
				$(this).val('');
			}
		if(search.trim().length < 3){
			
			return false;
		}

	});

	$('#frmsearch').on('submit',function(){
		var frmdata = $(this).serialize();
		var q = $('#q').val();
		$('#list_here').html('');
		console.clear();
		$.ajax({
			data:frmdata,
			url:'./video/search',
			dataType: 'json',
			type: 'post',
			success: function(resp){
				console.log(resp);
				if(resp.stats == true){
					var n = 0;
					var v = resp.msg;
					$.each(v, function(i) {

			           		$('#list_here').append('<li><a href="video/info/'+v[i].video_id+'">'+v[i].title+'</a></li>')
			           		
			           
			            n++;
			          });
					$('#list_here').append('<li>Not in the list? <a href="javascript:void(0)" onclick="showform(\''+q+'\')">Click to add as new video</a></li>');
				}else{
					$('#list_here').append('<li>Not in the list? <a href="javascript:void(0)" onclick="showform(\''+q+'\')">Click to add as new video</a></li>');
					//$('.list-video').append('')
				}
			}
		});
		return false;
	});

	

</script>