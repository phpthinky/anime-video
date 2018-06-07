
<table class="table table-bordered">
	<thead>
		
	<tr>
		<th>Date added</th>
		<th>Exam title</th>
		<th>Category</th>
		<th>Total exam</th>
		<th>Shuffle Choices</th>
		<th>Status</th>
		<th></th>
	</tr>
	</thead>	<tbody>
<?php if (isset($lists) && is_array($lists)): ?>
	<?php $i=0; foreach ($lists as $key ): ?>
		<?php 

		//print_r($lists);exit();
		$i++;
		$added_q = 0;
		

		 	$choices = 'No';
		if ($key->shuffle_choices == 1) {
		 	$choices = 'Yes';
		 }

		 	$questions = 'No';
		if ($key->suffle_questions == 1) {
		 	$questions = 'Yes';
		 }
		 $Status = '<button class="btn btn-warning btn-sm btn-publish" data-status="0" data-exam="'.$key->quizes_id.'" style="width:55px;border-radius:0;">Draft</button>';
		if ($key->status == 1) {
		 	$Status = '<button class="btn btn-success btn-sm btn-publish" data-status="1" data-exam="'.$key->quizes_id.'" style="width:55px;font-size:10px;border-radius:0;">Published</button>';
		 }

		  ?>
	<tr id="tr_<?=$key->quizes_id ?>">
		<td width="100px"><?=date('Y-m-d',strtotime($key->date_posted)) ?></td>
		<td><?=$key->quizes_title ?></td>
		<td><?php if(!empty($key->category_names)){ echo implode(', ', $key->category_names);}else{echo "None";}?></td>
		<td  width="100px"><?=isset($key->exam_total) ? $key->exam_total : 0;?></td>
		<td  width="130px"><?=$choices ?></td>
		<td  width="80px"><?=$Status ?></td>
		<td width="120px"><a href="<?=site_url("quiz/take_exam/$key->quizes_id"); ?>"><i class="fa fa-briefcase btn" style="color:green;" title="Take this exam"></i></a> <a href="<?=site_url("quiz/edit/$key->quizes_id"); ?>"><i class="fa fa-edit btn" title="Edit exam"></i></a> <i class="fa fa-remove btn"  style="color:red;"  onclick="removeExam(<?=$key->quizes_id ?>);" title="Drop this exam"></i></td>
	</tr>
	<?php endforeach ?>
<?php endif ?>

	</tbody>
</table>


<script type="text/javascript">
	
	function editExam(examid){
		window.location = '<?=site_url("quiz/edit/")?>'+examid;
	}
	function testExam(examid){
		window.location = '<?=site_url("quiz/take_exam/")?>'+examid;
	}
	function removeExam(examid){
		//alert(examid);
		var data = 'quizes_id='+examid;
		 $.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("quiz/removeExam"); ?>',
      dataType: 'json',

      success: function(resp){
         console.log(resp);
         if (resp.stats ==  true) {

          $('.user-profile').notify(resp.msg, { position:"bottom right", className:"success" }); 

          $('#tr_'+examid).remove();

         }else{

                  $('.user-profile').notify('Error! '+resp.msg, { position:"bottom right", className:"error" }); 
              }
      }

    });
	}
</script>

<script type="text/javascript">
	$('.btn-publish').on('click',function(){
		var data_status = $(this).data('status');
		var exam_id = $(this).data('exam');
		//console.log(exam_id);
	/**/
	         if(data_status == 0){
          		$(this).html('Published').data('status',1).css('font-size',10+'px').removeClass('btn-warning').addClass('btn-success');

          	}else{
          		$(this).html('Draft').data('status',0).css('font-size',12+'px').removeClass('btn-success').addClass('btn-warning');

          	}

	$.ajax({

      type: 'post',
      data: 'status='+data_status+'&exam_id='+exam_id,
      url: '<?=site_url("quiz/publishexam"); ?>',
      dataType: 'json',

      success: function(resp){
         //console.log(resp);
         if (resp.stats ==  true) {



          $('.user-profile').notify(resp.msg, { position:"bottom right", className:"success" }); 
          
          	
         }else{

                  $('.user-profile').notify('Error! '+resp.msg, { position:"bottom right", className:"error" }); 
              }
      }

    });
    
		return false;
	});
</script>