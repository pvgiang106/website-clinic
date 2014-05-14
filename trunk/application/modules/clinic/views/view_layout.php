<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />
	<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/dhtmlxscheduler.js'); ?>" ></script>
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/dhtmlxscheduler.css'); ?>" />

	<style>
		body{
			height:1000px;
			width:1170px;
			margin:auto;
		}
	</style>
<?php
    $this->load->view($module . '/' . $view_file);
?>
</head>
    <body onload="init();" >
	
	<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
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
		
	</body>
</html>
