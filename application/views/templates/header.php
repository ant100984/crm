<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jsetec Customer Relationship Manager</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <!-- jvectormap -->
        <link href="<?php echo base_url();?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo base_url();?>css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap time Picker -->
        <link href="<?php echo base_url();?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Daterange picker -->
        <link href="<?php echo base_url();?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url();?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- CRM css -->
		<link href="<?php echo base_url();?>css/main.css" rel="stylesheet" type="text/css" />
			
		<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
		
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
		
		<!-- waypoint plugin -->
		<script src="<?php echo base_url();?>js/plugins/waypoints/waypoints.min.js" type="text/javascript"></script>
		
		<!-- CK editor -->
		<script src="//cdn.ckeditor.com/4.4.6/standard/ckeditor.js"></script>
		<script type="text/javascript">
			function ceckUnreadMessages(){
				var val = <?php echo $userid; ?>;
				
				$.ajax({
				  type: "POST",
				  url: "<?php echo base_url() . "/index.php/messages/getUnreadMessages"; ?>",
				  data: {user_id: val}
				}).done(function(data) {
					$('#unread_messages').html(data);
				});
			}
			
			function refreshUnreadMessages(){
	
				setInterval(function () {
				
					ceckUnreadMessages();
					
				}, 10000);
			
			}
			
			function ceckUnreadNotifications(){
				$.ajax({
				  type: "POST",
				  url: "<?php echo base_url() . "/index.php/crmusers/getUnreadNotifications"; ?>"
				}).done(function(data) {
					$('#unread_notifications').html(data);
				});
			}
			
			function refreshUnreadNotifications(){
	
				setInterval(function () {
				
					ceckUnreadNotifications();
					
				}, 10000);
			
			}
			
			refreshUnreadMessages();
			refreshUnreadNotifications();
			
		</script>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url();?>index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                JsetecCRM
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu" id="unread_messages">
                            <?php
								require_once('unreadMessages.php');
							?>
                        </li>
						<!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu" id="unread_notifications">
                            <?php
								require_once('unreadNotifications.php');
							?>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $username; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
									
									<?php if(!in_array("manage_crmusers",$user_permissions)){ ?>
									
										<div class="pull-left">	
											<a href="<?php echo base_url()."/index.php/crmusers/index/".$userid; ?>" class="btn btn-default btn-flat">Profile</a>
										</div>
										
									<?php }else{ ?>
									
										<div class="pull-left">
											<a href="<?php echo base_url()."/index.php/crmusers"; ?>" class="btn btn-default btn-flat">CRM Users</a>
										</div>
										
									<?php } ?>
									
                                    <div class="pull-right">
                                        <a href="<?php echo base_url()."/index.php/logout"; ?>" class="btn btn-danger btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>