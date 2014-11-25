<div class="row">
  <div class="col-md-6">
		<form method="post" action="<?php echo base_url(); echo "/index.php/customers/saveCustomer"; ?>" enctype="multipart/form-data">
			<input type="hidden" id="customer_id" name="customer_id" value="<?php if(!empty($customer->id)) echo $customer->id; ?>"/>
			 <fieldset>
				<?php
					if(empty($loaded_policy->id)){
				?>
					<div class="form-group">
						<button type="submit" name="save" class="btn btn-success"><?php if(!empty($customer->id)) echo "Update"; else echo "Save"; ?></button>
					</div>
				<?php
				}
				?>
				<div class="box">
					<div class="form-group">
						<label for="group">Group</label>
						<select name="group" class="form-control">
							<option value="-1"></option>
							<?php
								foreach($groups as $group){
									echo "<option value='".$group->id."' ".(!empty($customer->id) && $customer->group == $group->id ? "selected" : "").">".$group->group_name."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<div class="form-group">
							<label for="logo">Profile photo</label>
						</div>
					   <img class="img-circle" style="margin-bottom: 20px;" src="<?php echo base_url(); if(!empty($customer->profilephoto)) echo $customer->profilephoto; else echo "img/no_image.png";?>" width="100"/>
					   <input type="file" class="form-control" id="profile_photo" name="profile_photo" placeholder="" value="">
					</div>
				  <div class="form-group">
				   <label for="company">First Name</label>
				   <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" required value="<?php if(!empty($customer->firstname)) echo $customer->firstname;?>">
				  </div>
				  <div class="form-group">
				   <label for="street_name">Last Name</label>
				   <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" required value="<?php if(!empty($customer->lastname)) echo $customer->lastname;?>">
				  </div>
				  
				  <div class="form-group">
					<label for="postcode">Date of Birth</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control" id="dob" name="dob" placeholder="" required data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php if(!empty($customer->dateofbirth)) echo $customer->dateofbirth;?>">
					</div>
				  </div>
					
					<div class="form-group">
						<label for="gender">Gender</label>
						<select name="gender" class="form-control">
							<option value="M" <?php if(!empty($customer->gender) && $customer->gender == 'M' ) echo "selected";?> >Male</option>
							<option value="F" <?php if(!empty($customer->gender) && $customer->gender == 'F' ) echo "selected";?> >Female</option>
						</select>
					</div>
				  
				  <div class="form-group">
				   <label for="occupation">Occupation</label>
				   <input type="text" class="form-control" id="occupation" name="occupation" placeholder="" value="<?php if(!empty($customer->occupation)) echo $customer->occupation;?>">
				  </div>
				  <div class="form-group">
				  <label for="smoker">Smoker</label>
					<select name="smoker" class="form-control">
						<option value="N" <?php if(!empty($customer->smoker) && $customer->smoker == 'N') echo "selected";?> >No</option>
						<option value="Y" <?php if(!empty($customer->smoker) && $customer->smoker == 'Y') echo "selected";?> >Yes</option>
					</select>
				  </div>
				  <div class="form-group">
				   <label for="email">Email</label>
				   <input type="text" class="form-control" id="email" name="email" placeholder="" value="<?php if(!empty($customer->email)) echo $customer->email;?>">
				  </div>
				  <div class="form-group">
				   <label for="home_address">Home Address</label>
				   <input type="text" class="form-control" id="home_address" name="home_address" placeholder="" required value="<?php if(!empty($customer->homeaddress)) echo $customer->homeaddress;?>">
				  </div>
				  <div class="form-group">
				   <label for="business_address">Business Address</label>
				   <input type="text" class="form-control" id="business_address" name="business_address" placeholder="" required value="<?php if(!empty($customer->businessaddress)) echo $customer->businessaddress;?>">
				  </div>
				  <div class="form-group">
				   <label for="NRIC">NRIC</label>
				   <input type="text" class="form-control" id="NRIC" name="NRIC" placeholder="" required value="<?php if(!empty($customer->nric)) echo $customer->nric;?>">
				  </div>
				  <div class="form-group">
				   <label for="note">Notes</label>
				   <textarea class="form-control" id="note" name="note"><?php if(!empty($customer->notes)) echo $customer->notes;?></textarea>
				  </div>
				  <div class="form-group">
				   <label for="username">Username</label>
				   <input type="text" class="form-control" id="username" name="username" placeholder="" required value="<?php if(!empty($customer->username)) echo $customer->username;?>">
				  </div>
				  <div class="form-group">
				   <label for="password">Password</label>
				   <input type="password" class="form-control" id="password" name="password" placeholder="" required value="">
				  </div>
				  <div class="overlay edit_policy_overlay" style="display: none;"></div>
				</div>
			 </fieldset>
		</form>
  </div>
  <?php
  if(!empty($customer->id)){
  ?>
	  <div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<i class="fa fa-book"></i>
				<h3 class="box-title">Policies List</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<thead>
					  <tr>
						<th>Policy</th>
						<th>Date</th>
						<th>Reminder</th>
						<th>Status</th>
						<th>Notes</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
					<?php
						if(!empty($customer->id))
							foreach($policies as $policy){
								echo "<tr>";
									echo "<td>".$policy->description."</td>";
									echo "<td>".$policy->policy_date."</td>";
									echo "<td>".$policy->reminder."</td>";
									echo "<td>".$policy->status."</td>";
									echo "<td>".$policy->notes."</td>";
									echo "<td style='width: 150px;'>";
										echo "<a href='".base_url()."/index.php/customers/getCustomer/".$customer->id."/".$policy->id."' class='btn btn-xs btn-info' role='button'><span class='glyphicon glyphicon-pencil'></span> Edit</a>";
										echo "<a href='".base_url()."/index.php/customers/deletePolicy/".$customer->id."/".$policy->id."' class='btn btn-xs btn-danger' role='button'><span class='glyphicon glyphicon-trash'></span> Delete</a>";
									echo "</td>";
								echo "</tr>";
							}
					?>
					</tbody>
				</table>
			</div>
			<div class="overlay edit_policy_overlay" style="display: none;"></div>
		</div>
		<div class="box">
			<div class="box-header">
				<i class="fa fa-book"></i>
				<h3 class="box-title">Policy Details</h3>
			</div>
			<div class="box-body">
				<form method="post" action="<?php echo base_url(); echo "/index.php/customers/savePolicy"; ?>">
					<input type="hidden" id="policy_id" name="policy_id" value="<?php if(!empty($loaded_policy->id)) echo $loaded_policy->id;?>"/>
					<input type="hidden" id="customer_id" name="customer_id" value="<?php if(!empty($customer->id)) echo $customer->id; ?>"/>
					 <fieldset>

					  <div class="form-group">
					   <label for="policy_name">Policy Name</label>
					   <input type="text" class="form-control" id="policy_name" name="policy_name" placeholder="" required value="<?php if(!empty($loaded_policy->description)) echo $loaded_policy->description;?>">
					  </div>
					  
					  <div class="form-group">
						<label for="postcode">Date</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control" id="policy_date" name="policy_date" placeholder="" required data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php if(!empty($loaded_policy->policy_date)) echo $loaded_policy->policy_date;?>">
						</div>
					  </div>
					  
					  <div class="form-group">
					  <label for="policy_reminder">Reminder</label>
						<select name="policy_reminder" class="form-control">
							<?php
								foreach($policies_reminders as $reminder){
									echo "<option value='".$reminder->code."' ".(!empty($loaded_policy->reminder_code) && $loaded_policy->reminder_code == $reminder->code ? "selected" : "")." >".$reminder->description."</option>";
								}
							?>
						</select>
					  </div>
					  <div class="form-group">
					  <label for="policy_status">Status</label>
						<select name="policy_status" class="form-control">
							<?php
								foreach($policies_status as $status){
									echo "<option value='".$status->code."' ".(!empty($loaded_policy->status_code) && $loaded_policy->status_code == $status->code ? "selected" : "")." >".$status->description."</option>";
								}
							?>
						</select>
					  </div>
					  <div class="form-group">
					   <label for="policy_notes">Notes</label>
					   <textarea class="form-control" id="policy_notes" name="policy_notes"><?php if(!empty($loaded_policy->notes)) echo $loaded_policy->notes;?></textarea>
					  </div>
					  <div class="form-group">
							<button type="submit" name="save" class="btn btn-success"><?php if(!empty($loaded_policy->id)) echo "Update"; else echo "Insert"; ?></button>
							<?php
								if(!empty($loaded_policy->id)){
							?>
									<a href="<?php echo base_url() . "/index.php/customers/getCustomer/".$customer->id; ?>" class="btn btn-danger">Cancel</a>
							<?php
								}
							?>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="box">
			<div class="box-header">
				<i class="fa fa-calendar"></i>
				<h3 class="box-title">Attachments List</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered" style="margin-top:50px;">
					<tbody>
					<?php
						if(!empty($customer->id))
							foreach($attachments as $attachment){
								echo "<tr>";
									echo "<td>".$attachment->attachment_name."</td>";
									echo "<td style='width: 150px;'>";
										echo "<a target='_blank' href='".base_url().$attachment->attachment_path."' class='btn btn-xs btn-info' role='button'><span class='glyphicon glyphicon-search'></span> View</a>";
										echo "<a href='".base_url()."/index.php/customers/deleteAttachment/".$attachment->user_id."/".$attachment->id."' class='btn btn-xs btn-danger' role='button'><span class='glyphicon glyphicon-trash'></span> Delete</a>";
									echo "</td>";
								echo "</tr>";
							}
					?>
					</tbody>
				</table>
			</div>
			<div class="overlay edit_policy_overlay" style="display: none;"></div>
		</div>
		<div class="box">
			<div class="box-header">
				<i class="fa fa-book"></i>
				<h3 class="box-title">Attachment Details</h3>
			</div>
			<div class="box-body">
				<form method="post" action="<?php echo base_url(); echo "/index.php/customers/uploadAttachment"; ?>" enctype="multipart/form-data">
					<input type="hidden" id="customer_id" name="customer_id" value="<?php if(!empty($customer->id)) echo $customer->id; ?>"/>
					<div class="form-group">
					   <label for="attachment">Upload an attachment</label>
					   <input type="file" class="form-control" id="attachment" name="attachment" placeholder="" value="">
					</div>
					<div class="form-group">
						<button type="submit" name="upload" class="btn btn-success">Upload</button>
					</div>
				</form>
			</div>
			<div class="overlay edit_policy_overlay" style="display: none;"></div>
		</div>
	  </div>
  <?php
  }
  ?>
</div>
<script type="text/javascript">
	$(function() {
		
		if('<?php if(!empty($loaded_policy->id)) echo 'stuff'; ?>' != '')
			$('.edit_policy_overlay').show();
	
		$("#dob").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		$("#policy_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		
		$("#dob").datepicker();
		$("#policy_date").datepicker();
	});
</script>