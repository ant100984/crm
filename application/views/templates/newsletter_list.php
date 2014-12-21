<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-condensed" style="margin-top:50px;">
			<thead>
			  <tr>
				<th>Status</th>
				<th>Customers</th>
				<th>Sent by</th>
				<th>Template</th>
				<th>Last Modified by</th>
				<th></th>
			  </tr>
			</thead>
			<tbody>
				<?php foreach($newsletters as $newsletter){
					echo "<tr>";
					echo "<td>";
					if($newsletter->status == "DRAFT")
						echo "<span class='badge'>".$newsletter->status."</span>";
					else if($newsletter->status == "TO BE SENT")
							echo "<span class='badge bg-blue'>".$newsletter->status."</span>";
						else if($newsletter->status == "SENT")
								echo "<span class='badge bg-green'>".$newsletter->status."</span>";
								
					echo "</td>";
					echo "<td>".$newsletter->customers."</td>";
					echo "<td>".$newsletter->usersent." ".$newsletter->dtmsent."</td>";
					echo "<td>".$newsletter->template_name."</td>";
					echo "<td>".$newsletter->usercreated." ".$newsletter->dtmcreated."</td>";
					echo "<td>";
					echo "<a href='".base_url()."index.php/newsletter/index/{$newsletter->id}' class='btn btn-xs btn-info' role='button'><span class='glyphicon glyphicon-pencil'></span> Details</a>";
					if($newsletter->status == "DRAFT")
						echo "<a href='".base_url()."index.php/newsletter/delete/{$newsletter->id}' onclick='return askConfirm();' class='btn btn-xs btn-danger' role='button'><span class='glyphicon glyphicon-trash'></span> Delete</a>";
					echo "</td>";
					echo "</tr>";
				} ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	function askConfirm(){
		var result = confirm("Are you sure? The operation is not reversible.");
		return result;
	}
</script>