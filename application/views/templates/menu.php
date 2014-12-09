<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url().$profile_photo;?>" class="img-circle" alt="User Image" />
				</div>
				<div class="pull-left info">
					<p>Hello, <?php echo $displayname; ?></p>
				</div>
			</div>
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="active">
					<a href="<?php echo base_url();?>index.php">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				<?php if(in_array("manage_customers",$user_permissions)){ ?>
				<li class="treeview <?php if(!empty($menu_active) && $menu_active == "customers") echo "active"; ?>">
					<a href="#">
						<i class="fa fa-user"></i>
						<span>Customers</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li><a href="<?php echo base_url();?>index.php/customers/getCustomer"><i class="fa fa-angle-double-right"></i>Create Customer</a></li>
						<li><a href="<?php echo base_url();?>index.php/customers"><i class="fa fa-angle-double-right"></i>Customers List</a></li>
						<li><a href="<?php echo base_url();?>index.php/groups"><i class="fa fa-angle-double-right"></i>Manage Groups</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if(in_array("manage_messages",$user_permissions) || in_array("manage_newsletters",$user_permissions)){ ?>
				<li class="treeview <?php if(!empty($menu_active) && $menu_active == "messaging") echo "active"; ?>">
					<a href="#">
						<i class="fa fa-comment"></i>
						<span>Messaging</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php if(in_array("manage_messages",$user_permissions)){ ?>
							<li><a href="<?php echo base_url();?>index.php/messages"><i class="fa fa-angle-double-right"></i> Instant Messages</a></li>
						<?php } ?>
						<?php if(in_array("manage_newsletters",$user_permissions)){ ?>
							<li><a href="<?php echo base_url();?>index.php/newsletter"><i class="fa fa-angle-double-right"></i>Create Newsletter</a></li>
							<li><a href="<?php echo base_url();?>index.php/newsletter/archive"><i class="fa fa-angle-double-right"></i>Newsletters Archive</a></li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
				<?php if(in_array("manage_appointments",$user_permissions)){ ?>
				<li class="treeview <?php if(!empty($menu_active) && $menu_active == "appointments") echo "active"; ?>">
					<a href="#">
						<i class="fa fa-calendar"></i>
						<span>Appointments</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li><a href="<?php echo base_url();?>index.php/appointments/getAppointment"><i class="fa fa-angle-double-right"></i> Manage Appointments</a></li>
						<li><a href="<?php echo base_url();?>index.php/appointments/getRemarksCustomers"><i class="fa fa-angle-double-right"></i> Remarks list</a></li>
					</ul>					
				</li>
				
				<?php } ?>				
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php echo $location; ?>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active"> Dashboard</li>
			</ol>
		</section>
				
				<!-- Main content -->
                <section class="content">
					
					<?php
						if(!empty($warning_messages))
							foreach($warning_messages as $warning){
								echo "<div class='row outcome_message'>";
									echo "<div class='col-md-6'>";
										echo "<div class='alert alert-warning alert-dismissable'>";
											echo "<i class='fa fa-ban'></i>";
											echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
											echo $warning;
										echo "</div>";
									echo "</div>";
								echo "</div>";
							}
					?>
					
					<?php
						if(!empty($error_messages))
							foreach($error_messages as $error){
								echo "<div class='row outcome_message'>";
									echo "<div class='col-md-6'>";
										echo "<div class='alert alert-danger alert-dismissable'>";
											echo "<i class='fa fa-ban'></i>";
											echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
											echo $error;
										echo "</div>";
									echo "</div>";
								echo "</div>";
							}
					?>
					
					<?php
						if(!empty($success_messages))
							foreach($success_messages as $message){
								echo "<div class='row outcome_message'>";
									echo "<div class='col-md-6'>";
										echo "<div class='alert alert-success alert-dismissable'>";
											echo "<i class='fa fa-check'></i>";
											echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
											echo $message;
										echo "</div>";
									echo "</div>";
								echo "</div>";							
							}
					?>