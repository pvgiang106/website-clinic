<!-- start -->
<?php $i = 0; ?>
<div class="container">
    <h3>Manager Hotel</h3>
    <a href="<?php echo base_url(); ?>index.php/admin/adminhotel/inserthotel" class="btn btn-primary btn-create">Create</a>
    <table id="myTable" class="tablesorter">
        <thead>
            <tr class="bootstrap-header">
                <td>Number</td>
                <td>Hotel ID</td>
                <td>Name</td>
                <td>Star</td>
                <td>City</td>
                <td>Address</td>                
            </tr>    
        </thead>
        <tbody>
            <?php
            $number = 0;
            foreach ($result as $row) {
                ?>
                <tr id="<?php echo $row->hotelID; ?>">
                    <td><?php echo $number ?></td>
                    <td><?php echo $row->hotelID ?></td>
                    <td><?php echo $row->hotelName ?></td>
                    <td><?php echo $row->hotelStar ?></td> 
                    <td><?php
                        $this->load->model('mdlhotel');
                        $tmp = $this->mdlhotel->getCityName($row->cityID);
                        foreach ($tmp as $tmprow) {
                            echo $tmprow->cityName;
                        }
                        ?></td>                                        
                    <td><?php echo $row->address ?></td>                                           
                    <td><a href="<?php echo base_url(); ?>index.php/admin/adminhotel/updatehotel/<?php echo $row->hotelID;?>" class="btn btn-success btn-edit">Edit</a></td>
                    <td><a data-toggle="modal" href="#deleteModal" class="btn btn-warning btn-delete">Delete</a></td>    
                    </td>
                </tr>  
                <?php
                $number += 1;
            }
            ?>
        </tbody>
    </table>
</div> <!-- end div container-->


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you sure want delete?</h4>
            </div>
            <div class="modal-body">

                <form id="form-delete" action="" method="post">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="submit-delete" class="btn btn-primary">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--<script type="text/javascript">

    /*Form delete*/
    $('.btn-delete').click(function()
    {
        var idDelete = $(this).closest('tr').prop('id');

        $('#submit-delete').click(function(event)
        {
            $('#form-delete').attr('action', '<?php //echo base_url(); ?>/index.php/category_controller/delete/' + idDelete);
            $('#form-delete').submit();
        });
    });

</script>-->


<script type="text/javascript">
        
    $(document).ready(function() {
//        $("table").tablesorter().tablesorterPager({container: $(".pager")});
        $(document).on('click', '.btn-delete', function(){

                var idDelete = $(this).closest('tr').prop('id');

                $('#submit-delete').click(function(event)
                {
                    $('#form-delete').attr('action', '<?php echo base_url(); ?>index.php/admin/adminhotel/deletehotel/' + idDelete);
                    $('#form-delete').submit();
                });        

        });// end on click
   });
</script>    



