<!-- start -->
<?php $i = 0;?>
<div class="container">
    <h3></h3>
    <table id="myTable" class="tablesorter">

        <thead>
            <tr class="bootstrap-header">
                <td>Number</td>
				<td>User Name</td>
                <td>Email</td>
				<td>Phone</td>
				<td>Address</td>
                <td>Sex</td>
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
                </tr>  
                <?php
                $number += 1;
            }
            ?>
        </tbody>
    </table>
</div> <!-- end div container-->

