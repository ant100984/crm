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
				<button class="btn btn-default btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
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
	<div class='box'>
		<div class='box-header'>
			<h3 class='box-title'>Send the newsletter to:</h3>
		</div>
		<div class="box-body">
			<form class="form-inline" role="form" method="post">

				<input name="fps_number" type="text" class="form-control" id="fps_number" placeholder="First Name" value="">
				<input name="userId" type="text" class="form-control" id="vm_identifier" placeholder="Last Name" value="">
				
				<label for="member">Gender</label>
				<select name="member" class="form-control">
					<option value="1" >Male</option>
					<option value="-1" >Female</option>
				</select>
				
				<label for="member">Group</label>
				<select name="member" class="form-control">
					<option value="1">Group A</option>
					<option value="-1">Group B</option>
					<option value="-1">Group C</option>
				</select>
				
				<button type="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span> Filter
				</button>
				
			</form>
			
			<table class="table table-bordered table-striped table-condensed" style="margin-top:50px;">
				<thead>
				  <tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Home Address</th>
					<th>Office Address</th>
					<th>Group</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>Antonio</td>
					<td>Esposito</td>
					<td>M</td>
					<td>I Trv Giulio Cesare 11</td>
					<td>N.d.</td>
					<td>A</td>
				  </tr>
				
					<tr>
					<td>Test</td>
					<td>User1</td>
					<td>F</td>
					<td>Test address 1</td>
					<td>Test address 2</td>
					<td>B</td>
				  </tr>
				  
				  <tr>
					<td>Test</td>
					<td>User2</td>
					<td>M</td>
					<td>Test address 3</td>
					<td>Test address 4</td>
					<td>A</td>
				  </tr>
				
				</tbody>
			  </table>
		</div><!-- /.box-body -->
	</div>
</form>

<script type="text/javascript">
	
	$(function() {
		
		CKEDITOR.replace('newsletter_body');
		
	});
        
</script>