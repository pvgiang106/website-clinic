<?php
	$tab0 = base_url().'clinic';
	$tab1 = base_url().'clinic/medicalprofile';
	$tab2 = base_url().'clinic/faqs';
	$json_allmedicine = json_encode($allMedicine);
	$number_medicine = sizeof($allMedicine);
	$name = $this->session->userdata['logged_in']['name'];
	if(isset($_GET['option'])){ $view = $_GET['option'];}else{$view = 'appointment';};
	//var_dump($allCustomer);
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
	<script>
		function show_div_create(){
			$('#div_create').show();
			$("#div_detail").hide();			
		};
		function remove_thuoc(id,ten){
				var tmp = "<label class=\"btn btn-danger\" style=\"color:#000000;width:30px\" onclick=\"remove_thuoc("+id+",&quot;"+ten+"&quot;)\">Xoá</label><p style=\"color:#000000;padding-left:100px;\">"+ten+"</p>";
				var html = document.getElementById('div_thuoc').innerHTML;
				html = html.replace(tmp,"");
				var arrId_thuoc = document.getElementById("arrId_thuoc").value;
				var str_remove = id+";";
				arrId_thuoc = arrId_thuoc.replace(str_remove,"")
				 document.getElementById("arrId_thuoc").value = arrId_thuoc;
				document.getElementById('div_thuoc').innerHTML = html;
			};
		$(document).ready(function(){
			var html = "";
			var arrId_thuoc = "";
			var current = "";	
			var status_themthuoc = "";
			var allMedicine = <?php echo $json_allmedicine; ?>;
			var size = <?php echo $number_medicine ; ?>;
			$("#them_thuoc").click(function(){
				if( document.getElementById('id_lichkham').value != current){
					current =  document.getElementById('id_lichkham').value;
					html = "";
					arrId_thuoc = "";				
				}else{
					html = document.getElementById('div_thuoc').innerHTML;
					arrId_thuoc = document.getElementById("arrId_thuoc").value ;
				}
				var id_thuoc = document.getElementById("thuoc").value;
				var i = 0;
				for(i;i<size;i++){
					if(id_thuoc == allMedicine[i].id_thuoc){
						if(html.search(allMedicine[i].ten_thuoc) == -1){
							status_themthuoc = "<p>Đã thêm "+allMedicine[i].ten_thuoc+" vào toa thuốc </p>";
							document.getElementById('status_themthuoc').innerHTML = status_themthuoc;
							arrId_thuoc+= allMedicine[i].id_thuoc+";"
							html += "<label class='btn btn-danger' style='color:#000000;width:30px' onclick='remove_thuoc("+allMedicine[i].id_thuoc+",\""+allMedicine[i].ten_thuoc+"\")'>Xoá</label><p style='color:#000000;padding-left:100px;' >"+allMedicine[i].ten_thuoc+"</p>";
							document.getElementById('div_thuoc').innerHTML = html;
							document.getElementById("arrId_thuoc").value = arrId_thuoc;
							break;
						}
					}
				}				
			});
			$("#view_toathuoc").click(function(){
				if( document.getElementById('id_lichkham').value != current){
					current =  document.getElementById('id_lichkham').value;

					document.getElementById('div_thuoc').innerHTML = "";
					document.getElementById("arrId_thuoc").value = "";
				}
			});
		$( "#tao_appointment" ).submit(function(event) {
			var ngay_kham = document.getElementById("tao_ngaykham").value;
			var thoigiankham = document.getElementById("tao_thoigian").value;
			var li_do = document.getElementById("tao_lido").value;
			if(ngay_kham == "" || thoigiankham == "null" || li_do == ""){
				alert("Cần điền đầy đủ thông tin");
				event.preventDefault();
			}else{
				return true;
			}
		});
		$( "#tk_appointment" ).submit(function(event) {
			var ngay_kham = document.getElementById("tk_ngaykham").value;
			var thoigiankham = document.getElementById("tk_thoigian").value;
			var li_do = document.getElementById("tk_lido").value;
			if(ngay_kham == "" || thoigiankham == "null" || li_do == ""){
				alert("Cần điền đầy đủ thông tin");
				event.preventDefault();
			}else{
				return true;
			}
		});
			
		});
	</script>

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
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li><a style="color: #104AD3;" href='<?php echo base_url(); ?>'><?php echo $name ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href='<?php echo site_url("login/login/logout") ?>'>Logout</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
    </ul>
 </div>
