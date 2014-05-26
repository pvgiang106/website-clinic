﻿<?php
	$tab0 = base_url().'clinic';
	$tab1 = base_url().'clinic/medicalprofile';
	$tab2 = base_url().'clinic/setuptime';
	$tab3 = base_url().'clinic/faqs';
	if(isset($_GET['option'])){ $view = $_GET['option'];}else{$view = 'appointment';};
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
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/bootstrap.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/style_menuclinic.css'); ?>" />
	<?php
        //echo loadBootstrap3_css();
		echo loadBootstrap3_js();
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
			overflow: hidden;
		}
		.my_event .event_date {
			font-weight: bold;
			padding-right: 5px;
		}

	</style>

<?php
	switch($view){
		case 'appointment':
			$view_file = 'view_appointment';
			break;
		case 'detail':
			break;
		case 'setuptime':
			$view_file = 'view_set_available_time';
			break;
		case 'confirm':
			$view_file = 'view_waiting_appointment';
			break;
	}
	//var_dump($view_file);
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
		<label for="settings" onclick="window.location.href=<?php echo '\''.$tab1.'\''; ?>" class='fontawesome-film'>QUẢN LÝ BỆNH NHÂN</label>
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
	<div>
		<button type="button" class="btn btn-default<?php if($view=='appointment') echo ' active'?>" onclick="window.location.href='?option=appointment'" >Danh sách cuộc hẹn</button>
		<button type="button" class="btn btn-default<?php if($view=='setuptime') echo ' active'?>" onclick="window.location.href='?option=setuptime'" >Cài đặt thời gian</button>
		<button type="button" class="btn btn-default<?php if($view=='confirm') echo ' active'?>" onclick="window.location.href='?option=confirm'" >Xác nhận cuộc hẹn</button>
	</div>
	<div class="col-sm-7">
	<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:85%'>
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
	</div>
	<div class="col-sm-4" id="div_detail" style="display:none";>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#detail" data-toggle="tab">TẠO CHI TIẾT KHÁM</a></li>
		  <li><a href="#taikham" data-toggle="tab">HẸN LỊCH TÁI KHÁM</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="detail">
				<h3>Chi tiết khám <?php  ?></h3>						
				<form class="form-horizontal" method="post" action="updateData">
					<div class="form-group">
						<label class="col-sm-3 control-label" style="color:#000000;">Ngày khám</label>
						<div class="col-sm-7">
							<p class="form-control-static"><?php   ?><p>					
						</div>					
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" style="color:#000000;">Thời gian khám</label>
						<div class="col-sm-7">
							<p class="form-control-static"><?php ?><p>					
						</div>

					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lí do khám</label>
						<div class="col-sm-7">
							<p class="form-control-static"><?php  ?></p>
						</div>
					</div>
				<fieldset >
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Triệu chứng</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_trieu_chung" name="edit_trieu_chung" value="<?php  ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Nhiệt độ</label>
						<div class="col-sm-7 ">
							<input type="text" class="form-control inline" id="edit_nhiet_do" name="edit_nhiet_do" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Huyết áp</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_huyet_ap" name="edit_huyet_ap" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Nhịp tim</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_mach" name="edit_mach" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Chuẩn đoán</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_chuan_doan" name="edit_chuan_doan" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lời khuyên</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_loi_khuyen" name="edit_loi_khuyen" value="<?php  ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Chi phí</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_chi_phi" name="edit_chi_phi" value="<?php  ?>" />
						</div>
					</div>
				</fieldset>
					<div id="submitform" style="text-align:center">
						<input type="hidden" name="edit_id_chitiet" id="edit_id_chitiet" value="<?php ?>" />
						<input type="hidden" name="edit_id_lichkham" id="edit_id_lichkham" value="<?php ?>" />
						<input type="hidden" name="email" value="<?php ?>" />
						<input type="hidden" name="name" value="<?php ?>" />
						<button type="submit" class="btn btn-primary">Lưu</button>
						<button type="button" class="btn btn-warning" onclick="canceledit();">Hủy</button>												
					</div>
				</form>
			</div>
			<div class="tab-pane" id="taikham">
				<h3>Hẹn lịch tái khám</h3>
				<form class="form-horizontal" method="post" action="updateData">
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Triệu chứng</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_trieu_chung" name="edit_trieu_chung" value="<?php  ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Nhiệt độ</label>
						<div class="col-sm-7 ">
							<input type="text" class="form-control inline" id="edit_nhiet_do" name="edit_nhiet_do" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Huyết áp</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_huyet_ap" name="edit_huyet_ap" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Nhịp tim</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="edit_mach" name="edit_mach" value="<?php ?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</div>
</section>

	
		
	</body>
</html>