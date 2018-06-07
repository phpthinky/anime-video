<div class="container">

		<h1>Uploader</h1>
		<hr>
		<form action="#">
			<div class="form-group">

			<input type="file" name="image" class="btn alert-default"  accept="image/gif, image/jpeg, image/png"  onChange="readURL(this);" >
			<button class="btn btn-sm btn-info upload" type="submit" id="upload">Upload</button>
			<button type="button" class="btn btn-sm btn-danger cancel">Cancel</button>
				
			</div>


			<div class="progress progress-striped active" style="width:50%">
				<div class="progress-bar" style="width:0%;"></div>
			</div>

        		<div class="form-group" style="max-width:400px;">
        			<label>Preview</label><br><img src="" id="previewImg" class="hidden" style="width:100%;">
        			<input type="hidden" id="isselected" value="0">	
        		</div>
		</form>
</div>

<script type="text/javascript">
	$(document).on('submit','form',function(e){
			e.preventDefault();

			$form = $(this);

              var selected = $('#isselected').val();
			//console.log(input.files[0])
			if (selected > 0) {

			uploadImage($form);
			}

		});
		function readURL(input) {

		 if (!window.FileReader) {
        alert("Oops! This browser isn't supported yet. Please use higher browser to continue.");
        return false;
    	}
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewImg')
                	.removeClass('hidden')
                    .attr('src', e.target.result)
                    .width('70%')
                    .height('70%');
                   $('#isselected').val(1);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


		function uploadImage($form){
			$form.find('.progress-bar').removeClass('progress-bar-success')
										.removeClass('progress-bar-danger');

			var formdata = new FormData($form[0]); //formelement
			if (window.XMLHttpRequest){
			        xmlhttp=new XMLHttpRequest();
			    }else{
			        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			    }

			var request = new XMLHttpRequest();

			//progress event...
			request.upload.addEventListener('progress',function(e){
				var percent = Math.round(e.loaded/e.total * 100);
				$form.find('.progress-bar').width(percent+'%').html(percent+'%');
			});

			request.open('post', 'http://www.colof.tech:8000/index.php/files/test_upload');
			request.send(formdata);
				request.onreadystatechange = function() {
								

								request.addEventListener('load',function(e){


								        if(request.readyState == 4 && request.status == 200) {
								        	
								        	var data = JSON.parse(request.responseText);
								        	console.clear();
								        	console.log(data);
								        	if(data.stat == true ){

												$form.find('.progress-bar').addClass('progress-bar-success').html(data.msg);

													$('input').val('');// =true;



								        	}else{
								        		request.abort();

													$form.find('.progress-bar')
														.addClass('progress-bar-danger')
														.removeClass('progress-bar-success')
														.html(data.msg);
												
								        	}

								        }else{
								        		request.abort();


													$form.find('.progress-bar')
														.addClass('progress-bar-danger')
														.removeClass('progress-bar-success')
														.html(request.responseText.msg);
								        }
								});
				}

			$form.on('click','.cancel',function(){
				request.abort();

				$form.find('.progress-bar')
					.addClass('progress-bar-danger')
					.removeClass('progress-bar-success')
					.html('upload aborted...');
			});

		}
</script>