<div class="row">
  <div class="col-md-9">
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
				<option value="" <? if(empty($filter_direction)) echo "selected"; ?>>All Messages</option>
				<option value="S" <? if($filter_direction == 'S') echo "selected"; ?>>Sent</option>
				<option value="R" <? if($filter_direction == 'R') echo "selected"; ?>>Received</option>
			</select>
			
			<button type="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search"></span> Filter
			</button>
			
		</form>
		
		<!-- Chat box -->
		<div class="box box-success">
			<div class="box-header">
				<i class="fa fa-comments-o"></i>
				<h3 class="box-title">Messages</h3>
			</div>
			<div class="box-body chat" id="chat-box">
				<!-- chat item -->
				<div class="item">
					<img src="img/avatar.png" alt="user image" class="online"/>
					<p class="message">
						<a href="#" class="name">
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
							Test User1
						</a>
						Lorem ipsum dolor sit amet
					</p>
				</div><!-- /.item -->
				<!-- chat item -->
				<div class="item">
					<img src="img/avatar2.png" alt="user image" class="offline"/>
					<p class="message">
						<a href="#" class="name">
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
							Test User2
						</a>
						Lorem ipsum dolor sit amet
					</p>
				</div><!-- /.item -->
				<div class="item">
					<img src="img/avatar5.png" alt="user image" class="online"/>
					<p class="message">
						<a href="#" class="name">
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:25</small>
							Admin <span class="badge bg-green">you</span>
						</a>
						Lorem ipsum dolor sit amet
					</p>
				</div><!-- /.item -->
				<!-- chat item -->
				<div class="item">
					<img src="img/avatar3.png" alt="user image" class="offline"/>
					<p class="message">
						<a href="#" class="name">
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
							Test User3
						</a>
						Lorem ipsum dolor sit amet
					</p>
				</div><!-- /.item -->
			</div><!-- /.chat -->
			<div class="box-footer">
				<div class="input-group">
					<input class="form-control" placeholder="Type message..."/>
					<div class="input-group-btn">
						<button class="btn btn-success"><i class="fa fa-plus"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.box (chat box) --> 