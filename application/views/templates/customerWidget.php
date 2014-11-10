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
		<input readonly required id="customer_name" name="customer_name" type="text" class="form-control" value="<?php if(!empty($loaded_appointment->customer_id)) echo $loaded_appointment->firstname." ".$loaded_appointment->lastname; ?>">
		<div class="input-group-btn">
			<button id="resetCustomer" type="button" class="btn btn-danger btn-flat">
				<i id="customer_reset_icon" class="fa fa-times"></i>
			</button>
		</div>
		<input id="customer_id" name="customer_id" type="hidden" value="<?php if(!empty($loaded_appointment->customer_id)) echo $loaded_appointment->customer_id; ?>">
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
	<div class="box-body no-padding" style="min-height: <?php if(!empty($CUSTOMER_WIDGET_LIST_HEIGHT)) echo "200px;"; else echo $CUSTOMER_WIDGET_LIST_HEIGHT."px;"; ?> max-height: <?php if(!empty($CUSTOMER_WIDGET_LIST_HEIGHT)) echo "200px;"; else echo $CUSTOMER_WIDGET_LIST_HEIGHT."px;"; ?> overflow-y: visible;">
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
	function chooseCustomer(id, name){
		$('#customer_id').val(id);
		$('#customer_name').val(name);
		closeChooseCustomer();
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
		
		$('#resetCustomer').click(function(){
			$('#customer_name').val('');
			$('#customer_id').val('');
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