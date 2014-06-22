<!-- start -->
<?php $i = 0; ?>
<div class="container">
    <h3></h3>
   
    <table id="myTable" class="tablesorter">
        <thead>
            <tr class="bootstrap-header">
                <td>STT</td>
                <td>Mã Phòng khám</td>
                <td>Tên phòng khám</td>
                <td>Số ĐT</td>
                <td>Địa chỉ</td>
                <td>Ngày hết hạn</td>
                <td><a href="<?php echo base_url(); ?>index.php/admin/adminclinic/insertclinic" class="btn btn-success btn-create">Tạo mới</a></td>
                               
            </tr>    
        </thead>
        <tbody>
            <?php
            $number = 0;
            foreach ($result as $row) {
                ?>
                <tr id="<?php echo $row->id_phongkham; ?>">
                    <td><?php echo $number ?></td>
                    <td><?php echo $row->id_phongkham ?></td>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $row->phone ?></td>
                    <td><?php echo $row->address; echo ', '; echo $row->district; echo ', '; echo $row->provice; ?></td>
                    <td><?php echo $row->expire_day ?></td>                                         
                    <td><a href="<?php echo base_url(); ?>index.php/admin/adminclinic/updateClinic?id_phongkham=<?php echo $row->id_phongkham;?>" class="btn btn-primary btn-edit">Sửa</a>  <?php if($row->status == 1) { ?><a href="<?php echo base_url()."admin/adminclinic/expireclinic/".$row->id_phongkham; ?>" class="btn btn-primary btn-danger">Khóa</a> <?php } else { ?><a href="<?php echo base_url()."admin/adminclinic/unexpireclinic/".$row->id_phongkham; ?>" class="btn btn-primary btn-primary">Mở</a> <?php } ?></td>
                    </td>
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
</div> <!-- end div container-->


