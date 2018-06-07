<div class="wrapper admin-wrapper create">

<div class="panel">
	<div class="panel-heading"><h4>List pages</h4></div>
	<div class="panel-body">
		<div class="form-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>PAGE TITLE</th>
						<th>SITE NAME</th>
						<th></th>
					</tr>

				</thead>
				<tbody>
					<?php if (!empty($list_pages)): ?>
						<?php foreach ($list_pages	as $key): ?>
							
					<tr id="tr-<?=$key->page_id?>">
						<td><?=$key->page_id?></td>
						<td><?=$key->page_title?></td>
						<td><?php echo $this->site_m->getSiteName(false,$key->site_id)[0]->site_name;?></td>
						<td width="100px"><a href="<?=site_url('pages/edit_page/'.$key->page_id)?>" class="btn"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="btn" onclick="remove_page(<?=$key->page_id?>)"><i class="fa fa-remove"></i></a></td>
					</tr>

						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</div>

<script type="text/javascript">
		function remove_page(page_id){

				$.ajax({
						type: 'post',
						url: '<?=site_url("pages/remove_page");?>',
						data: 'page_id='+page_id,
						dataType:'html',
						success: function(response){
							console.clear();
							console.log(response);	

							$('#tr-'+page_id).remove();
		             		$('header').notify('Post successfully remove', { position:"bottom right", className:"success" }); 



						}
					});
	}

</script>