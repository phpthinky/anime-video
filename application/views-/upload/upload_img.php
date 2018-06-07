<div class="col-md-12">
	<div class="panel">
		<div class="panel-body">
		<form class="form" action="<?=site_url('files/test_upload');?>" method="post" onsubmit="return false" id="frmupload" enctype="multipart/form-data">
				<input type="file" name="file" id="uploadfile" class="btn alert-info" />
				<button type="SUBMIT" class="btn btn-default">Upload</button>
		</form>
				<br />
				<br />
	<div id="progressbox">
	<div id="progressbar"></div>
	<div id="progress">0%</div>
		
	</div>
	<div id="ouput"></div>
	<h3 id="status"></h3>
	<p id="loaded_n_total"></p>
		</div>
	</div>
</div>


<script type="text/javascript">
	/*
	function test_uploadFile(){
		//alert('Greate');return false;
		var file = $("#uploadfile")[0].files[0];
		var formdata = new FormData();
		formdata.append("uploadfile",file);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress",progressHandler,false);
		ajax.addEventListener("load",completeHandler,false);
		ajax.addEventListener("error",errorHandler,false);
		ajax.addEventListener("abort",abortHandler,false);
		ajax.open("Post", '<?=site_url("file/test_upload");?>');
		ajax.send(formdata);

	}
	function progressHandler (event) {
		// body...
		$("#loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		var percent = (event.loaded/event.total) * 100;
		$("#progressBar").value = Math.round(percent);
		$("#status").innerHTML = Math.round(percent) + "% Uploaded... please wait";
	}
	function completeHandler (event) {
		// body...
		$("#status").innerHTML = event.target.responseText;
		$("#progressBar").value = 0;


	}
	function errorHandler (event) {
		// body...
		$("#status").innerHTML = "Upload failed!";
	}

	function abortHandler (event) {
		// body...
		
		$("#status").innerHTML = "Upload failed!";
	}*/
</script>
<!-- script type="text/javascript" src="<?=base_url('assets/js/jquery-3.2.1.min.js');?>"></script -->
<script type="text/javascript" src="<?=base_url('assets/js/jquery.form.min.js');?>"></script>
<script type="text/javascript">

		var progressbox = $('#progressbox');
		var progressbar = $('#progressbar');
		var progress = $('#progress');
		var completed = "0%";
	$(function(){

		var options = {
		beforeSubmit:beforeSubmit,
		uploadProgress:onProgress,
		success:afterSuccess,
		resetForm:true
		}
		$('#frmupload').on('submit',function(){
			$(this).ajaxSubmit(options);
			//alert('gret');
			return false;
		});
	});
	function beforeSubmit () {
		// body...
		if (!$('#uploadfile').val()) {
			$('#ouput').html('Please select any file!!!');
			return false;
		}
		progressbar.width(completed);
		progress.html(completed);
	}
	function onProgress (event,position,total,percentComplete) {
		// body...
		progressbar.width(percentComplete + '%');
		progress.html(percentComplete + '%');
	}
	function afterSuccess () {
		// body...
		$('#ouput').html('Completed!!');
	}

</script>
