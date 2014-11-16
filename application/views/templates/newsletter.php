<form role="form" action="<?php echo base_url() . "/index.php/newsletter/saveNewsletter"; ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" id="newsletter_id" name="newsletter_id" value="<?php if(!empty($loaded_newsletter->id)) echo $loaded_newsletter->id; ?>"/>
	<div class="box-body">
		<div class="form-group">
			<div class="box-body">
				<input type="submit" class="btn btn-warning" value="SEND"/>
			</div>
		</div>
		<div class="form-group">
			<label for="template">Templates</label>
			<select name="template" id="template" class="form-control">
				<option value="" ></option>
				<?php foreach($templates as $template){
					echo "<option ".((!empty($loaded_newsletter) && $loaded_newsletter->template_id == $template->id) ? "selected" : "")." value='".$template->id."'>".$template->title."</option>";
				}
				?>
			</select>
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
			<!-- style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" -->
			<textarea name="newsletter_body" id="newsletter_body" class="textarea"><?php if(!empty($loaded_newsletter->id)) echo $loaded_newsletter->body; ?></textarea>
		</div>
		<div class="box-body">
			<input id="save" name="save" type="submit" class="btn btn-success" value="SAVE"/>
		</div>
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
							<a href="<?php echo base_url() . "/index.php/newsletter/deleteAttachment/".$attachment->id."/".$attachment->newsletter_id; ?>" class="btn btn-xs btn-danger" role="button"><span class="glyphicon glyphicon-trash"></span> Delete</a>
						</td>
					  </tr>
				<?php
					}
				}
				?>
				</tbody>
			</table>
			<input type="file" name="attachment" id="attachment" style="display: inline;"/>
			<input id="upload" name="upload" type="submit" class="btn btn-success" value="UPLOAD"/>
		</div>
	</div>
</form>
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

<script type="text/javascript">
	
	$(function() {
		
		CKEDITOR.replace('newsletter_body');
		
	});
        
</script>