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
						
						/* initialize the external events
						-----------------------------------------------------------------*/
						function ini_events(ele) {
							ele.each(function() {

								// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
								// it doesn't need to have a start or end
								var eventObject = {
									title: $.trim($(this).text()) // use the element's text as the event title
								};

								// store the Event Object in the DOM element so we can get to it later
								$(this).data('eventObject', eventObject);

								// make the event draggable using jQuery UI
								$(this).draggable({
									zIndex: 1070,
									revert: true, // will cause the event to go back to its
									revertDuration: 0  //  original position after the drag
								});

							});
						}
						
						ini_events($('#external-events div.external-event'));

						/* initialize the calendar
						 -----------------------------------------------------------------*/
						var date = new Date();
						var d = date.getDate(),
								m = date.getMonth(),
								y = date.getFullYear();
						$('#calendar').fullCalendar({
							header: {
								left: 'prev,next today',
								center: 'title',
								right: 'month,agendaWeek,agendaDay'
							},
							buttonText: {
								today: 'today',
								month: 'month',
								week: 'week',
								day: 'day'
							},
							buttonIcon:{
								prev: 'left-single-arrow',
								next: 'right-single-arrow'
							},
							events: [
							<?php
								foreach($appointments as $appointment){
									echo "{title: '".$appointment->firstname." ".$appointment->lastname.": ".$appointment->subject."', start: new Date('".$appointment->start_date."'),end: new Date('".$appointment->end_date."')},";
								}
							?>
								/*{
									title: 'All Day Event',
									start: new Date(y, m, 1),
									backgroundColor: "#f56954", //red
									borderColor: "#f56954" //red
								}*/
								

							],
							editable: false
						});

					});
				</script>
			</div>
		</div>
		
</div>