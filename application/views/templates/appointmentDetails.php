<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Create Appointment</h3>
			</div>
			<div class="box-body">
				<form method="post" action="<?php echo base_url(); echo "/index.php/appointments/saveAppointment"; ?>">
					<input type="hidden" name="appointment_id" id="appointment_id" value="<?php if(!empty($loaded_appointment->id)) echo $loaded_appointment->id; ?>"/>
					<div class="form-group">
						<input id="customer_id" name="customer_id" type="text" class="form-control" placeholder="User" value="<?php if(!empty($loaded_appointment->customer_id)) echo $loaded_appointment->customer_id; ?>">
					</div>
					<div class="form-group">
						<input id="subject" name="subject" type="text" class="form-control" placeholder="Subject" value="<?php if(!empty($loaded_appointment->subject)) echo $loaded_appointment->subject; ?>">
					</div>
					<div class="form-group">					
						<input id="message" name="message" type="text" class="form-control" placeholder="Message" value="<?php if(!empty($loaded_appointment->message)) echo $loaded_appointment->message; ?>">
					</div>
					<div class="form-group">
						<input id="start_date_time" name="start_date_time" type="text" class="form-control" placeholder="Start Date/Time" value="<?php if(!empty($loaded_appointment->start_date)) echo $loaded_appointment->start_date; ?>">
					</div>
					<div class="form-group">
						<input id="end_date_time" name="end_date_time" type="text" class="form-control" placeholder="End Date/Time" value="<?php if(!empty($loaded_appointment->end_date)) echo $loaded_appointment->end_date; ?>">
					</div>
					<div class="form-group">
						<input id="location" name="location" type="text" class="form-control" placeholder="Location" value="<?php if(!empty($loaded_appointment->location)) echo $loaded_appointment->location; ?>">
					</div>
					<div class="form-group">
						<input id="new-event" type="text" class="form-control" placeholder="Reminder">
					</div>
					<div class="form-group">
						<button type="submit" name="save" class="btn btn-success"><?php if(!empty($appointment->id)) echo "Update"; else echo "Create"; ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-body no-padding">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
					
	$(function() {
		
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
					echo "{".(!empty($loaded_appointment->id) && ($appointment->id == $loaded_appointment->id) ? "borderColor: '#f56954',":"")."url: '" . base_url() . "/index.php/appointments/getAppointment/" . $appointment->id . "', title: '".$appointment->firstname." ".$appointment->lastname.": ".$appointment->subject."', start: new Date('".$appointment->start_date."'),end: new Date('".$appointment->end_date."')},";
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