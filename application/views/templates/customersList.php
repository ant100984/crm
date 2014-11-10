<div class="row">
  <div class="col-md-9">
	<form class="form-inline" role="form" method="post" action="<?php echo base_url(); echo "/index.php/customers"; ?>">

		<input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" value="<?php echo $filter_firstname; ?>">
		<input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $filter_lastname; ?>">
		
		<label for="gender">Gender</label>
		<select name="gender" class="form-control">
			<option value=""></option>
			<option value="M" <?php if($filter_gender == 'M') echo 'selected'; ?>>Male</option>
			<option value="F" <?php if($filter_gender == 'F') echo 'selected'; ?>>Female</option>
		</select>
		
		<label for="group">Group</label>
		<select name="group" class="form-control">
			<option value=""></option>
			<?php
				foreach($groups as $group){
					echo "<option ".($group->id == $filter_group ? 'selected' : '')." value='".$group->id."'>".$group->group_name."</option>";
				}
			?>
		</select>
		
		<label for="smoker">Smoker</label>
		<select name="smoker" class="form-control">
			<option value=""></option>
			<option value="N" <?php if($filter_smoker == 'N') echo 'selected'; ?>>No</option>
			<option value="Y" <?php if($filter_smoker == 'Y') echo 'selected'; ?>>Yes</option>
		</select>
		
		<button type="submit" class="btn btn-default">
			<span class="glyphicon glyphicon-search"></span> Filter
		</button>
		
	</form>
	
	<table class="table table-bordered table-striped table-condensed" style="margin-top:50px;">
		<thead>
		  <tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Gender</th>
			<th>Home Address</th>
			<th>Office Address</th>
			<th>Group</th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
		<?php
			foreach($customers as $customer){
				echo "<tr style='".($customer->enabled == 0 ? 'text-decoration:line-through !important;' : '' )."'>";
					echo "<td>".$customer->firstname."</td>";
					echo "<td>".$customer->lastname."</td>";
					echo "<td>".($customer->gender == 'M' ? 'Male' : 'Female')."</td>";
					echo "<td>".$customer->homeaddress."</td>";
					echo "<td>".$customer->businessaddress."</td>";
					echo "<td>".$customer->group_name."</td>";
					echo "<td style='width: 195px;'>";
						echo "<a href='".base_url()."/index.php/customers/getCustomer/".$customer->id."' class='btn btn-xs btn-info' role='button'><span class='glyphicon glyphicon-pencil'></span> Details</a>";
						if($customer->enabled == 1){
							echo "<a href='".base_url()."/index.php/customers/setCustomerEnabled/".$customer->id."/0' class='btn btn-xs btn-warning' role='button'><span class='fa fa-lock'></span> Disable</a>";
						}else
							echo "<a href='".base_url()."/index.php/customers/setCustomerEnabled/".$customer->id."/1' class='btn btn-xs btn-success' role='button'><span class='fa fa-unlock'></span> Enable</a>";
							
						echo "<a href='".base_url()."/index.php/customers/deleteCustomer/".$customer->id."' class='btn btn-xs btn-danger' role='button'><span class='glyphicon glyphicon-trash'></span> Delete</a>";
					echo "</td>";
				echo "</tr>";
			}
		?>
		</tbody>
	  </table>
	 </div>
</div>