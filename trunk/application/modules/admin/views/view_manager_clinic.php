<!-- start -->
<?php $i = 0; ?>
<div class="container">
    <h3></h3>
   
    <table id="myTable" class="tablesorter">
        <thead>
            <tr class="bootstrap-header">
                <td>Number</td>
                <td>Clinic ID</td>
                <td>Name</td>
                <td>Phone</td>
                <td>Address</td>
                <td>Expire Day</td>
                <td><a href="<?php echo base_url(); ?>index.php/admin/adminclinic/insertclinic" class="btn btn-primary btn-create">Create</a></td>
                               
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
                    <td><a href="<?php echo base_url(); ?>index.php/admin/adminclinic/updateClinic?id_phongkham=<?php echo $row->id_phongkham;?>" class="btn btn-success btn-edit">Edit</a></td>
                    </td>
                </tr>  
                <?php
                $number += 1;
            }
            ?>
        </tbody>
    </table>
</div> <!-- end div container-->


