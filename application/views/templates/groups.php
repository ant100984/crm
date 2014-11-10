
<div class="row">
	
	<!-- Modal -->
	<div class="modal fade" id="new_group" tabindex="-1" role="dialog" aria-labelledby="new_group_label" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">New Group</h4>
		  </div>
		  <form method="post" action="<?php echo base_url() . "/index.php/groups/saveGroup"; ?>">
			<input type="hidden" name="group_id" id="group_id" value=""/>
			<div class="modal-body">
				<div class="form-group">
					<label for="group_name">Group Name</label>
					<input type="text" class="form-control" id="group_name" name="group_name" placeholder="" required value="">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" value="Create"/>
			</div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="edit_group" tabindex="-1" role="dialog" aria-labelledby="edit_group_label" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Edit Group</h4>
		  </div>
		  <form method="post" action="<?php echo base_url() . "/index.php/groups/saveGroup"; ?>">
			<input type="hidden" name="group_id" id="group_id" value="<?php echo $group_to_show->id; ?>"/>
			<div class="modal-body">
				<div class="form-group">
					<label for="group_name">Group Name</label>
					<input type="text" class="form-control" id="group_name" name="group_name" placeholder="" required value="<?php echo $group_to_show->group_name; ?>">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" value="Save"/>
			</div>
		  </form>
		</div>
	  </div>
	</div>
	
	<div class="col-md-8">
		<!-- Custom Tabs -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<?php
					foreach($groups as $group){
						echo "<li class='".($group_to_show->id == $group->id ? "active" : "")."'><a href='".base_url()."/index.php/groups/index/".$group->id."'>".$group->group_name."</a></li>";
					}
				?>
				<!--
				<li class="<?php if($group_to_show->id == -1) echo "active"; ?>"><a href="<?php echo base_url().'/index.php/groups/index/-1'; ?>">Ungrouped</a></li>
				-->
				<li class="pull-right"><a href="<?php echo base_url().'/index.php/groups/deleteGroup/'.$group_to_show->id; ?>" class="text-muted"><i class="fa fa-trash-o"></i></a></li>
				<li class="pull-right"><a href="#" class="text-muted" data-toggle="modal" data-target="#new_group"><i class="fa fa-plus-square"></i></a></li>
				<li class="pull-right"><a href="#" class="text-muted" data-toggle="modal" data-target="#edit_group"><i class="fa fa-pencil"></i></a></li>
				
			</ul>
			<div class="tab-content">
				<?php
					foreach($groups as $group){
						echo "<div class='tab-pane ".($group_to_show->id == $group->id ? "active" : "")."' id='tab_".$group->id."'>";
						
						if($group_to_show->id == $group->id){
						
							echo "<table class='table table-bordered table-striped table-condensed'>";
								echo "<thead>";
									echo "<tr>";
										echo "<th>First Name</th>";
										echo "<th>Last Name</th>";
										echo "<th>Gender</th>";
										echo "<th>Home Address</th>";
										echo "<th>Office Address</th>";
										echo "<th></th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								foreach($customers as $customer){
									echo "<tr style='".($customer->enabled == 0 ? 'text-decoration:line-through !important;' : '' )."'>";
										echo "<td>".$customer->firstname."</td>";
										echo "<td>".$customer->lastname."</td>";
										echo "<td>".$customer->gender."</td>";
										echo "<td>".$customer->homeaddress."</td>";
										echo "<td>".$customer->businessaddress."</td>";
										echo "<td style='width: 50px;'>";
											echo "<a href='".base_url()."/index.php/customers/getCustomer/".$customer->id."' class='btn btn-xs btn-info' role='button'><span class='glyphicon glyphicon-pencil'></span> Details</a>";
										echo "</td>";
									echo "</tr>";
								}
								echo "</tbody>";
							echo "</table>";
						}
						
						echo "</div>";
					}
				?>
				
			</div><!-- /.tab-content -->
		</div><!-- nav-tabs-custom -->
	</div><!-- /.col -->

</div> <!-- /.row -->