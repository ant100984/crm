<div class="row">
	<div class="col-md-7">
		<div class="box">
			<div class="box-header">
				<i class="fa fa-user"></i>
				<h3 class="box-title">User Details</h3>
			</div>
			<div class="box-body">
		
				<form role="form" method="post" action="<?php echo base_url()."/index.php/crmusers/saveuser"; ?>" enctype="multipart/form-data">
					<input type="hidden" id="user_id" name="user_id" value="<?php if(!empty($loaded_user->id)) echo $loaded_user->id; ?>"/>
					<fieldset>
						<div class="form-group">
							<button type="submit" name="save" class="btn btn-success"><?php if(!empty($loaded_user->id)) echo "Update"; else echo "Save"; ?></button>
							<?php
								if(!empty($loaded_user->id) && in_array("manage_crmusers",$user_permissions)){
							?>
									<a href="<?php echo base_url()."index.php/crmusers"; ?>" class="btn btn-danger">Cancel</a>
							<?php
							}
							?>
						</div>
						<div class="form-group">
							<label for="logo">Profile photo</label>
						</div>
						<img class="img-circle" style="margin-bottom: 20px;" src="<?php echo base_url(); if(!empty($loaded_user->profilephoto)) echo $loaded_user->profilephoto; else echo "img/no_image.png";?>" width="100" height="100"/>
						<input type="file" class="form-control" id="profile_photo" name="profile_photo" placeholder="" value="">
					  
						<div class="form-group">
							<label for="firstname">Firstname</label>
							<input type="text" class="form-control" id="firstname" name="firstname" placeholder="" required value="<?php if(!empty($loaded_user->id)) echo $loaded_user->firstname; ?>">
						</div>
						<div class="form-group">
							<label for="lastname">Lastname</label>
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="" required value="<?php if(!empty($loaded_user->id)) echo $loaded_user->lastname; ?>">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="" required value="<?php if(!empty($loaded_user->id)) echo $loaded_user->email; ?>">
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="" required value="<?php if(!empty($loaded_user->id)) echo $loaded_user->username; ?>">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="" value="">
						</div>
						<?php 
						
						if(in_array("manage_crmusers",$user_permissions)){
							
							foreach($permission_type as $permission) { 
								if(isset($permissions["{$permission->permission_code}"]) && $permissions["{$permission->permission_code}"] == "on")
									$checked = "checked='checked'";
								else
									$checked = "";
								?>
								<div class="form-group">
									<label for="<?php echo $permission->permission_code; ?>">
										<input type="checkbox" class="form-control" id="<?php echo $permission->permission_code; ?>" name="<?php echo $permission->permission_code; ?>" <?php echo $checked; ?> >
										<?php echo $permission->permission_name; ?>
									</label>
								</div>
							<?php } ?>
							
						<?php } ?>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<?php if(in_array("manage_crmusers",$user_permissions)){ ?>
	<div class="col-md-5">
		<div class="box">
			<div class="box-header">
				<i class="fa fa-group"></i>
				<h3 class="box-title">CRM Users List</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered" style="margin-top:50px;">
					<thead>
					  <tr>
						<th></th>
						<th>User</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
						<?php 
							foreach($users as $user){ 
								echo "<tr>";
								echo "<td style='width: 10%; vertical-align: middle !important;'><img src='".base_url().(!empty($user->profilephoto) ? $user->profilephoto : 'img/no_image.png')."' class='img-circle'/></td>";
								echo "<td style='width: 70%; vertical-align: middle !important;'>".$user->firstname . " " . $user->lastname ."</td>";
								echo "<td style='width: 20%; vertical-align: middle !important;'>";
								echo "<a href='".base_url()."index.php/crmusers/index/".$user->id."' class='btn btn-xs btn-info' role='button'><span class='glyphicon glyphicon-pencil'></span> Edit</a>";
								echo "<a href='".base_url()."index.php/crmusers/deleteUser/".$user->id."' class='btn btn-xs btn-danger' role='button'><span class='glyphicon glyphicon-trash'></span> Delete</a>";
								echo "</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="overlay users_list_overlay" style="display: none;"></div>
		</div>
	</div>
	<?php } ?>
</div>
<script type="text/javascript">
	$(function() {
		
		if('<?php if(!empty($loaded_user->id)) echo 'stuff'; ?>' != '')
			$('.users_list_overlay').show();
			
	});
</script>