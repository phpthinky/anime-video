
<table class="table table-bordered">
	<thead>
		
	<tr>
		<th>#</th>
		<th>Question</th>
		<th>Answer</th>
		<th>Category</th>
		<th></th>
	</tr>
	</thead>	<tbody>
<?php if (isset($lists) && is_array($lists)): ?>
	<?php foreach ($lists as $key ): ?>
	<tr>
		<td><?=$key->post_id?></td>
		<td><?=$key->post_question ?></td>
		<td><?=$key->post_answer ?></td>
		<td><?=$key->cat_name ?></td>
		<td width="80px"><i class="fa fa-edit btn"></i> <i class="fa fa-remove btn"></i></td>
	</tr>
	<?php endforeach ?>
<?php endif ?>

	</tbody>
</table>