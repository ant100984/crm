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
						<label>Customer</label>
						<div class="input-group">
							<div class="input-group-btn">
								<button id="openChooseCustomer" type="button" class="btn btn-info btn-flat">
									Choose
								</button>
							</div><!-- /btn-group -->
							<input readonly required id="customer_name" name="customer_name" type="text" class="form-control" value="<?php if(!empty($loaded_appointment->customer_id)) echo $loaded_appointment->firstname." ".$loaded_appointment->lastname; ?>">
							<input id="customer_id" name="customer_id" type="hidden" value="<?php if(!empty($loaded_appointment->customer_id)) echo $loaded_appointment->customer_id; ?>">
						</div>
					</div>
					<div id="customer_list" class="box box-solid box-info" style="display: none;">
						<div class="box-header">
							<h3 class="box-title">Choose the customer</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-info btn-sm" id="close_customer_list"><i class="fa fa-times"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body no-padding" style="min-height: 200px; max-height: 200px; overflow-y: auto;">
							<table class="table table-hover table-condensed">
								<?php
									foreach($customers as $customer){
										echo "<tr><td style='vertical-align: middle !important;'><img src='".base_url().(!empty($customer->profilephoto) ? $customer->profilephoto : 'img/no_image.png')."' width='50' height='50'/></td><td style='vertical-align: middle !important;'><b>".$customer->firstname." ".$customer->lastname. "</b> born on <b>" . $customer->dateofbirth ."</b></td><td style='vertical-align: middle !important;'><a href='javascript:chooseCustomer(".$customer->id.",\"".$customer->firstname." ".$customer->lastname."\");' class='btn'><i class='fa fa-plus'></i></a></td></tr>";
									}
								?>
							</table>
						</div>
					</div>
					<div class="form-group">
						<label for="subject">Subject</label>
						<input id="subject" required name="subject" type="text" class="form-control" value="<?php if(!empty($loaded_appointment->subject)) echo $loaded_appointment->subject; ?>">
					</div>
					<div class="form-group">		
						<label for="message">Message</label>
						<input id="message" name="message" type="text" class="form-control" value="<?php if(!empty($loaded_appointment->message)) echo $loaded_appointment->message; ?>">
					</div>
					<div class="form-group">
						<label>Start Date/Time</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input id="start_date" required name="start_date" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php if(!empty($loaded_appointment->start_date)) echo $loaded_appointment->start_date; ?>">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input id="start_time" required name="start_time" type="text" class="form-control timepicker" value="<?php if(!empty($loaded_appointment->start_time)) echo $loaded_appointment->start_time; ?>">
						</div>
					</div>
					<div class="form-group">
						<label>End Date/Time</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input id="end_date" required name="end_date" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php if(!empty($loaded_appointment->end_date)) echo $loaded_appointment->end_date; ?>">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input id="end_time required" name="end_time" type="text" class="form-control timepicker" value="<?php if(!empty($loaded_appointment->end_time)) echo $loaded_appointment->end_time; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="location">Location</label>
						<input id="location" name="location" type="text" class="form-control" value="<?php if(!empty($loaded_appointment->location)) echo $loaded_appointment->location; ?>">
					</div>
					<div class="form-group">
						<label for="reminder">Reminder</label>
						<input id="new-event" type="text" class="form-control">
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
				<div id="calendar">
				</div>
			</div>
			<div style="display: none;" class="overlay choose_customer_overlay"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function chooseCustomer(id, name){
		$('#customer_id').val(id);
		$('#customer_name').val(name);
		$('#customer_list').slideUp("slow");
		$('.choose_customer_overlay').hide();
	}
	
	$(function() {
		
		$('#openChooseCustomer').click(function(){
			$('#customer_list').slideDown("fast");
			$('.choose_customer_overlay').show();
		});
		
		$('#close_customer_list').click(function(){
			$('#customer_list').slideUp("slow");
			$('.choose_customer_overlay').hide();
		});
		
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
					echo "{".(!empty($loaded_appointment->id) && ($appointment->id == $loaded_appointment->id) ? "textColor: 'yellow', borderColor: 'yellow',":"")."url: '" . base_url() . "/index.php/appointments/getAppointment/" . $appointment->id . "', title: '".$appointment->firstname." ".$appointment->lastname.": ".$appointment->subject."', start: new Date('".$appointment->start_date."'),end: new Date('".$appointment->end_date."')},";
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
		
		$("#start_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		$("#end_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		
		$("#start_date").datepicker();
		$("#end_date").datepicker();
		
		$(".timepicker").timepicker({
			showMeridian: false,
			showInputs: false
		});
	});
	
</script>
</script>