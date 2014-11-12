<div class="form-group">
	<?php
		if(!empty($CUSTOMER_WIDGET_FIELD_LABEL))
			echo "<label>".$CUSTOMER_WIDGET_FIELD_LABEL."</label>";
	?>
	<div class="input-group">
		<div class="input-group-btn">
			<button id="openChooseCustomer" type="button" class="btn btn-info btn-flat">
				<?php
					if(!empty($CUSTOMER_WIDGET_BUTTON_LABEL))
						echo $CUSTOMER_WIDGET_BUTTON_LABEL;
					else
						echo "Choose&nbsp;";
				?>
				<i id="customer_dropdown_icon" class="fa fa-caret-down"></i>
			</button>
		</div>
		<input readonly required id="customer_name" name="customer_name" type="text" class="form-control" value="<?php if(!empty($loaded_appointment->user_id)) echo $loaded_appointment->firstname." ".$loaded_appointment->lastname; if(!empty($loaded_customer->id)) echo $loaded_customer->firstname." ".$loaded_customer->lastname; ?>">
		<div class="input-group-btn">
			<button id="resetCustomer" type="button" class="btn btn-danger btn-flat">
				<i id="customer_reset_icon" class="fa fa-times"></i>
			</button>
		</div>
		<input id="customer_id" name="customer_id" type="hidden" value="<?php if(!empty($loaded_appointment->user_id)) echo $loaded_appointment->user_id; if(!empty($loaded_customer->id)) echo $loaded_customer->id; ?>">
	</div>
</div>
<div id="customer_list" class="box box-solid box-info" style="<?php if(!empty($CUSTOMER_WIDGET_CLOSEABLE) && $CUSTOMER_WIDGET_CLOSEABLE) echo "display: none;"; ?>">
	<div class="box-header">
		<h4 class="box-title">Select the customer</h4>
		<?php if(!empty($CUSTOMER_WIDGET_CLOSEABLE) && $CUSTOMER_WIDGET_CLOSEABLE) { ?>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-info btn-sm" id="close_customer_list"><i class="fa fa-times"></i></button>
			</div>
		<?php
		}
		?>
	</div><!-- /.box-header -->
	<div class="box-body no-padding" style="min-height: <?php if(empty($CUSTOMER_WIDGET_LIST_HEIGHT)) echo "200px;"; else echo $CUSTOMER_WIDGET_LIST_HEIGHT."px;"; ?> max-height: <?php if(empty($CUSTOMER_WIDGET_LIST_HEIGHT)) echo "200px;"; else echo $CUSTOMER_WIDGET_LIST_HEIGHT."px;"; ?> overflow-y: auto;">
		<div class="input-group">
			<input class="form-control" type="text" value="" id="customer_filter" name="customer_filter" placeholder="Filter the customer list..."/>
			<div class="input-group-addon">
				<i class="fa fa-search"></i>
			</div>
		</div>
		<div class="box">
			<table id="customers_list_table" class="table table-hover table-condensed">
				<?php
					require("customersTableContent.php");
				?>
			</table>
			<div class="overlay customers_overlay" style="display: none;"></div>
			<div class="loading-img customers_loading" style="display: none;"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function disableSendButton(){
		$("#send_message").attr('disabled','disabled');
	}
	
	function enableSendButton(){
		$("#send_message").removeAttr("disabled");
	}
	
	function chooseCustomer(id, name){
		$('#customer_id').val(id);
		$('#customer_name').val(name);
		closeChooseCustomer();
		
		<?php if(!empty($CUSTOMER_WIDGET_UPDATE_MESSAGES_LIST)){ ?>
		
				filterMessages();
				enableSendButton();
				
		<?php } ?>
		
	}
	
	function filterMessages(){
		var val = $('#customer_id').val();
				
		$.ajax({
		  type: "POST",
		  url: "<?php echo base_url() . "/index.php/messages/filterMessages"; ?>",
		  data: {user_id: val},
		  beforeSend: function(){
			$.waypoints('destroy');
			$('#messages_list').scrollTop(0);
			
			$('.messages_overlay').show();
			$('.messages_loading').show();
		  }
		}).done(function(data) {
			$('#messages_list').html(data);
			$('.messages_overlay').hide();
			$('.messages_loading').hide();
		
			$('.unread_message').waypoint(function(direction) {
	
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
			
		});
	}
	
	function openChooseCustomer(){
		$('#customer_list').slideDown("fast");
		$('.choose_customer_overlay').show();
	}
	
	function closeChooseCustomer(){
		<?php if(!empty($CUSTOMER_WIDGET_CLOSEABLE) && $CUSTOMER_WIDGET_CLOSEABLE == TRUE){ ?>
			$('#customer_list').slideUp("fast");
			$('.choose_customer_overlay').hide();
		<?php
		}
		?>
	}
	
	function filterCustomers(){
		var val = $('#customer_filter').val();
			
		$.ajax({
		  type: "POST",
		  url: "<?php echo base_url() . "/index.php/customers/filterCustomers"; ?>",
		  data: {filter_string: val},
		  beforeSend: function(){
			$('.customers_overlay').show();
			$('.customers_loading').show();
		  }
		}).done(function(data) {
			$('#customers_list_table').html(data);
			$('.customers_overlay').hide();
			$('.customers_loading').hide();
		});
	}
	
	$(function() {
		<?php if(!empty($CUSTOMER_WIDGET_UPDATE_MESSAGES_LIST)){ ?>
			$("#send_div").mouseover(function(){
				if($("#send_message").attr("disabled") == "disabled"){
					$("#send_div").popover("show");					
				}
			});			
		<?php
		}
		?>
		
		$('#resetCustomer').click(function(){
			$('#customer_name').val('');
			$('#customer_id').val('');
			<?php if(!empty($CUSTOMER_WIDGET_UPDATE_MESSAGES_LIST)){ ?>
				filterMessages();
				disableSendButton();
			<?php 
			} 
			?>
			
		});
		
		$('#customer_name').click(function(){
			if($('#customer_list').is(':visible'))
				closeChooseCustomer();
			else
				openChooseCustomer();
		});
		
		$('#openChooseCustomer').click(function(){
			if($('#customer_list').is(':visible'))
				closeChooseCustomer();
			else
				openChooseCustomer();
		});
			
		$('#close_customer_list').click(function(){
			closeChooseCustomer();			
		});
		
		$('#customer_filter').keyup(function(){
		
			filterCustomers();
			
		});
		
		$('#customer_filter').mouseup(function(){
		
			filterCustomers();
		
		});
	});
</script>