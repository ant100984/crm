<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Appointment details</h3>
			</div>
			<div class="box-body">
				<form method="post" action="<?php echo base_url(); echo "/index.php/appointments/saveAppointment"; ?>">
					<input type="hidden" name="appointment_id" id="appointment_id" value="<?php if(!empty($loaded_appointment->id)) echo $loaded_appointment->id; ?>"/>
					<div class="form-group">
						<label>Customer</label>
						<div class="input-group">
							<div class="input-group-btn">
								<button id="openChooseCustomer" type="button" class="btn btn-info btn-flat">
									Choose&nbsp;
									<i id="customer_dropdown_icon" class="fa fa-caret-down"></i>
								</button>
							</div>
							<input readonly required id="customer_name" name="customer_name" type="text" class="form-control" value="<?php if(!empty($loaded_appointment->customer_id)) echo $loaded_appointment->firstname." ".$loaded_appointment->lastname; ?>">
							<input id="customer_id" name="customer_id" type="hidden" value="<?php if(!empty($loaded_appointment->customer_id)) echo $loaded_appointment->customer_id; ?>">
						</div>
					</div>
					<div id="customer_list" class="box box-solid box-info" style="display: none;">
						<div class="box-header">
							<h4 class="box-title">Select the customer</h4>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-info btn-sm" id="close_customer_list"><i class="fa fa-times"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body no-padding" style="min-height: 200px; max-height: 200px; overflow-y: visible;">
							<div class="input-group">
								<input class="form-control" type="text" value="" id="customer_filter" name="customer_filter" placeholder="Filter the customer list..."/>
								<div class="input-group-addon">
									<i class="fa fa-search"></i>
								</div>
							</div>
							<div class="box">
								<table id="customers_list_table" class="table table-hover table-condensed">
									<?php
										foreach($customers as $customer){
											echo "<tr><td style='vertical-align: middle !important;'><img class='img-circle' src='".base_url().(!empty($customer->profilephoto) ? $customer->profilephoto : 'img/no_image.png')."' width='50'/></td><td style='vertical-align: middle !important;'><b>".$customer->firstname." ".$customer->lastname. "</b> born on <b>" . $customer->dateofbirth ."</b></td><td style='vertical-align: middle !important;'><a href='javascript:chooseCustomer(".$customer->id.",\"".$customer->firstname." ".$customer->lastname."\");' class='btn'><i class='fa fa-plus'></i></a></td></tr>";
										}
									?>
								</table>
								<div class="overlay customers_overlay" style="display: none;"></div>
								<div class="loading-img customers_loading" style="display: none;"></div>
							</div>
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
						<label for="alert">Alert</label>
						<select id="alert" name="alert" class="form-control">
							<option value="" <?php if(empty($loaded_appointment->alert)) echo "selected"; ?>>Do not alert me</option>
							<option value="30m" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '30m') echo "selected"; ?>>30 minutes before</option>
							<option value="1h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '1h') echo "selected"; ?>>1 hour before</option>
							<option value="2h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '2h') echo "selected"; ?>>2 hours before</option>
							<option value="3h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '3h') echo "selected"; ?>>3 hours before</option>
							<option value="4h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '4h') echo "selected"; ?>>4 hours before</option>
							<option value="5h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '5h') echo "selected"; ?>>5 hours before</option>
							<option value="6h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '6h') echo "selected"; ?>>6 hours before</option>
							<option value="7h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '7h') echo "selected"; ?>>7 hours before</option>
							<option value="8h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '8h') echo "selected"; ?>>8 hours before</option>
							<option value="9h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '9H') echo "selected"; ?>>9 hours before</option>
							<option value="10h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '10h') echo "selected"; ?>>10 hours before</option>
							<option value="11h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '11h') echo "selected"; ?>>11 hours before</option>
							<option value="12h" <?php if(!empty($loaded_appointment->id) && $loaded_appointment->alert == '12h') echo "selected"; ?>>12 hours before</option>
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
	function chooseCustomer(id, name){
		$('#customer_id').val(id);
		$('#customer_name').val(name);
		$('#customer_list').slideUp("fast");
		$('.choose_customer_overlay').hide();
	}
	
	function openChooseCustomer(){
		$('#customer_list').slideDown("fast");
		$('.choose_customer_overlay').show();
	}
	
	function closeChooseCustomer(){
		$('#customer_list').slideUp("fast");
		$('.choose_customer_overlay').hide();
	}
	
	
	$(function() {
		
		$('#customer_filter').keyup(function(){
			var val = $('#customer_filter').val();
			
			$.ajax({
			  type: "POST",
			  url: "<?php echo base_url() . "/index.php/customers/filterCustomers"; ?>",
			  data: {filter_string: val},
			  beforeSend: function(){
				$('.customers_overlay').show();
				$('.customers_loading').show();
			  }
			}).done(function(data) {
				$('#customers_list_table').html(data);
				$('.customers_overlay').hide();
				$('.customers_loading').hide();
			});
			
		});
		
		if('<?php if(!empty($loaded_remark->id)) echo "stuff"; ?>' != ''){
		
			$(".edit_remark_overlay").show();
		
		}
		
		
		$('#customer_name').click(function(){
			if($('#customer_list').is(':visible'))
				closeChooseCustomer();
			else
				openChooseCustomer();
		});
		
		$('#openChooseCustomer').click(function(){
			if($('#customer_list').is(':visible'))
				closeChooseCustomer();
			else
				openChooseCustomer();
		});
			
		$('#close_customer_list').click(function(){
			closeChooseCustomer();			
		});
		
		$("#start_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		$("#end_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		
		$("#start_date").datepicker({format: 'dd/mm/yyyy'});
		
		$("#end_date").datepicker({format: 'dd/mm/yyyy'});
		
		$(".timepicker").timepicker({showMeridian: false, showInputs: false});
	});
	
</script>
</script>