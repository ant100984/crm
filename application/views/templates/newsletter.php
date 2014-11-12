<div class="box-body">
	<div class="form-group">
		<label for="member">Templates</label>
		<select name="member" class="form-control">
			<option value="" ></option>
			<?php foreach($templates as $template){
				echo "<option value='".$template->id."'>".$template->title."</option>";
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
		<form>
			<textarea id="newsletter_body" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
		</form>
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
			  <tr>
				<td>Message_to_the_customers.pdf</td>
				<td>
					<a href="" class="btn btn-xs btn-neutral" role="button"><span class="glyphicon glyphicon-search"></span> View</a>
					<a href="" class="btn btn-xs btn-danger" role="button"><span class="glyphicon glyphicon-trash"></span> Delete</a>
				</td>
			  </tr>
			</tbody>
		</table>
		<a href="" class="btn btn-xs btn-success" role="button"><span class="glyphicon glyphicon-plus"></span>Attach file</a>
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
<div class="box-body">
	<button class="btn btn-success btn-lg">SEND</button>
</div>

<script type="text/javascript">
	
	$(function() {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('newsletter_body');
		
	});
        
</script>