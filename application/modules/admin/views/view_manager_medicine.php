<!-- start -->
<?php $i = 0; ?>
<script type="text/javascript">
	
</script>
<div class="container">
<div class="col-sm-7">
    <h3>Danh mục thuốc</h3>
   
    <table id="myTable" class="tablesorter">
        <thead>
            <tr class="bootstrap-header">
                <td>STT</td>
                <td>Mã thuốc</td>
                <td>Tên thuốc</td>
                <td>Sáng</td>
                <td>Trưa</td>
                <td>Tối</td>
				<td>Đơn vị dùng</td> 
            </tr>    
        </thead>
        <tbody>
            <?php
            $number = 0;
            foreach ($result as $row) {
                ?>
                <tr id="<?php echo $row->id_thuoc; ?>" onclick="updateMedicine(<?php echo $row->id_thuoc.','; echo '\''.$row->ten_thuoc.'\','; echo $row->sang.',';echo $row->trua.',';echo $row->toi.',';	echo '\''.$row->don_vi_dung.'\'';?>);">
                    <td><?php echo $number ?></td>
                    <td><?php echo $row->id_thuoc ?></td>
                    <td><?php echo $row->ten_thuoc ?></td>
                    <td><?php if($row->sang == true){ echo 'Có'; } else { echo 'Không';} ?></td>
                    <td><?php if($row->trua == true){ echo 'Có'; } else { echo 'Không';} ?></td>
                    <td><?php if($row->toi == true){ echo 'Có'; } else { echo 'Không';} ?></td>
					<td><?php echo $row->don_vi_dung ?></td>
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
<div class="col-sm-5" id="add_medicine">
<h3>Thêm loại thuốc mới</h3>
	<form class="form-horizontal" name="them_thuoc" id="them_thuoc" method="post" action="adminmedicine/verifyInsertMedicine">
		<div class="form-group">
			<label  class="col-sm-4 control-label" style="color:#000000;">Tên thuốc</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="tao_tenthuoc" name="tao_tenthuoc" value="<?php  ?>" />
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-4 control-label" style="color:#000000;">Thời gian</label>
			<div class="col-sm-7 " style="padding-top:7px">
				<input type="checkbox" id="tao_sang" name="tao_sang" value="1">    Sáng
				<input type="checkbox" id="tao_trua" name="tao_trua" value="1">    Trưa
				<input type="checkbox" id="tao_toi" name="tao_toi" value="1">    Tối
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-4 control-label" style="color:#000000;">Đơn vị dùng</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="tao_don_vi_dung" name="tao_don_vi_dung" value="" />
			</div>
		</div>
		<div style="text-align:right">
			<button type="submit" class="btn btn-primary">Lưu</button>
			<button type="reset" class="btn btn-danger" >Hủy</button>		
		</div>
	</form>
</div>
<div class="col-sm-5" id="update_medicine">
	<h3>Cập nhật thuốc</h3>
	<form class="form-horizontal" name="capnhat_thuoc" id="capnhat_thuoc" method="post" action="adminmedicine/verifyUpdateMedicine">
		<div class="form-group">
			<label  class="col-sm-4 control-label" style="color:#000000;">Tên thuốc</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="capnhat_tenthuoc" name="capnhat_tenthuoc" value="<?php  ?>" />
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-4 control-label" style="color:#000000;">Thời gian</label>
			<div class="col-sm-7 " style="padding-top:7px">
				<input type="checkbox" id="capnhat_sang" name="capnhat_sang" value="1">    Sáng
				<input type="checkbox" id="capnhat_trua" name="capnhat_trua" value="1">    Trưa
				<input type="checkbox" id="capnhat_toi" name="capnhat_toi" value="1">    Tối
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-4 control-label" style="color:#000000;">Đơn vị dùng</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="capnhat_don_vi_dung" name="capnhat_don_vi_dung" value="" />
			</div>
		</div>
		<div style="text-align:right">
			<input type="hidden" name="id_thuoc" id="id_thuoc" value="" />
			<button type="submit" class="btn btn-primary">Cập nhật</button>
			<button type="button" class="btn btn-info" onclick="addMedicine();" >Thêm mới</button>	
		</div>
	</form>
</div>
</div><!-- end div container-->


