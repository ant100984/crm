<table class="table table-hover table-condensed">
<?php
	foreach($newsletter_customers as $nc){
		echo "<tr>";
		echo "<td>". $nc->firstname . " " . $nc->lastname ."</td>";
		echo "<td>". ($nc->status == "NOT_SENT" ? "Not sent" : "Sent" ) ."</td>";
		echo "<td>";
		if(!isset($editable) || (isset($editable) && $editable))
			echo "<a href='".base_url() . "/index.php/newsletter/deleteCustomerNewsletter/".$nc->id."/".$nc->newsletter."' role='button' class='btn btn-xs btn-danger pull-right'><span class='glyphicon glyphicon-trash'></span></a>";
		echo "</td>";
		echo "</tr>";
	}
?>
</table>