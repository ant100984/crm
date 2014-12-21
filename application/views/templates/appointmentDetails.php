<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Appointment details</h3>
			</div>
			<div class="box-body">
				<form method="post" action="<?php echo base_url() . "/index.php/appointments/saveAppointment"; ?>">
					<input type="hidden" name="appointment_id" id="appointment_id" value="<?php if(!empty($loaded_appointment->id)) echo $loaded_appointment->id; ?>"/>
					
					<?php
						$CUSTOMER_WIDGET_FIELD_LABEL = "Customer";
						$CUSTOMER_WIDGET_CLOSEABLE = TRUE;
						$CUSTOMER_WIDGET_LIST_HEIGHT = 200;
						$CUSTOMER_WIDGET_UPDATE_MESSAGES_LIST = FALSE;
						require("customerWidget.php");
						
					?>
					
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
						<label for="alert">Alert</label>
						<select id="alert" name="alert" class="form-control">
							<option value="-1" <?php if(empty($loaded_appointment->alert) || $loaded_appointment->alert == '-1') echo "selected"; ?>>Do not alert me</option>
							<option value="30" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '30') echo "selected"; ?>>30 minutes before</option>
							<option value="60" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '60') echo "selected"; ?>>1 hour before</option>
							<option value="120" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '120') echo "selected"; ?>>2 hours before</option>
							<option value="180" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '180') echo "selected"; ?>>3 hours before</option>
							<option value="240" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '240') echo "selected"; ?>>4 hours before</option>
							<option value="300" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '300') echo "selected"; ?>>5 hours before</option>
							<option value="360" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '360') echo "selected"; ?>>6 hours before</option>
							<option value="420" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '420') echo "selected"; ?>>7 hours before</option>
							<option value="480" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '480') echo "selected"; ?>>8 hours before</option>
							<option value="540" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '540') echo "selected"; ?>>9 hours before</option>
							<option value="600" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '600') echo "selected"; ?>>10 hours before</option>
							<option value="660" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '660') echo "selected"; ?>>11 hours before</option>
							<option value="720" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '720') echo "selected"; ?>>12 hours before</option>
						</select>
					</div>
					<div class="form-group">
						<?php 
							if(empty($loaded_remark->id)) { 
						?>
								<button type="submit" name="save" class="btn btn-success"><?php if(!empty($loaded_appointment->id)) echo "Update"; else echo "Create"; ?></button>
								
								<?php
									if(!empty($loaded_appointment->id)){
								?>
										<a href="<?php echo base_url()."/index.php/appointments/deleteAppointment/".$loaded_appointment->id; ?>" class="btn btn-danger">Delete</a>
								<?php
									}
								?>
									
								
						<?php
							}
						?>
					</div>
				</form>
			</div>		
			<div style="display: none;" class="overlay edit_remark_overlay"></div>
		</div>
		<?php if(!empty($loaded_appointment->id)){ ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Appointment remarks</h3>				
			</div>
			<div class="box-body">
				<h5 class="badge"><?php echo $loaded_appointment->start_date . " " . $loaded_appointment->start_time . " - " . $loaded_appointment->end_date . " " . $loaded_appointment->end_time; ?></h5>
				<h5><?php if(sizeof($remarks) == 0) echo "There are no remarks yet for this appointment"; ?></h5>
				<table class="table table-hover table-condensed">
					<?php
						foreach($remarks as $remark){
							echo "<tr><td style='vertical-align: middle !important;'>".$remark->notes."</td>";
							echo "<td style='width:130px; vertical-align: middle !important;'>";
							if(empty($loaded_remark->id)) { 
								echo "<a href='".base_url()."/index.php/appointments/loadRemark/".$loaded_appointment->id."/".$remark->id."' class='btn btn-xs btn-info'><i class='glyphicon glyphicon-pencil'></i>Edit</a>";
								echo "<a href='".base_url()."/index.php/appointments/deleteRemark/".$remark->id."/".$loaded_appointment->id."' class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i>Delete</a>";
							}
							echo "</td></tr>";
						}
					?>
				</table>
				<hr/>
				<form role="form" method="post" action="<?php echo base_url(); echo "/index.php/appointments/saveRemark"; ?>">
					<input type="hidden" name="appointment_id" id="appointment_id" value="<?php if(!empty($loaded_appointment->id)) echo $loaded_appointment->id; ?>"/>
					<input type="hidden" name="remark_id" id="remark_id" value="<?php if(!empty($loaded_remark->id)) echo $loaded_remark->id; ?>"/>
					<div class="form-group">
						<label>Notes</label>
						<textarea rows="3" required id="notes" name="notes" class="form-control"><?php if(!empty($loaded_remark->id)) echo $loaded_remark->notes; ?></textarea>
					</div>
					<div class="form-group">
							<button class="btn btn-success">
								<?php if(!empty($loaded_remark->id)) echo "Save"; else echo "Add&nbsp;" ?>
							</button>
							<?php 
								if(!empty($loaded_remark->id)) { 
							?>
									<a href="<?php echo base_url() . "/index.php/appointments/getAppointment/" . $loaded_appointment->id; ?>" class="btn btn-danger">
										Cancel&nbsp;
									</a>
							<?php
								}
							?>
					</div>
				</form>				
			</div>
			<div style="display: none;" class="overlay choose_customer_overlay"></div>
		</div>
		<?php
		}
		?>
	</div>
	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-body no-padding">
				<div id="calendar">
				</div>
			</div>
			<div style="display: none;" class="overlay choose_customer_overlay edit_remark_overlay"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		
		if('<?php if(!empty($loaded_remark->id)) echo "stuff"; ?>' != ''){
		
			$(".edit_remark_overlay").show();
		
		}
		
		$("#start_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		$("#end_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		
		$("#start_date").datepicker({format: 'dd/mm/yyyy'});
		
		$("#end_date").datepicker({format: 'dd/mm/yyyy'});
		
		$(".timepicker").timepicker({showMeridian: false, showInputs: false});
	});
	
</script>