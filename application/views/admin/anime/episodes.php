<div class="col-md-12">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Episode</th>
				<th>Parent ID</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($episodes as $key): ?>
				<tr>
					<td><?=$key->video_id?></td>
					<td><?=$key->title?></td>
					<td><?=$key->episode_number?></td>
					<td class="parent_id" id="parent_id_<?=$key->episode_number?>" name="parent_id[]" contentEditable="true" onkeyup="update_parent(this)"><?=$key->parent_video_id?></td>
				</tr>
			<?php endforeach ?>
			<tr><td colspan="3"></td><td><a id="update" href="javascript:void(0)" class="btn btn-sm"><i class="fa fa-edit"></i> Update</a></td></tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">

	var parent_id = 0;
	var parent = <?=$parent?>;
	$('.parent_id').on('blur',function(){
		$('.parent_id').html(parent_id);
	});
	function update_parent(e){
		parent_id = $(e).text()
	}
	$('#update').on('click',function(){
		var data = 'parent_video_id='+parent_id+'&parent='+parent;
			$.ajax({
			url: '<?=site_url("video/changeParent")?>',
			data: data,
			type: 'post',
			dataType:'json',
			success: function (res) {
				// body...
				console.log(res)
				if(res.stats== true){
					alert('Request proccessed.');
				}else{
					alert('Request not proccess.');
				}
			}
		})
	})
</script>