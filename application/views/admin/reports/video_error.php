
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Video title</th>
			<th>Source</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		
<?php if (isset($brokenlink) && is_array($brokenlink)): ?>
	<?php foreach ($brokenlink as $key): ?>
		<tr>
			<td><a href="<?=site_url('video/info/'.$key->video_id)?>"><?=$key->title?></a></td>
			<td><?php echo $this->auto_m->mirror($key->source_id); ?></td>
			<td><?=$key->reports?></td>
		</tr>
	<?php endforeach ?>
<?php endif ?>
	</tbody>
</table>