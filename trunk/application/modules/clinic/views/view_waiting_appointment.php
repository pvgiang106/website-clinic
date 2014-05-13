<?php
//var_dump($waitingappoitment);
?>
<div class="container">
    <h3>Waiting Appointment</h3>
   
    <table id="myTable" class="tablesorter">
        <thead>
            <tr class="bootstrap-header">
                <td>Email</td>
                <td>Reason</td>
                <td>Day</td>
                <td>Time start</td>
                <td>Time end</td>                           
            </tr>    
        </thead>
        <tbody>
            <?php
            $number = 0;
            foreach ($waitingappoitment as $row) {
                ?>
                <tr >
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->li_do_kham ?></td>
                    <td><?php echo $row->ngay_kham ?></td>
                    <td><?php echo $row->thoigian_batdau; ?></td>
                    <td><?php echo $row->thoigian_ketthuc; ?></td>                                         
                    <td><a href="<?php echo base_url(); ?>index.php/clinic/waitingappointment/acceptappointment/<?php echo $row->id_lichkham;?>" class="btn btn-success btn-edit">Accept</a></td>
					<td><a href="<?php echo base_url(); ?>index.php/clinic/waitingappointment/deleteappointment/<?php echo $row->id_lichkham;?>" class="btn btn-success btn-delete">Reject</a></td>
                    </td>
                </tr>  
                <?php
                $number += 1;
            }
            ?>
        </tbody>
    </table>
</div>