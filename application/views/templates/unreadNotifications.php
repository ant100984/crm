<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="read_notifications">
	<i class="fa fa-warning"></i>
	<span class="label label-warning"><?php echo $num_notifications; ?></span>
</a>
<ul class="dropdown-menu" style="overflow-y: scroll;">
	<li class="header">You have <?php echo $num_notifications . ($num_notifications == 1 ? ' unread notification' : ' unread notifications'); ?></li>
	<li>
		<!-- inner menu: contains the actual data -->
		<ul class="menu">
			<?php
			foreach($notifications as $notification){
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
	</li>
	<li class="footer"><a href="<?php echo base_url()."index.php/notifications"; ?>">See All Notifications</a></li>
</ul>