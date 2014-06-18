<?php
	$tab0 = base_url().'admin';
	$tab1 = base_url().'index.php/admin/adminclinic';
	$tab2 = base_url().'index.php/admin/adminmedicine';
	$name = $this->session->userdata['logged_in']['name'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />        <!--bootstrap-->
        <?php
        echo loadBootstrap3_css();
        ?>
        <!-- bootstrap widget theme -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/theme.bootstrap.css'); ?>" />
        <!--<link rel="stylesheet" href="<?php //echo base_url('/assets/systemfile/css/jquery.tablesorter.pager.css'); ?>" />-->
       
        <?php
        echo loadBootstrap3_js();
        ?>
	<script type="text/javascript">
		$( document ).ready(function() {
			$("#add_medicine").show()
			$("#update_medicine").hide();
			$("#them_thuoc").submit(function(event){
				var ten_thuoc = document.getElementById("tao_tenthuoc").value;
				var donvidung = document.getElementById("tao_don_vi_dung").value;
			if(ten_thuoc == "" || donvidung == ""){
				alert("Cần nhập đủ thông tin");
				event.preventDefault();
			}else{
				return true;
			}
			});
			$("#capnhat_thuoc").submit(function(event){
				var capnhat_ten_thuoc = document.getElementById("capnhat_tenthuoc").value;
				var capnhat_donvidung = document.getElementById("capnhat_don_vi_dung").value;
			if(capnhat_ten_thuoc == "" || capnhat_donvidung == ""){
				alert("Thông tin sửa không chính xác");
				event.preventDefault();
			}else{
				return true;
			}
			});
		});
		function addMedicine(){
			$("#add_medicine").show();
			$("#update_medicine").hide();
		}
		function updateMedicine(id_thuoc,ten_thuoc,sang,trua,toi,donvidung){
			$("#add_medicine").hide();
			$("#update_medicine").show();

			document.getElementById("capnhat_tenthuoc").value = ten_thuoc;
			if(sang==1){
				document.getElementById("capnhat_sang").checked = true;
			}else{
				document.getElementById("capnhat_sang").checked = false;
			}
			
			if(trua==1){			
				document.getElementById("capnhat_trua").checked = true;
			}else{
				document.getElementById("capnhat_trua").checked = false;
			}
			if(toi==1){
				document.getElementById("capnhat_toi").checked = true;
			}else{
				document.getElementById("capnhat_toi").checked = false;
			}
			document.getElementById("capnhat_don_vi_dung").value = donvidung;
			document.getElementById("id_thuoc").value = id_thuoc;
		};
	</script>
<!-- plugin tablesorter -->
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.widgets.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.custom.js');?>"></script>
<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/style_menuclinic.css'); ?>" />
<!-- add on pager plugin tablesorter -->
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.pager.js');?>"></script>
    </head>
    <body style="background-color:#EBF3EC;padding-top:20px;">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="width:1170px;margin:auto;">
			<ul class="nav navbar-nav navbar-right">
				<li><a style="color: #104AD3;" href='<?php echo base_url(); ?>'><?php echo $name ?></a></li>
				<li class="dropdown">
				  <a style="color: rgba(0,0,0,.4);" href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href='<?php echo site_url("login/login/logout") ?>'>Logout</a></li>
					<li><a href="#">Something else here</a></li>
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
				  </ul>
				</li>
			</ul>
	</div>
        <section >		
            <input type="radio" style="display:none;" id="profile" value="1" name="tractor" <?php if($tab == 0) echo "checked='checked'"; ?> />    
			<input type="radio" style="display:none;" id="settings" value="2" name="tractor"  <?php if($tab == 1) echo "checked='checked'"; ?> />
			<input type="radio" style="display:none;" id="books" value="3" name="tractor"  <?php if($tab == 2) echo "checked='checked'"; ?> />			
			<nav>   
				<label for="profile"  onclick="window.location.href=<?php echo '\''.$tab0.'\''; ?>" class='fontawesome-camera-retro'>QUẢN LÍ NGƯỜI DÙNG</label>
				<label for="settings" onclick="window.location.href=<?php echo '\''.$tab1.'\''; ?>" class='fontawesome-film'>QUẢN LÍ PHÒNG KHÁM</label>
				<label for="books" onclick="window.location.href=<?php echo '\''.$tab2.'\''; ?>" class='fontawesome-list-alt'>QUẢN LÍ THUỐC</label>

			</nav>
			<div class="row" >
            <?php
            $this->load->view($module . '/' . $view_file);
            ?>
            </div>
        </section>

        <script type="text/javascript">
            $(document).ready(function() {
                 $("table").tablesorter().tablesorterPager({container: $(".pager")});    
            }); 
        
        </script>
    </body>
</html>
