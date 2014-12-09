<div class="col-md-12">
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<?php
				foreach($groups as $group){
					echo "<li class='".($group_to_show->id == $group->id ? "active" : "")."'><a href='".base_url()."/index.php/appointments/getRemarksCustomers/".$group->id."'>".$group->group_name."</a></li>";
				}
			?>
		</ul>
		<div class="tab-content">
			<?php
				foreach($groups as $group){
					echo "<div class='tab-pane ".($group_to_show->id == $group->id ? "active" : "")."' id='tab_".$group->id."'>";
					
					if($group_to_show->id == $group->id){
					?>
						<table class="table table-bordered table-striped table-condensed" style="margin-top:50px;">
							<thead>
							  <tr>
								<th></th>
								<th>First Name</th>
								<th>Last Name</th>
								<?php 
									for($i=0;$i<$max_appointments;$i++)
										echo "<th>Date</th><th>Note</th>";
								?>
							  </tr>
							</thead>
							<tbody>
							<?php
								
								for($i=0;$i < sizeof($customers_remarks); $i++){
									$customer = $customers_remarks[$i];
									echo "<tr>";
									echo "<td style='width: 3%; vertical-align: middle !important;'><img src='".base_url().(!empty($customer['profilephoto']) ? $customer['profilephoto'] : 'img/no_image.png')."' class='img-circle'/></td>";
									echo "<td>".$customer['firstname']."</td>";
									echo "<td>".$customer['lastname']."</td>";
									$remarks = $customer['remarks'];
									foreach($remarks as $remark)
										echo "<td>".$remark->start_date."</td><td style='width: 10%;'>".$remark->notes."</td>";
									echo "</tr>";
								}
							?>
							</tbody>
						</table>
					<?php
					}
					
					echo "</div>";
				}
			?>
			
		</div><!-- /.tab-content -->
	</div><!-- nav-tabs-custom -->
</div><!-- /.col -->