<?php

	$sizeall_lickham = sizeof($all_lichkham);
	$tab0 = base_url().'clinic';
	$tab1 = base_url().'clinic/medicalprofile';
	$tab2 = base_url().'clinic/setuptime';
	$tab3 = base_url().'clinic/faqs';
	if(isset($_GET['stt'])){
		$i = $_GET['stt'];
	}else{
		$i = -1;
	}
	$email = $_GET['email'];
	$name = $_GET['name'];
	$json_alllichkham = json_encode($all_lichkham);
//var_dump($detailprofile);
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
		<style>
				*{
				  -webkit-box-sizing: border-box;
					 -moz-box-sizing: border-box;
						  box-sizing: border-box;
					
				}

		</style>
		<?php
        echo loadBootstrap3_js();
        ?>
		<!-- plugin tablesorter -->
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.widgets.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.custom.js');?>"></script>
		
		<!-- add on pager plugin tablesorter -->
		<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.pager.js');?>"></script>
		<script>
			$(document).ready(function(){
				$("#submitform").hide();//hide submit form of edit view
				$( "#ngay_kham" ).change(function() {//chon ngay kham->set thoi gian kham vao #thoigiankham
					var size = <?php echo $sizeall_lickham; ?>;
					var ngay_kham = document.getElementById("ngay_kham").value;
					var all_lichkham = <?php echo $json_alllichkham;?>;
					var i = 0;
					var html = "<option value='null'>Chọn thời gian khám</option>";
					for(i;i<size;i++){
						if(all_lichkham[i].ngay_kham == ngay_kham){
							html+="<option value='"+all_lichkham[i].thoigian_batdau+"-"+all_lichkham[i].thoigian_ketthuc+"'>"+all_lichkham[i].thoigian_batdau+" - "+all_lichkham[i].thoigian_ketthuc+"</option>";
						}
					}
					if(html=="<option value='null'>Chọn thời gian khám</option>"){
						html = "<option value='null'>Không có ca khám nào</option>"
					}
					document.getElementById('thoigiankham').innerHTML=html;
				});
				$( "#thoigiankham" ).change(function() {//chon thoi gian kham in #thoigiankham -> id
					var size = <?php echo $sizeall_lickham; ?>;
					var ngay_kham = document.getElementById("ngay_kham").value;
					var thoigiankham = document.getElementById("thoigiankham").value
					var all_lichkham = <?php echo $json_alllichkham;?>;
					var i = 0;
					var html = "";
					for(i;i<size;i++){
						if(all_lichkham[i].ngay_kham == ngay_kham && all_lichkham[i].thoigian_batdau == thoigiankham.substr(0,8) ){
							$("#id_lichkham").val(all_lichkham[i].id_lichkham);
							document.getElementById('lidokham').innerHTML = all_lichkham[i].li_do_kham;
							break;
						}
					}
				});
				$( "#frm_create" ).submit(function(event) {
					var ngay_kham = document.getElementById("ngay_kham").value;
					var thoigiankham = document.getElementById("thoigiankham").value;
					var trieu_chung = document.getElementById("trieu_chung").value;
					var nhiet_do = document.getElementById("nhiet_do").value;
					var huyet_ap = document.getElementById("huyet_ap").value;
					var mach = document.getElementById("mach").value;
					var chuan_doan = document.getElementById("chuan_doan").value;
					var loi_khuyen = document.getElementById("loi_khuyen").value;
					var chi_phi = document.getElementById("chi_phi").value;
					if(ngay_kham == "" || thoigiankham == "null" || trieu_chung == "" || nhiet_do == "" || huyet_ap == "" || mach == "" || chuan_doan == "" || loi_khuyen == "" || chi_phi == ""){
						alert("Cần điền đầy đủ thông tin");
						event.preventDefault();
					}else{
						return true;
					}
				})
			});
			function openedit(){
				$("fieldset").removeAttr("disabled");
				$("#submitform").show();
			}
			function canceledit(){
				$("fieldset").attr("disabled","disabled");
				$("#submitform").hide();
			}
		</script>
    </head>
    <body>
        <div class="row" >
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
				<div class="container">
					<div class="col-md-6">
						<h3>Lịch sử khám bệnh : <?php echo $name;?></h3>
						<table id="myTable" class="tablesorter">

							<thead>
								<tr class="bootstrap-header">
									<td>STT</td>
									<td>Ngày khám</td>
									<td>Lí do khám</td>
									<td style="text-align:center;"><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Tạo mới</button></td>
								</tr>    
							</thead>
	
							<tbody>
								<?php
								$number = 0;
								foreach ($detailprofile as $row) {
									?>
									<tr <?php if($number == $i) echo "class='success'"; ?> >
										<td><?php echo $number ?></td>
										<td><?php echo $row->ngay_kham ?></td>
										<td><?php echo $row->li_do_kham ?></td>
										<td><a href="?stt=<?php echo $number; ?>&email=<?php echo $email;?>&name=<?php echo $name;?>">Chi tiết</a></td>
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
							  <input type="text" class="pagedisplay"/>
							  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/next.png');?>" class="next"/>
							  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/last.png');?>" class="last"/>
							  <select class="pagesize">
								<option selected="selected"  value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option  value="40">40</option>
							  </select>
							</form>
						</div>
					</div>
					<div class="col-md-6">
						<?php if($i != -1){ ?>
						<h3>Chi tiết khám ngày <?php  echo $detailprofile[$i]->ngay_kham;?></h3>						
						<form class="form-horizontal" method="post" action="updateData">
							<div class="form-group">
								<label class="col-sm-3 control-label">Ngày khám</label>
								<div class="col-sm-5">
									<p class="form-control-static"><?php echo $detailprofile[$i]->ngay_kham ?><p>					
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-success" onclick="openedit();">Sửa</button>
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo base_url(); ?>clinic/medicalprofile/deleteData?id_chitiet=<?php echo $detailprofile[$i]->id_chitiet;?>&email=<?php echo $email;?>&name=<?php echo $name; ?>'">Xóa</button>
								</div>
									
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Thời gian khám</label>
								<div class="col-sm-9">
									<p class="form-control-static"><?php echo $detailprofile[$i]->thoigian_batdau; echo ' - '; echo $detailprofile[$i]->thoigian_ketthuc; ?><p>					
								</div>

							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Lí do khám</label>
								<div class="col-sm-9">
									<p class="form-control-static"><?php echo $detailprofile[$i]->li_do_kham ?></p>
								</div>
							</div>
						<fieldset disabled >
							<div class="form-group">
								<label  class="col-sm-3 control-label">Triệu chứng</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="edit_trieu_chung" name="edit_trieu_chung" value="<?php echo $detailprofile[$i]->trieu_chung ?>" />
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Nhiệt độ</label>
								<div class="col-sm-3 ">
									<input type="text" class="form-control inline" id="edit_nhiet_do" name="edit_nhiet_do" value="<?php echo $detailprofile[$i]->nhiet_do; echo '°C';?>" />
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Huyết áp</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="edit_huyet_ap" name="edit_huyet_ap" value="<?php echo $detailprofile[$i]->huyet_ap ?>" />
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Nhịp tim</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="edit_mach" name="edit_mach" value="<?php echo $detailprofile[$i]->mach ;echo '/phút';?>" />
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Chuẩn đoán</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="edit_chuan_doan" name="edit_chuan_doan" value="<?php echo $detailprofile[$i]->chuan_doan?>" />
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Lời khuyên</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="edit_loi_khuyen" name="edit_loi_khuyen" value="<?php echo $detailprofile[$i]->loi_khuyen ?>" />
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Chi phí</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="edit_chi_phi" name="edit_chi_phi" value="<?php echo $detailprofile[$i]->chi_phi ?>" />
								</div>
							</div>
						</fieldset>
							<div id="submitform" style="text-align:center">
								<input type="hidden" name="edit_id_chitiet" id="edit_id_chitiet" value="<?php echo $detailprofile[$i]->id_chitiet; ?>" />
								<input type="hidden" name="edit_id_lichkham" id="edit_id_lichkham" value="<?php echo $detailprofile[$i]->id_lichkham; ?>" />
								<input type="hidden" name="email" value="<?php echo $email;?>" />
								<input type="hidden" name="name" value="<?php echo $name;?>" />
								<button type="submit" class="btn btn-primary">Lưu</button>
								<button type="button" class="btn btn-warning" onclick="canceledit();">Hủy</button>												
							</div>
						</form>
						<?php } ?>
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Tạo chi tiết khám</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" action="insertData" method="post" id="frm_create">
											<div class="form-group">
												<label class="col-sm-3 control-label">Ngày khám</label>
												<div class="col-sm-9">
													<input type="date" class="form-control" id="ngay_kham" name="ngay_kham" />					
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Thời gian khám</label>
												<div class="col-sm-9">
													<select class="form-control" name="thoigiankham" id="thoigiankham">
													</select>					
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Lí do khám</label>
												<div class="col-sm-9">
													<p class="form-control-static" id="lidokham"> </p>
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Triệu chứng</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="trieu_chung" name="trieu_chung"/>
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Nhiệt độ</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="nhiet_do" name="nhiet_do"/>
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Huyết áp</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="huyet_ap" name="huyet_ap"/>
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Nhịp tim</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="mach" name="mach" />
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Chuẩn đoán</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="chuan_doan" name="chuan_doan"/>
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Lời khuyên</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="loi_khuyen" name="loi_khuyen" />
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label">Chi phí</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="chi_phi" name="chi_phi" />
												</div>
											</div>
											<div style="text-align:center">
												<input type="hidden" name="id_chitiet" id="id_chitiet" value="" />
												<input type="hidden" name="id_lichkham" id="id_lichkham" value="" />
												<input type="hidden" name="email" value="<?php echo $email;?>" />
												<input type="hidden" name="name" value="<?php echo $name;?>" />
												<button type="submit" class="btn btn-primary">Lưu</button>
												<button type="button" class="btn btn-warning" data-dismiss="modal">Hủy</button>												
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
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
