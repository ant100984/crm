<div class="row">
  <div class="col-md-12">
		<!--
		<form class="form-inline" role="form" method="post" action="<?php echo base_url(); echo "/index.php/messages"; ?>">

			<label for="group">Group</label>
			<select name="group" class="form-control">
				<option value=""></option>
				<?php
					foreach($groups as $group){
						echo "<option ".($group->id == $filter_group ? 'selected' : '')." value='".$group->id."'>".$group->group_name."</option>";
					}
				?>
			</select>
			
			<label for="direction">Direction</label>
			<select name="direction" class="form-control">
				<option value="" <?php if(empty($filter_direction)) echo "selected"; ?>>All Messages</option>
				<option value="S" <?php if($filter_direction == 'S') echo "selected"; ?>>Sent</option>
				<option value="R" <?php if($filter_direction == 'R') echo "selected"; ?>>Received</option>
			</select>
			
			<button type="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search"></span> Filter
			</button>
			
		</form>
		-->
		<!-- Chat box -->
		<div class="box box-success">
			<form role="form" method="post" action="<?php echo base_url() . "/index.php/messages/sendMessage"; ?>">
				<div class="box-header">
					<i class="fa fa-comments-o"></i>
					<h3 class="box-title">Messages</h3>
				</div>
				<div class="box-body chat" id="chat-box" style="max-height: 500px; min-height: 500px;">
					<div class="row">
						<div class="col-md-8" id="messages_list" style="max-height: 500px; min-height: 500px; overflow-y: scroll;">
							
							<?php
							
								require("messagesList.php");
							
							?>
							
						</div>
						<div class="col-md-4">
							<?php
								$CUSTOMER_WIDGET_BUTTON_LABEL = "Choose a customer&nbsp;";
								$CUSTOMER_WIDGET_CLOSEABLE = FALSE;
								$CUSTOMER_WIDGET_LIST_HEIGHT = 400;
								$CUSTOMER_WIDGET_UPDATE_MESSAGES_LIST = TRUE;
								require("customerWidget.php");
								
							?>
						</div>
					</div>
				</div><!-- /.chat -->
				<div class="box-footer">
					
						<div class="input-group">
							<input type="text" name="message_text" id="message_text" class="form-control" placeholder="Type message..." required/>
							<div id="send_div" class="input-group-btn">
								<input <?php if(empty($loaded_customer->id)) echo "disabled='disabled'"; ?> id="send_message" name="send_message" type="submit" class="btn btn-success" value="SEND"/>
							</div>
						</div>
				</div>
				<div class="overlay messages_overlay" style="display: none;"></div>
				<div class="loading-img messages_loading" style="display: none;"></div>
			
			</form>
		</div>
	</div>
	
</div><!-- /.box (chat box) --> 
<script type="text/javascript">

	function refreshMessages(){
	
		setInterval(function () {
		
			filterMessages();
			
		}, 10000);
	
	}
	
	refreshMessages();
	scrollMessagesToBottom(true);
	
	$('.unread_message').waypoint(function() {
	
		if($(this).hasClass("unread_message")){
			
			var val = $(this).attr("message_id");
			var message_item = $(this);
			
			$.ajax({
			  type: "POST",
			  url: "<?php echo base_url() . "/index.php/messages/setMessageRead"; ?>",
			  data: {message_id: val}
			}).done(function(data) {
			
				message_item.removeClass("unread_message", 1000);
				
			});
			
		}
	
	}, { context: '#messages_list', offset: '500' });
	
</script>