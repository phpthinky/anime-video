	<div class="panel panel-info  Statitics">
		<div class="panel-heading"><h4>Statitics</h4></div>
	
	<div class="panel-body">
	<div class="col-md-4">
		<div class="alert alert-danger">
			New Messages	<i class="fa fa-envelope"></i> 0
		</div>
		
	</div>
	<div class="col-md-4">
		<div class="alert alert-danger">
		Comments <i class="fa fa-comment"></i> 0
		</div>
		
	</div>
	<div class="col-md-4">
		<div class="alert alert-danger">Total posts <i class="fa fa-book"></i> <?=isset($total_post) ? $total_post : 0;?></div>
		
	</div>
	<div class="col-md-4">
		<div class="alert alert-success">Total Visits <i class="fa fa-eye"></i> <?=isset($total_visitors) ? $total_visitors : 0;?> </div>
		
	</div>
	<div class="col-md-4">
		<div class="alert alert-success">Today Visits <i class="fa fa-eye"></i> <?=isset($today_visit) ? $today_visit : 0;?> </div>
		
	</div>
	<div class="col-md-4">
		<div class="alert alert-success">Unique Visits <i class="fa fa-eye"></i> <?=isset($unique_visitors) ? $unique_visitors : 0;?> </div>
		
	</div>
	</div>

	</div>
		<div class="panel panel-info chart">
		<div class="panel-heading"><h4>Graphical View</h4></div>
	
	<div class="panel-body">
	<div class="col-md-12">
		<div class="sub-chart" id="visitchart"></div>
		
	</div>
	</div>

	</div>

	<script>
		$(function () {
		    $('#visitchart').highcharts({
		        chart: {
		            type: 'line'
		        },
		        title: {
		            text: 'Weekly visitors'
		        },
		        subtitle: {
		            text: 'Source: <?=site_url();?>'
		        },
		        xAxis: {
		            categories: <?php echo isset($day) ? json_encode($day) : 0;?>,
		            crosshair: true
		        },
		        yAxis: {
		            min: 0,
		            title: {
		                text: 'Total Visitor'
		            }
		        },
		        plotOptions: {
		            column: {
		                pointPadding: 0.2,
		                borderWidth: 0
		            }
		        },
		        series: [{
		            name: 'Visits',
		            data: <?php echo  isset($visit) ?json_encode($visit) : 0; ?>
		        }]
		    });

		});
	</script>