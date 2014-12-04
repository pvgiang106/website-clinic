<?php
    if(!isset($tab_active)){
        $tab = 0;
    }else{
        $tab = $tab_active;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />        <!--bootstrap-->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        
        <!--custome css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.css" />
    <script type="text/javascript">
        $( document ).ready(function() {
      		$("#del_search").click(funtion(){
      		   $("#cu_search").val('');
      		});	
		});
    </script>
    </head>
    <body>
       	<div class="container-fluid">            
            <div class="row" id="header">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-6"><img src="<?php echo base_url(); ?>assets/img_logo.png" /></div>
                    <div class="col-md-6" id="setting">
                        <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false"><?php echo $user['email'] ?><img src="<?php echo base_url(); ?>assets/icon_setting.png" /></button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="#">Edit Details</a></li>
                                <li><a href="#">Transaction</a></li>
                                <li><a href="#">New Password</a></li>
                                <li><a href="<?php echo base_url() ?>login/logout">Log Out</a></li>
                                
                            </ul>
                    </div><!-- /.col-lg-6 -->
                    </div>
                <div class="row">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="header_nav">
                    <li role="presentation" <?php if($tab == 0) echo "class='active'";?>><a href="#business_partner"role="tab" data-toggle="tab">Business Partners</a></li>
                    <li role="presentation" <?php if($tab == 1) echo "class='active'";?>><a href="#customer" role="tab" data-toggle="tab">Customer</a></li>
                    </ul>                
                </div>
                </div>                
            </div>
            <div class="row" id="content">
                 <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane <?php if($tab == 0) echo "active";?>" id="business_partner">
                        <?php
                            $this->load->view($module . '/' . $view_partner);
                         ?>	
                    </div>
                    <div role="tabpanel" class="tab-pane <?php if($tab == 1) echo "active";?>" id="customer">
                        <?php
                            $this->load->view($module . '/' . $view_customer);
                         ?>	              
                    </div>
                  </div>
            </div>
            <div class="row" id="footter">
            
            </div>
        </div>
    </body>
</html>
