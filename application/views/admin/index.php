<div class="col-md-12">
	<div class="panel">
	<div class="panel-heading"><h3>ADMINISTRATION DASHBOARD</h3></div>
		<div class="panel-body">
			<h4>Quic link</h4>
			<ul class="quick-link">
				<li><a href="livechart/restart">Restart live chart</a></li>
			</ul>
		</div>
		<div class="panel-body">
		<h4>Viewer statistics</h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Title</th>
						<th>Views</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1; foreach ($statistics as $key): ?>
					
					<tr>
						<td><?=$i?>) <a href="<?=site_url('video/info/'.$key->video_id);?>"><?=$key->title?></a></td>
						<td><?=$key->counter?></td>
					</tr>
				<?php $i++; endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>