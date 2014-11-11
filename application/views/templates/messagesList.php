<?php
	if(sizeof($instant_messages) == 0)
		echo "<h5>No messages to show</h5>";
		
	foreach($instant_messages as $message){
?>
		<div class="item">
			<?php 
				echo "<img src='".base_url().$message->sender_photo."' alt='user image' class='online'/>";
			?>
			<p class="message">
				<?php 
					if($message->sender_type != "crmuser"){
				?>
						<a href="#" class="name" style="display: inline !important;">
							<?php echo $message->sender_firstname." ".$message->sender_lastname; ?>											
						</a>
				<?php
				}else{
				
						echo $message->sender_firstname." ".$message->sender_lastname; ?>
				
				<?php
				}
				
				if($message->sender_type == "crmuser") 
						echo "<small class='badge bg-green'>You</small>";
				?>
				&nbsp;to&nbsp;
				<?php 
					if($message->receiver_type != "crmuser"){
				?>
						<a href="#" class="name" style="display: inline !important;">
							<?php echo $message->receiver_firstname." ".$message->receiver_lastname; ?>											
						</a>
				<?php
				}else{
				
						echo $message->receiver_firstname." ".$message->receiver_lastname; ?>
				
				<?php
				}
				
				if($message->receiver_type == "crmuser") 
						echo "<small class='badge bg-green'>You</small>";
				?>
				
				<small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $message->datesent; ?></small></br>
				<?php echo $message->messagetext; ?>
			</p>
		</div>
<?php
	}
?>