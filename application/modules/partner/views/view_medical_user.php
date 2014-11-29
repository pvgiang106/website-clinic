<?php
	$tab0 = base_url().'clinic';
	$tab1 = base_url().'clinic/medicalprofile';
	$tab2 = base_url().'clinic/faqs';
	$name = $this->session->userdata['logged_in']['name'];
	
	//var_dump($info_user);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />        <!--bootstrap-->
        <?php
        //echo loadBootstrap3_css();
        ?>
        <!-- bootstrap widget theme -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/theme.bootstrap.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/jquery.tablesorter.pager.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/style_menuclinic.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/bootstrap.css'); ?>" />
		<?php
        echo loadBootstrap3_js();
        ?>
		<style>
				*{
				  -webkit-box-sizing: border-box;
					 -moz-box-sizing: border-box;
						  box-sizing: border-box;
					
				}
		</style>
		<!-- plugin tablesorter -->
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.widgets.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.custom.js');?>"></script>
		
		<!-- add on pager plugin tablesorter -->
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.pager.js');?>"></script>
    </head>
    <body>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"  style="width:1170px;margin:auto;">
    <ul class="nav navbar-nav navbar-right">
        <li><a style="color: #104AD3;" href='<?php echo base_url(); ?>'><?php echo $name ?></a></li>
        <li class="dropdown">
          <a  style="color: rgba(0,0,0,.4);" href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href='<?php echo site_url("login/login/logout") ?>'>Logout</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
    </ul>
 </div>
        <div class="row" >
            <section>
				<input type="radio" style="display:none;" id="profile" value="1" name="tractor" <?php if($tab == 0) echo "checked='checked'"; ?> />    
				<input type="radio" style="display:none;" id="settings" value="2" name="tractor"  <?php if($tab == 1) echo "checked='checked'"; ?> />      
				<input type="radio" style="display:none;" id="books" value="3" name="tractor"  <?php if($tab == 2) echo "checked='checked'"; ?> />
				
				<nav>   
					<label for="profile"  onclick="window.location.href=<?php echo '\''.$tab0.'\''; ?>" class='fontawesome-calendar'>QUẢN LÝ CUỘC HẸN</label>
					<label for="settings" onclick="window.location.href=<?php echo '\''.$tab1.'\''; ?>" class='fontawesome-film'>QUẢN LÝ BỆNH NHÂN</label>
					<label for="books" onclick="window.location.href=<?php echo '\''.$tab2.'\''; ?>" class='fontawesome-list-alt'>HỎI - ĐÁP</label>
				</nav>
				<div class="container">
						<h3>Danh sách bệnh nhân</h3>
						<table id="myTable" class="tablesorter">

							<thead>
								<tr class="bootstrap-header">
									<td>STT</td>
									<td>Tên</td>
									<td>Email</td>
									<td>Số điện thoại</td>
									<td>Địa chỉ</td>
									<td>Giới tính</td>
									<td>Chi tiết</td>
								</tr>    
							</thead>
							<tbody>
								<?php
								$number = 0;
								foreach ($info_user as $row) {
									?>
									<tr  onclick="window.location='medicalprofile/medicaluserprofile?email=<?php echo $row->email ?>&name=<?php echo $row->mid_name; echo ' '; echo $row->name; ?>'">
										<td><?php echo $number ?></td>
										<td><?php echo $row->mid_name; echo ' '; echo $row->name; ?></td>
										<td><?php echo $row->email ?></td>
										<td><?php echo $row->phone ?></td>
										<td><?php echo $row->address; echo ', '; echo $row->district; echo ', '; echo $row->provice ?></td> 
										<td><?php echo $row->sex ?></td>
										<td ><a class="btn btn-primary" href="medicalprofile/medicaluserprofile?email=<?php echo $row->email ?>&name=<?php echo $row->mid_name; echo ' '; echo $row->name; ?>" >Xem</a>  <a href="<?php echo base_url()."clinic/medicalprofile/deleteUser?email=".$row->email ?>" class="btn btn-danger">Xóa</a> </td>
									</tr>  
									<?php
									$number += 1;
								}
								?>
							</tbody>
						</table>
					
					<div class="pager">
						<form>
						  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/first.png');?>" class="first"/>
						  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/prev.png');?>" class="prev"/>
						  <input type="text" class="pagedisplay" style="text-align:center" />
						  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/next.png');?>" class="next"/>
						  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/last.png');?>" class="last"/>
						  <input class="pagesize" value="10" type="hidden">
						  </input>
						</form>
					</div>
				</div>
			</section>
        </div>
		
        <script type="text/javascript">
            $(document).ready(function() {
                 $("table").tablesorter().tablesorterPager({container: $(".pager")});    
            }); 
        
        </script>
    </body>
</html>
