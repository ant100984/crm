<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="confirmModal" id="confirmModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<form method="post" action="<?php echo base_url() . "/index.php/appointments/newAppointment"; ?>" role="form">
			<input type="hidden" value="" id="selected_date" name="selected_date"/>
			<div class="modal-body">
				Do you want to create a new appointment in the selected date?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Yes</button>
			</div>
		</form>
    </div>
  </div>
</div>
<script type="text/javascript">
	/* initialize the calendar -----------------------------------------------------------------*/
	$(function(){
		var date = new Date();
		var d = date.getDate(),
				m = date.getMonth(),
				y = date.getFullYear();
		$('#calendar').fullCalendar({
			dayClick: function(date, jsEvent, view) {	
				$('.fc-day').css('background-color', 'white');
				$(this).css('background-color', '#FFEC8B');
				
				$('#confirmModal').modal();
				$('#selected_date').val(date.format('D/M/YYYY'));
			},
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
					echo "{".(!empty($loaded_appointment->id) && ($appointment->id == $loaded_appointment->id) ? "textColor: 'yellow', borderColor: 'yellow',":"")."url: '" . base_url() . "/index.php/appointments/getAppointment/" . $appointment->id . "', title: '".$appointment->firstname." ".$appointment->lastname.": ".$appointment->subject."', start: new Date('".$appointment->start_date_full."'),end: new Date('".$appointment->end_date_full."')},";
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