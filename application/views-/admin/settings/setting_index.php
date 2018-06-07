<div class="wrapper admin-wrapper create">

<div class="panel">
	<div class="panel-heading"><h4>Site Settings</h4></div>

	<div class="panel-body">
		
      <div class="form-group">


          <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#welcome" id="li_pdf">About</a></li>
          <li><a data-toggle="tab" href="#header" id="li_photo">Services</a></li>
        </ul>


        <div class="tab-content">
          <div id="welcome" class="col-md-12 tab-pane fade in active">
            <div class="panel">
              <div class="panel-heading"><h3>About</h3></div>
              <div class="panel-body">

              	<div class="form-responsive form-about hidden" >
              		<form class="form form-horizontal">

              			<div class="form-group">
              				<div class="col-md-6">
              					<label>Site name</label>
              				<select class="form-control" id="option-about" name="option-about">
		              					
							<?php if (isset($hosted_site)): ?>
								<?php foreach ($hosted_site as $key): ?>
									
							<option value="<?=$key->site_id?>"><?=$key->site_name?></option>
								<?php endforeach ?>
							<?php endif ?>
              					
              					<?php
              					?>
              				</select>
              				</div>
              				
              				<div class="col-md-6">
              					
              					<label>Setting name</label>
              				<select class="form-control" id="option-about" name="option-about">
              					<option>Select</option>
              					
              					<?php
              					?>
              				</select>

              				</div>
              				
              			</div>
              			<div class="form-group">
              				<div class="col-md-12">
              					
              				<label>Content</label><textarea id="desc" name="desc" class="form-control" rows="12">
              					
              				</textarea>

              				</div>
              			</div>

              			<div class="form-group">
              				
              				<div class="col-md-12">
              					
              				<label></label><button class="btn btn-success">Publish</button> <button class="btn btn-warning pull-right">Unpublish</button>
              					
              				
              				</div>
              			</div>
              		</form>
              	</div>
              	<div class="row">
              		<table class="table table-hover">
              			<tr>
              				<th>ID</th> 
              				<th>Setting name</th>
              				<th>Site</th>
              				<th>Action	</th>
              			</tr>
              			<tbody>
              				<?php if (is_array($about_settings)): ?>
              					
              				<?php foreach ($about_settings as $key): ?>
              					
              				<tr>
              					<td><?=$key->id;?></td>
              					<td><?=$key->setting_name?></td>
              					<td><?php echo $this->site_m->getSiteName(false,$key->site_id)[0]->site_name;?></td>
              					<td><i class="fa fa-edit"></i></td>
              				</tr>
              				<?php endforeach ?>

              				<?php endif ?>
              			</tbody>
              		</table>
              	</div>



              </div>
            </div>
          </div>

            <div id="header" class="col-md-12 tab-pane fade">
                <div class="panel">
              <div class="panel-heading"><h3>Services</h3></div>
              <div class="panel-body">

              	<div class="form-responsive form-about hidden" >
              		<form class="form form-horizontal">

              			<div class="form-group">
              				<div class="col-md-6">
              					<label>Site name</label>
              				<select class="form-control" id="option-about" name="option-about">
		              					
							<?php if (isset($hosted_site)): ?>
								<?php foreach ($hosted_site as $key): ?>
									
							<option value="<?=$key->site_id?>"><?=$key->site_name?></option>
								<?php endforeach ?>
							<?php endif ?>
              					
              					<?php
              					?>
              				</select>
              				</div>
              				
              				<div class="col-md-6">
              					
              					<label>Setting name</label>
              				<select class="form-control" id="option-about" name="option-about">
              					<option>Select</option>
              					
              					<?php
              					?>
              				</select>

              				</div>
              				
              			</div>
              			<div class="form-group">
              				<div class="col-md-12">
              					
              				<label>Content</label><textarea id="desc" name="desc" class="form-control" rows="12">
              					
              				</textarea>

              				</div>
              			</div>

              			<div class="form-group">
              				
              				<div class="col-md-12">
              					
              				<label></label><button class="btn btn-success">Publish</button> <button class="btn btn-warning pull-right">Unpublish</button>
              					
              				
              				</div>
              			</div>
              		</form>
              	</div>
              	<div class="row">
              		<table class="table table-hover">
              			<tr>
              				<th>ID</th> 
              				<th>Setting name</th>
              				<th>Site</th>
              				<th>Action	</th>
              			</tr>
              			<tbody>
              				<?php if (is_array($services_settings)): ?>
              					
              				<?php foreach ($services_settings as $key): ?>
              					
              				<tr>
              					<td><?=$key->id;?></td>
              					<td><?=$key->setting_name?></td>
              					<td><?php echo $this->site_m->getSiteName(false,$key->site_id)[0]->site_name;?></td>
              					<td><i class="fa fa-edit"></i></td>
              				</tr>
              				<?php endforeach ?>

              				<?php endif ?>
              			</tbody>
              		</table>
              	</div>



              </div>
            </div>
            </div>

            
            </div>

      </div>

	</div>
</div>
</div>

<script type="text/javascript">
	
$('#desc').summernote({

minHeight: 250,
            toolbar: [
                ['fontsize', ['bold', 'italic', 'fontsize']],
                ['style', ['highlight','underline', 'clear','color']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['paragraph','ul', 'ol',]],
                ['height', ['height']],
                ['insert', ['picture','link']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
});

</script>