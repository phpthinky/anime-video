<div class="post-index">
<div class="col-md-12">
<style type="text/css">
	
</style>
	<?php if ($ratings): ?>
		<h2><?=$ratings[0]->quizes_title?></h2>
	<?php endif ?>
	<div class="form-responsive">
		<form class="form form-horizontal" action="<?=base_url($_SERVER['REQUEST_URI'])?>" method="get">
			<div class="col-md-6">
			<div class="form-group">
				<select class="form-control" id="r" name="r">
					<option value="result">Result</option>
					<option value="date_taken">Date</option>
				</select>
			</div>
		</div>
			<div class="col-md-5"><div class="form-group">
				<select class="form-control" id="d" name="d">
					<option value="Desc">Descending</option>
					<option value="Asc">Ascending</option>
				</select>
			</div>
		</div>
		<div class="col-md-1">
			
			<div class="form-group">
				<button class="btn btn-info" type="submit" style="width:100%;">SORT</button>
			</div>
		</div>
			
		</form>
	</div>
</div>
<div class="col-md-12">
	
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Date taken</th>
			<th>Time taken</th>
			<th>Results</th>
			<th></th>
		</tr>
	</thead>
<?php foreach ($ratings as $key): ?>
	<?php //print_r($key);?>
	<tr>
		<td><?=date('F d Y',strtotime($key->date_taken)) ?></td>
		<td><?=date('H:i:s',strtotime($key->date_taken)) ?></td>
		<td><?=$key->result ?></td>
		<td></td>
	</tr>
<?php endforeach ?></div>
</table>

</div>
	
<br>
<br>