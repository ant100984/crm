<div class="row">
	<div class="col-md-7">
	
		<form role="form" method="post" action="<?php echo base_url()."/index.php/crmusers/saveuser"; ?>" enctype="multipart/form-data">
			<input type="hidden" id="user_id" name="user_id" value="<?php if(!empty($user->id)) echo $user->id; ?>"/>
			<fieldset>
				<div class="form-group">
					<button type="submit" name="save" class="btn btn-success"><?php if(!empty($user->id)) echo "Update"; else echo "Save"; ?></button>
				</div>
				<div class="form-group">
					<label for="logo">Profile photo</label>
				</div>
			    <img style="margin-bottom: 20px;" src="<?php echo base_url(); if(!empty($user->profilephoto)) echo $user->profilephoto; else echo "img/no_image.png";?>" width="100" height="100"/>
			    <input type="file" class="form-control" id="logo" name="logo" placeholder="" value="">
			  
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="" required value="">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="" required value="">
				</div>
				<div class="form-group">
					<label for="manage_newsletters">
						<input type="checkbox" class="form-control" id="manage_newsletters" name="manage_newsletters" >
						Manage Newsletters
					</label>
				</div>
				<div class="form-group">
					<label for="manage_customers">
						<input type="checkbox" class="form-control" id="manage_customers" name="manage_customers">
						Manage Customers
					</label>
				</div>
				<div class="form-group">
					<label for="manage_crmusers">
						<input type="checkbox" class="form-control" id="manage_crmusers" name="manage_crmusers">
						Manage CRM USers
					</label>
				</div>
				<div class="form-group">
					<label for="manage_messages">
						<input type="checkbox" class="form-control" id="manage_messages" name="manage_messages">
						Manage Customers Messaging
					</label>
				</div>
				<div class="form-group">
					<label for="manage_appointments">
						<input type="checkbox" class="form-control" id="manage_appointments" name="manage_appointments">
						Manage Appointments
					</label>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="col-md-4">
		<table class="table table-bordered" style="margin-top:50px;">
			<thead>
			  <tr>
				<th>User</th>
				<th></th>
			  </tr>
			</thead>
			<tbody>
				<?php 
					foreach($users as $user){ 
						echo "<tr>";
						echo "<td style='width: 75%;'>".$user->firstname . " " . $user->lastname ."</td>";
						echo "<td style='width: 25%;'>";
						echo "<a href='' class='btn btn-xs btn-info' role='button'><span class='glyphicon glyphicon-pencil'></span> Edit</a>";
						echo "<a href='' class='btn btn-xs btn-danger' role='button'><span class='glyphicon glyphicon-trash'></span> Delete</a>";
						echo "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>						
	</div>
</div>