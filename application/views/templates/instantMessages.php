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
			<div class="box-header">
				<i class="fa fa-comments-o"></i>
				<h3 class="box-title">Messages</h3>
			</div>
			<div class="box-body chat" id="chat-box"  style="max-height: 500px; min-height: 500px;">
				<div class="row">
					<div class="col-md-8">
						
						<?php
						
							require("messagesList.php");
						
						?>
						
					</div>
					<div class="col-md-4">
						<?php
							$CUSTOMER_WIDGET_BUTTON_LABEL = "Choose a customer&nbsp;";
							$CUSTOMER_WIDGET_CLOSEABLE = FALSE;
							$CUSTOMER_WIDGET_LIST_HEIGHT = 400;
							require("customerWidget.php");
							
						?>
					</div>
				</div>
			</div><!-- /.chat -->
			<div class="box-footer">
				<div class="input-group">
					<input class="form-control" placeholder="Type message..."/>
					<div class="input-group-btn">
						<button class="btn btn-success">SEND&nbsp;&nbsp;&nbsp;<i class="fa fa-comment"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div><!-- /.box (chat box) --> 
<script type="text/javascript">
</script>