<section>
	<input type="radio" style="display:none;" id="profile" value="1" name="tractor" <?php if($tab == 0) echo "checked='checked'"; ?> />    
	<input type="radio" style="display:none;" id="settings" value="2" name="tractor"  <?php if($tab == 1) echo "checked='checked'"; ?> />      
	<input type="radio" style="display:none;" id="books" value="3" name="tractor"  <?php if($tab == 2) echo "checked='checked'"; ?> />
	
	<nav>   
		<label for="profile"  onclick="window.location.href=<?php echo '\''.$tab0.'\''; ?>" class='fontawesome-calendar'>QUẢN LÝ CUỘC HẸN</label>
		<label for="settings" onclick="window.location.href=<?php echo '\''.$tab1.'\''; ?>" class='fontawesome-film'>QUẢN LÝ BỆNH NHÂN</label>
		<label for="books" onclick="window.location.href=<?php echo '\''.$tab2.'\''; ?>" class='fontawesome-list-alt'>HỎI - ĐÁP</label>
	</nav>

	<div style="padding-top:20px;padding-left:20px;">
		<button type="button" class="btn btn-default<?php if($view=='appointment') echo ' active'?>" onclick="window.location.href='?option=appointment'" >Quản lý cuộc hẹn</button>
		<button type="button" class="btn btn-default<?php if($view=='setuptime') echo ' active'?>" onclick="window.location.href='?option=setuptime'" >Cài đặt thời gian</button>
		
	</div>
	<div class="col-sm-7">
	<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:84%'>
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
			<li class="active"><a href="#taikham" data-toggle="tab">CHI TIẾT CUỘC HẸN</a></li>
			<li ><a href="#detail" data-toggle="tab">TẠO CHI TIẾT KHÁM</a></li>
		 
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane" id="detail">
				<h3>Chi tiết khám <?php  ?></h3>						
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" style="color:#000000;">Ngày khám</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="ngay_kham" name="ngay_kham" value="" disabled/>					
						</div>					
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" style="color:#000000;">Thời gian khám</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="thoigian" name="thoigian" value="" disabled/>					
						</div>

					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lí do khám</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="lidokham" name="lidokham" value="<?php  ?>" disabled/>
						</div>
					</div>
				</form>
				<form class="form-horizontal" method="post" action="clinic/createDetail">
				<fieldset >
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Triệu chứng</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="trieu_chung" name="trieu_chung" value="<?php  ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Nhiệt độ</label>
						<div class="col-sm-7 ">
							<input type="text" class="form-control inline" id="nhiet_do" name="nhiet_do" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Huyết áp</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="huyet_ap" name="huyet_ap" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Nhịp tim</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="mach" name="mach" value="<?php ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Chuẩn đoán</label>
						<div class="col-sm-7">
							<textarea class="form-control" rows="3" id="chuan_doan" name="chuan_doan" value="<?php ?>" /></textarea>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lời khuyên</label>
						<div class="col-sm-7">
							<textarea rows="3" class="form-control" id="loi_khuyen" name="loi_khuyen" value="<?php  ?>" /></textarea>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Chi phí</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="chi_phi" name="chi_phi" value="<?php  ?>" />
						</div>
					</div>
					<div class="form-group">
						<div >
							<label  class = "col-sm-3 control-label btn btn-default" style="color:#000000;" data-toggle="modal" data-target="#myModal" id="view_toathuoc">Toa thuốc</label>
						</div>
						<div class="col-sm-5">
							<select class="form-control" id="thuoc" name="thuoc" >
								<?php foreach($allMedicine as $tmp) {?>
								<option value="<?php echo $tmp->id_thuoc ; ?>"><?php echo $tmp->ten_thuoc;  ?></option>
								<?php } ?>
							</select>
						</div>
						<div >
							<label class = "col-sm-1 control-label btn btn-default" id="them_thuoc" style="color:#000000;">Thêm</label>
						</div>
						
					</div>	
					<div class="form-group" id="status_themthuoc">
					</div>
				</fieldset>
					<div id="submitform" style="text-align:center">
						<input type="hidden" name="arrId_thuoc" id="arrId_thuoc" value="" />
						<input type="hidden" name="id_chitiet" id="id_chitiet" value="" />
						<input type="hidden" name="id_lichkham" id="id_lichkham" value="" />
						<input type="hidden" name="email" id="email" value="" />
						<button type="submit" class="btn btn-primary">Lưu</button>
						<button type="reset" class="btn btn-danger" onclick="">Hủy</button>												
					</div>
				</form>
			</div>
			<div class="tab-pane active" id="taikham">
				<h3>Chi tiết cuộc hẹn</h3>
				<form class="form-horizontal" name="ct_appointment" id="ct_appointment" method="post" action="clinic/deleteData">
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;"><a id="link_user" href="">Bệnh nhân</a></label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="benhnhan" name="benhnhan" value="<?php  ?>" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Email</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="ct_email" name="ct_email" value="<?php  ?>" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Ngày khám</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="ct_ngay_kham" name="ct_ngay_kham" value="<?php  ?>" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Thời gian</label>
						<div class="col-sm-7 ">
							<input type="text" class="form-control inline" id="ct_thoi_gian" name="ct_thoi_gian" value="<?php ?>" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lí do khám</label>
						<div class="col-sm-7">
							<textarea rows="3" type="text" class="form-control" id="ct_lido" name="ct_lido" value="<?php ?>" disabled/></textarea>
						</div>
					</div>
					<div class="form-group" id="frm_gr_huy">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lí do hủy</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="ct_lidohuy" name="ct_lidohuy" value=""/>
						</div>
					</div>
					<div style="text-align:right">
						<input type="hidden" name="ct_id_lichkham" id="ct_id_lichkham" value="" />
						<input type="hidden" name="ct_ngaykham" id="ct_ngaykham" value="" />
						<input type="hidden" name="ct_thoigian" id="ct_thoigian" value="" />
						<input type="hidden" name="ct_email" id="ct_email" value="" />
						<button type="button" class="btn btn-primary" onclick="show_div_create();" >Thêm mới</button>
						<button type="submit" class="btn btn-danger" id="del_appointment">Hủy</button>
					</div>
				</form>
				<h3>Hẹn lịch tái khám</h3>
				<form class="form-horizontal" name="tk_appointment" id="tk_appointment" method="post" action="clinic/hentaikham">
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Ngày tái khám</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="tk_ngaykham" name="tk_ngay" value="<?php  ?>" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Thời gian</label>
						<div class="col-sm-7 ">
							<select class="form-control" id="tk_thoigian" name="tk_thoigian" >
							</select>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lí do</label>
						<div class="col-sm-7">
							<textarea rows="3" type="text" class="form-control" id="tk_lido" name="tk_lido" value="<?php ?>" /></textarea>
						</div>
					</div>
					<div style="text-align:right">
						<input type="hidden" name="tk_email" id="tk_email" value="" />
						<input type="hidden" name="tk_id_lichkham" id="tk_id_lichkham" value="" />
						<button type="submit" class="btn btn-primary">Lưu</button>
						<button type="reset" class="btn btn-danger" >Hủy</button>		
					</div>
				</form>
			</div>
		</div>		
	</div>
	<div class="col-sm-4" id="div_create" style="";>
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#create" data-toggle="tab">TẠO CUỘC HẸN</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="create">
				<h3>Chi tiết cuộc hẹn</h3>
				<form class="form-horizontal" name="tao_appointment" id="tao_appointment" method="get" action="clinic/taocuochen">
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Bệnh nhân</label>
						<div class="col-sm-7">
							<select class="form-control" id="tao_benhnhan" name="tao_benhnhan" >
								<option value="noname">Chọn bệnh nhân</option>
								<?php foreach($allCustomer as $tmp) {?>
								<option value="<?php echo $tmp->email; ?>"><?php echo $tmp->mid_name;echo ' '; echo $tmp->name  ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Email</label>
						<div class="col-sm-7">
							<select class="form-control" id="tao_email" name="tao_email" >
								<option value="noname">Chọn Email</option>
								<?php foreach($allCustomer as $tmp) { ?>
								<option value="<?php echo $tmp->email; ?>"><?php echo $tmp->email; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Ngày khám</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="tao_ngaykham" name="tao_ngaykham" value="<?php  ?>" />
						</div>
					</div>
			
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Thời gian</label>
						<div class="col-sm-7 ">
							<select class="form-control" id="tao_thoigian" name="tao_thoigian" >
							</select>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label" style="color:#000000;">Lí do</label>
						<div class="col-sm-7">
							<textarea rows="3" type="text" class="form-control" id="tao_lido" name="tao_lido" value="<?php ?>" ></textarea>
						</div>
					</div>
					<div style="text-align:right">
						<button type="submit" class="btn btn-primary">Lưu</button>
						<button type="reset" class="btn btn-danger" >Hủy</button>		
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Toa thuốc</h4>
	  </div>
	  <div class="modal-body" id="div_thuoc">
		
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	  </div>
	</div>
  </div>
</div>

		
	</body>
</html>
