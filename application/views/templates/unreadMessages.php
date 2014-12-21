<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-envelope"></i>
	<span class="label label-success"><?php echo $num_messages; ?></span>
</a>
<ul class="dropdown-menu" style="overflow-y: scroll;">
	<li class="header">You have <?php echo $num_messages . ($num_messages == 1 ? ' unread message' : ' unread messages'); ?> </li>
	<li>
		<!-- inner menu: contains the actual data -->
		<ul class="menu">
			<?php
			foreach($messages as $message){
			?>
				<li><!-- start message -->
					<a href="#">
						<div class="pull-left">
							<img src="<?php echo base_url().$message->sender_photo; ?>" class="img-circle" alt="User Image"/>
						</div>
						<h4>
							<?php echo $message->sender_firstname.' '.$message->sender_lastname; ?>
							<small><i class="fa fa-clock-o"></i><?php echo $message->datesent; ?></small>
						</h4>
						<p><?php echo $message->messagetext; ?></p>
					</a>
				</li><!-- end message -->
			<?php
			}
			?>
		</ul>
	</li>
	<li class="footer"><a href="<?php echo base_url()."index.php/messages"; ?>">See All Messages</a></li>
</ul>