﻿<?php
	$tab0 = base_url().'clinic';
	$tab1 = base_url().'clinic/medicalprofile';
	$tab2 = base_url().'clinic/setuptime';
	$tab3 = base_url().'clinic/faqs';
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
			  $("p").click(function(){
				$(this).hide();
			  });
			});
		
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
					<label for="settings" onclick="window.location.href=<?php echo '\''.$tab1.'\''; ?>" class='fontawesome-film'>LỊCH SỬ KHÁM BỆNH</label>
					<label for="posts" onclick="window.location.href=<?php echo '\''.$tab2.'\''; ?>" class='fontawesome-calendar'>CÀI ĐẶT THỜI GIAN</label>
					<label for="books" onclick="window.location.href=<?php echo '\''.$tab3.'\''; ?>" class='fontawesome-list-alt'>HỎI - ĐÁP</label>
				</nav>
				<div class="container">
					<div class="col-md-6">
						<h3>Lịch sử khám bệnh : <?php echo $_GET['name'];?></h3>
						<table id="myTable" class="tablesorter">

							<thead>
								<tr class="bootstrap-header">
									<td>STT</td>
									<td>Ngày khám</td>
									<td>Lí do khám</td>
								</tr>    
							</thead>
							<tbody>
								<?php
								$number = 0;
								foreach ($detailprofile as $row) {
									?>
									<tr>
										<td><?php echo $number ?></td>
										<td><?php echo $row->ngay_kham ?></td>
										<td><?php echo $row->li_do_kham ?></td>
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
					<?php
						$ngay_kham = $detailprofile[$i]
					?>
					<div class="col-md-6">
					
						<h3>Chi tiết khám ngày <?php ?></h3>
						
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="col-sm-3 control-label">Ngày khám</label>
								<div class="col-sm-7">
									<p class="form-control-static">25/5/2014<p>					
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-success" style="float:right">Tạo mới</button>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Bệnh nhân</label>
								<div class="col-sm-7">
									<p class="form-control-static">tên bệnh nhân</p>
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-success" style="float:right">Chỉnh sửa</button>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Lí do khám</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="lidokham" placeholder="Lí do khám">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Triệu chứng</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="trieuchung" placeholder="Triệu chứng">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Nhiệt độ</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="nhietdo" placeholder="Nhiệt độ">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Huyết áp</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="huyetap" placeholder="Huyết áp">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Nhịp tim</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="nhiptip" placeholder="Nhịp tim">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Chuẩn đoán</label>
								<div class="col-sm-9">
									<input type="password"  class="form-control" id="chuandoan" placeholder="Chuẩn đoán">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Lời khuyên</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="loikhuyen" placeholder="Lời khuyên">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-3 control-label">Chi phí</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="chiphi" placeholder="Chi phí">
								</div>
							</div>
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
