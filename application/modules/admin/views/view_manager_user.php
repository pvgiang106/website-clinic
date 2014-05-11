<!-- start -->
<?php $i = 0;?>
<div class="container">
    <h3>Manager User</h3>
    <table id="myTable" class="tablesorter">

        <thead>
            <tr class="bootstrap-header">
                <td>Number</td>
                <td>UserID</td>
                <td>Email</td>
                <td>User Name</td>
                <td>Sex</td>
                <td>Role</td>
                <td>Status</td>
            </tr>    
        </thead>
        <tbody>
            <?php
            $number = 0;
            foreach ($result as $row) {
                ?>
                <tr id="<?php echo $row->userID; ?>">
                    <td><?php echo $number ?></td>
                    <td><?php echo $row->userID ?></td>
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->sex ?></td>
                    <td><?php echo $row->role ?></td>                       
                    <td>
                        <?php 
                        if($row->status == 'block') {
                            $tmp = '#blockModal';
                        } else {
                            $tmp = '#unblockModal';
                        }    
                        ?>
                        <a class="btn-block" data-toggle="modal" href="<?php echo $tmp ;?>"><?php echo $row->status; ?></a>    
                    </td>
                </tr>  
                <?php
                $number += 1;
            }
            ?>
        </tbody>
    </table>
</div> <!-- end div container-->

<!--Block Modal-->

<div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>        
      </div>
      <div class="modal-body">
          Are you sure block user ?
          <form id="form-block" action="" method="post">
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="submit-block" class="btn btn-primary">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End block Modal-->

<!--UnBlock Modal-->

<div class="modal fade" id="unblockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>        
      </div>
      <div class="modal-body">
          Are you sure Unblock user ?
          <form id="form-unblock" action="" method="post">
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="submit-unblock" class="btn btn-primary">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Unblock Modal-->

<script type="text/javascript">
        
    $(document).ready(function() {
//        $("table").tablesorter().tablesorterPager({container: $(".pager")});
        $(document).on('click', '.btn-block', function(){

                 var idBlock = $(this).closest('tr').prop('id');
                        // btn-edit click
                        $('#submit-block').click(function(event)
                        {
                            // set action for form edit
                            $('#form-block').attr('action', '<?php echo base_url(); ?>index.php/admin/block/' + idBlock);
                            // submit form
                            $('#form-block').submit();
                        });        

        });// end on click
        
        $(document).on('click', '.btn-block', function(){

                var idUnBlock = $(this).closest('tr').prop('id');
                        // btn-edit click
                        $('#submit-unblock').click(function(event)
                        {
                            // set action for form edit
                            $('#form-unblock').attr('action', '<?php echo base_url(); ?>index.php/admin/unblock/' + idUnBlock);
                            // submit form
                            $('#form-unblock').submit();
                        });     

        });// end on click
   });
</script> 


