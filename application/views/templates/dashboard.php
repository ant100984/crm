<div class="row">
	<div class="col-md-7">
		<div class="box box-primary">
			<div class="box-body no-padding">
				<!-- THE CALENDAR -->
				<div id="calendar"></div>
			</div><!-- /.box-body -->
		</div><!-- /. box -->
	</div><!-- /.col -->
	<div class="col-lg-5 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>
					<?php echo $num_paid_policies; ?>
				</h3>
				<p>
					Paid Policies
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
		</div><!-- ./col -->
		<div class="col-lg-5 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3>
						<?php echo $num_unPaid_policies; ?>
					</h3>
					<p>
						Unpaid Policies
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="#" class="small-box-footer">
					More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div><!-- ./col -->
		
		<div class="col-lg-5">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Paid Policies per month</h3>
				</div>
				<div class="box-body chart-responsive">
					<div class="chart" id="line-chart" style="height: 300px;"></div>
				</div>
				<script type="text/javascript">
					
					$(function() {
						
						var line = new Morris.Line({
							element: 'line-chart',
							resize: true,
							data: [
							<?php
							
								foreach($paid_policies_per_month as $entry){
									echo "{month_paid:'".$entry->month_paid."', num_policies: ".$entry->num_policies."},";
								}
								
							?>
							],
							xkey: 'month_paid',
							ykeys: ['num_policies'],
							labels: ['Paid policies'],
							xLabels: 'month',
							lineColors: ['#3c8dbc'],
							hideHover: 'auto'
						});
						
					});
				</script>
			</div>
		</div>
	</div>
</div>