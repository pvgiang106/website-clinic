<?php
	$info = $info_phongkham[0];
	$info_user = $info_user_phongkham[0];
	//var_dump($info);
?>
<form class="form-horizontal" method="post" action="verifyUpdateclinic">
	<div class="col-sm-6">
	<h3>Thông tin phòng khám </h3>
			<fieldset style="padding-top:2em;">
			<div class="form-group">
				<label class="col-sm-4 control-label" style="color:#000000;">Tên phòng khám</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="name" name="name" value="<?php echo $info->name; ?>" />					
				</div>					
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" style="color:#000000;">Số điện thoại</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $info->phone; ?>" />					
				</div>					
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Đường</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="street" name="street" value="<?php echo $info->address; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Quận/ Huyện</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="district" name="district" value="<?php echo $info->district; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Tỉnh/ Thành phố</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="provice" name="provice" value="<?php echo $info->provice; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Chuyên khoa</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="feature" name="feature" value="<?php echo $info->feature; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Website</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="website" name="website" value="<?php echo $info->website; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Ngày hết hạn</label>
				<div class="col-sm-7">
					<input type="date" class="form-control" id="expire_day" name="expire_day" value="<?php echo $info->expire_day; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Kinh độ</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="toadoY" name="toadoY" value="<?php echo $info->toadoY; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-4 control-label" style="color:#000000;">Vĩ độ</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="toadoX" name="toadoX" value="<?php echo $info->toadoX; ?>" />
				</div>
			</div>
		</fieldset>
	</div>
	<div class="col-sm-6">
		<h3>Thông tin đăng nhập</h3>
			<fieldset style="padding-top:2em;">
				<div class="form-group">
					<label class="col-sm-3 control-label" style="color:#000000;">Email</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="email" name="email" value="<?php echo $info_user->email; ?>" />					
					</div>					
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" style="color:#000000;">Mật khẩu(md5)</label>
					<div class="col-sm-8">
						<p><?php echo $info_user->password; ?></p>					
					</div>
				</div>
			</fieldset>
		
	</div>
	<div class="col-sm-11" style="padding-top:20px;padding-left:40px;letter-spacing:20px;">
		<input type="hidden" id="register_day" name="register_day" value="<?php echo date('Y-m-d'); ?>" >
		<input type="hidden" id="id_phongkham" name="id_phongkham" value="<?php echo $info->id_phongkham; ?>" >
		<button type="submit" class="btn btn-primary" >Lưu</button>
		<button type="reset" class="btn btn-danger" onclick="window.location.href='./'">Hủy</button>
	</div>
	</div>
	</div>
</form>	