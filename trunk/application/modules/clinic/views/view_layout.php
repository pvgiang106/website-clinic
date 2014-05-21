﻿<?php
	$tab0 = base_url().'clinic';
	$tab1 = base_url().'clinic/medicalprofile';
	$tab2 = base_url().'clinic/setuptime';
	$tab3 = base_url().'clinic/faqs';

?>
<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />
	<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/dhtmlxscheduler.js'); ?>" ></script>
	<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/ext/dhtmlxscheduler_limit.js'); ?>" ></script>
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/dhtmlxscheduler.css'); ?>" />
	
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/style_menuclinic.css'); ?>" />
	<?php
        //echo loadBootstrap3_css();
    ?>
	<style>
		body{
			width:1170px;
			margin:auto;
			background: #EBF3EC;
			font-size:14px;
		}
		/*style for timeavailable in view */
		.green_section {
			background-color: #12be00;
			opacity: 0.25;
			filter:alpha(opacity=25);
			border-bottom:solid 1px #000000;
		}
		/*style for appointment in view */
		.my_event {
			background-color: #add8e6;
			border: 1px solid #778899;
			height:20px !important;
			overflow: hidden;
		}
		.my_event .event_date {
			font-weight: bold;
			padding-right: 5px;
		}

	</style>
	<script>
		function change_mp_email(){
			var email = document.getElementById('mp_email').value;
			window.location.href="medicalprofile?email="+email;
		}
	</script>
<?php
    $this->load->view($module . '/' . $view_file);
?>
</head>
    <body onload="init();" ><!-- Menu 2 -->
<section>
	<input type="radio" style="display:none;" id="profile" value="1" name="tractor" <?php if($tab == 0) echo "checked='checked'"; ?> />    
	<input type="radio" style="display:none;" id="settings" value="2" name="tractor"  <?php if($tab == 1) echo "checked='checked'"; ?> />      
	<input type="radio" style="display:none;" id="posts" value="3" name="tractor"  <?php if($tab == 2) echo "checked='checked'"; ?> />
	<input type="radio" style="display:none;" id="books" value="4" name="tractor"  <?php if($tab == 3) echo "checked='checked'"; ?> />
	
	<nav>   
		<label for="profile"  onclick="window.location.href=<?php echo '\''.$tab0.'\''; ?>" class='fontawesome-camera-retro'>DANH SÁCH CUỘC HẸN</label>
		<label for="settings" onclick="window.location.href=<?php echo '\''.$tab1.'\''; ?>" class='fontawesome-film'>LỊCH SỬ KHÁM BỆNH</label>
		<label for="posts" onclick="window.location.href=<?php echo '\''.$tab2.'\''; ?>" class='fontawesome-calendar'>CÀI ĐẶT THỜI GIAN</label>
		<label for="books" onclick="window.location.href=<?php echo '\''.$tab3.'\''; ?>" class='fontawesome-list-alt'>HỎI - ĐÁP</label>
	</nav>
	<!-- Appoitment tab -->
	<?php if($tab == 0) {?>
	<?php } ?>
	<!-- Medical Profile tab -->
	<?php if($tab == 1){ ?>
		<lable> Email: 
		<select name="mp_email" id="mp_email" onchange="change_mp_email();">
		<?php foreach($allemail as $row) { ?>
			<option value="<?php echo $row->email ;?>" <?php if(isset($_GET['email']) && $row->email == $_GET['email']) {echo 'selected="selected"';}?>><?php echo $row->email ;?></option>
		<?php } ?>
		</select>
	</lable>
	<?php } ?>
	<!-- Setuptime tab -->
	<?php if($tab == 2) { ?>
	
	<?php } ?>
	<!-- Waiting appointment tab -->
	<?php if($tab == 3) { ?>
	
	<?php } ?>
	
	<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:90%;'>
		<div class="dhx_cal_navline">
			<div class="dhx_cal_prev_button">&nbsp;</div>
			<div class="dhx_cal_next_button">&nbsp;</div>
			<div class="dhx_cal_today_button"></div>
			<div class="dhx_cal_date"></div>
			<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
			<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
			<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
		</div>
		<div class="dhx_cal_header"></div>
		<div class="dhx_cal_data"></div>       
	</div>
</section>

	
		
	</body>
</html>
