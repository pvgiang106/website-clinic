<!-- start -->
<?php $i = 0;?>
<div class="container">
    <h3></h3>
    <table id="myTable" class="tablesorter">

        <thead>
            <tr class="bootstrap-header">
                <td>STT</td>
				<td>Tên</td>
                <td>Email</td>
				<td>Số ĐT</td>
				<td>Địa chỉ</td>
                <td>Giới tính</td>
				<td>Xóa</td>
            </tr>    
        </thead>
        <tbody>
            <?php
            $number = 0;
            foreach ($result as $row) {
                ?>
                <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $row->mid_name; echo ' '; echo $row->name; ?></td>
                    <td><?php echo $row->email ?></td>
					<td><?php echo $row->phone ?></td>
					<td><?php echo $row->address; echo ', '; echo $row->district; echo ', '; echo $row->provice ?></td> 
					<td><?php echo $row->sex ?></td>
					<td><a href="<?php echo base_url()."admin/deluser?email=".$row->email; ?>" class="btn btn-danger">Xóa</a></td>
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

