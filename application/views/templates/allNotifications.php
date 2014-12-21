<ul>
<?php
foreach($all_notifications as $notification){
?>
	<li>
		<small><i class="fa fa-clock-o"></i><?php echo $notification->ndate; ?></small>
		<a href="javascript:void(0);">
			<i class="fa fa-warning danger"></i><?php echo $notification->text; ?>
		</a>
	</li>
<?php
}
?>
</ul>