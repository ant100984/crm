<div class="row">
	<div class="col-md-12">
		<form role="form" action="<?php echo base_url() . "/index.php/newsletter/saveNewsletter"; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" id="newsletter_id" name="newsletter_id" value="<?php if(!empty($loaded_newsletter->id)) echo $loaded_newsletter->id; ?>"/>
			<div class="box-body">
				<span class="pull-right">
					<?php 
						if(!empty($loaded_newsletter->id)) 
							if($loaded_newsletter->status == "DRAFT") 
								echo "Status: <span class='badge'>".$loaded_newsletter->status."</span> last modified by <strong>".$loaded_newsletter->usercreated." ".$loaded_newsletter->dtmcreated."</strong>";
							else if($loaded_newsletter->status == "TO BE SENT") 
									echo "Status: <span class='badge bg-blue'>".$loaded_newsletter->status."</span> by <strong>".$loaded_newsletter->usersent." ".$loaded_newsletter->dtmsent."</strong>";
								else if($loaded_newsletter->status == "SENT") 
									echo "Status: <span class='badge bg-green'>".$loaded_newsletter->status."</span> by <strong>".$loaded_newsletter->usersent." ".$loaded_newsletter->dtmsent."</strong>";
					?>
				</span>
				<?php
					$editable = false;
					if(empty($loaded_newsletter->id) || ($loaded_newsletter->status == "DRAFT")){
						$editable = true;
				?>
				<div class="form-group">
					<div class="box-body">
						<input id="save" name="save" type="submit" class="btn btn-success" value="SAVE DRAFT"/>
						<input id="send" name="send" type="submit" class="btn btn-warning" value="SEND"/>
					</div>
				</div>
				<?php
					}
				?>
				<label for="template">Templates</label>
				<div class="input-group">
					<select name="template" id="template" class="form-control" <?php if(!$editable) echo "disabled"; ?>>
						<option value="" ></option>
						<?php foreach($templates as $template){
							echo "<option ".((!empty($loaded_newsletter) && $loaded_newsletter->template_id == $template->id) ? "selected" : "")." value='".$template->id."'>".$template->title."</option>";
						}
						?>
					</select>
					<div class="input-group-btn">
					
						<a id="load_template" name="load_template" role="button" class="btn btn-info <?php if(!$editable) echo "disabled"; ?>" >Load Template</a>
					
					</div>
				</div>
			
			</div><!-- /.box-body -->

			<div class='box'>
				<div class='box-header'>
					<h3 class='box-title'>Edit the newsletter body</h3>
					<!-- tools box -->
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-default btn-sm" data-widget='collapse' data-toggle="tooltip"><i class="fa fa-minus"></i></button>
					</div><!-- /. tools -->
				</div><!-- /.box-header -->
				<div class='box-body pad'>
					
					<textarea <?php if(!$editable) echo "disabled"; ?> name="newsletter_body" id="newsletter_body" class="textarea"><?php if(!empty($loaded_newsletter->id)) echo $loaded_newsletter->body; ?></textarea>
					
					<input disabled="true" class="form-control" type="text" id="template_title" required name="template_title" placeholder="Enter a title..."/>
					<label>
						<input <?php if(!$editable) echo "disabled"; ?> type="checkbox" id="save_as_template" name="save_as_template"/>
						Save as template
					</label>
				</div>
				<div class="overlay body-overlay" style="display: none;"></div>
				<div class="loading-img body-loading-img" style="display: none;"></div>
			</div>
			<div class="box">
				<div class="box-header">
					<i class="fa fa-book"></i>
					<h3 class="box-title">Attachments</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-default btn-sm" data-widget='collapse' data-toggle="tooltip"><i class="fa fa-minus"></i></button>
					</div><!-- /. tools -->
				</div>
				<div class="box-body">
					<table class="table table-bordered" style="margin-top:50px; width: 500px; margin-bottom: 20px;">
						<tbody>
						<?php 
						if(isset($attachments)){
							foreach($attachments as $attachment){ ?>
							  <tr>
								<td><?php echo $attachment->filename; ?></td>
								<td>
									<a href="" class="btn btn-xs btn-neutral" role="button"><span class="glyphicon glyphicon-search"></span> View</a>
									<?php if($editable) { ?>
										<a href="<?php echo base_url() . "/index.php/newsletter/deleteAttachment/".$attachment->id."/".$attachment->newsletter_id; ?>" class="btn btn-xs btn-danger" role="button"><span class="glyphicon glyphicon-trash"></span> Delete</a>
									<?php } ?>
								</td>
							  </tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
					<?php if($editable) { ?>
						<input type="file" name="attachment" id="attachment" style="display: inline;"/>
						<input id="upload" name="upload" type="submit" class="btn btn-success" value="UPLOAD"/>
					<?php } ?>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
	if(!empty($loaded_newsletter->id)){
?>
<div class="row">
	<?php if($editable) { ?>
	<div class="col-md-9">
		<div class='box'>
			<div class='box-header'>
				<h3 class='box-title'>Send the newsletter to:</h3>
				<div class="pull-right box-tools">
					<button type="button" class="btn btn-default btn-sm" data-widget='collapse' data-toggle="tooltip"><i class="fa fa-minus"></i></button>
				</div><!-- /. tools -->
			</div>
			<div class="box-body">
				<?php
					
					require_once('customersList.php');
					
				?>
			</div>
			<div class="overlay" style="display: none;"></div>
			<div class="loading-img" style="display: none;"></div>
		</div>
	</div>
	<?php } ?>
	<div class="col-md-3">
			
		<div class='box'>
			<div class='box-header'>
				<h3 class='box-title'>Selected customers:</h3>
				<div class="pull-right box-tools">
					<button type="button" class="btn btn-default btn-sm" data-widget='collapse' data-toggle="tooltip"><i class="fa fa-minus"></i></button>
				</div><!-- /. tools -->
			</div>
			<div class="box-body" id="selected_customers">
				<?php require_once('selectedCustomers.php'); ?>
			</div>
		</div>
			
	</div>
</div>
<?php
}
?>
<script type="text/javascript">
	
	$(function() {
		
		CKEDITOR.replace('newsletter_body');
		
		$('#save_as_template').on('ifChecked', function(event){
			$('#template_title').prop('disabled', false);
		});
			
		$('#save_as_template').on('ifUnchecked', function(event){
			$('#template_title').prop('disabled', true);
			$('#template_title').val("");
		});
		
		$("#load_template").click(function(){
			var val = $("#template").val();
			
			$.ajax({
			  type: "POST",
			  url: "<?php echo base_url() . "/index.php/newsletter/loadTemplate"; ?>",
			  data: {id: val},
			  beforeSend: function(){
				$('.body-overlay').show();
				$('.body-loading-img').show();
			  }
			}).done(function(data) {
				
				CKEDITOR.instances["newsletter_body"].setData(data);
				$('.body-overlay').hide();
				$('.body-loading-img').hide();
			});
		});
		
	});
        
</script>