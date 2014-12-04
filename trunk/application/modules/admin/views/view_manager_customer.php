 <?php
    if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }
 ?>
 <script>
    function confirmDelete(idCustomer){
        var url = "<?php echo base_url().'admin/verifycustomer/deletecustomer/'?>"+idCustomer;
        $("#delete_confirm").attr('href', url);
    }
 </script>
 <div class="col-md-12" id="content">
    <div class="row" id="content-top">
        <div class="col-md-8" style="padding: 0px;">
            <p style="color: #4dd6ce;"><b>Customer</b></p>
        </div>
        <div class="col-md-4" style="padding: 0px;">
            <p style="color: #4dd6ce; text-align: right;">New Customer  <a href="<?php echo base_url().'admin/addcustomer?tab_active=1' ?>"><img src="<?php echo base_url() ?>assets/icon_add_new.png"/></a></p>
        </div>
    </div> 
    <div class="row">
    <div class="col-md-9">
        <p style="color: #797979;"><b>All Customer</b></p>
    </div>
    <div class="col-md-3" id="div_search">
       <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_search.png"/></div>
              <input type="text" class="form-control" name="cu_search" id="cu_search" placeholder="Search" required>
              <div class="input-group-addon" id="del_search"><img src="<?php echo base_url() ?>assets/icon_del_search.png"/></div>
            </div>
        </div>
    </div>        
    </div> 
    <div class="row" id="content-mid">
       <table class="table table-bordered">
            <tr id="tbl_header">
                <td><b>ID</b></td>
                <td><b>Customer Name</b></td>
                <td><b>Email</b></td>
                <td><b>Password</b></td>
                <td><b>Phone Number</b></td>
                <td><b>Avatar</b></td>
                <td><b>Details</b></td>
                <td><b>Funtions</b></td>
            </tr>
       <?php for($i=8*($page-1);$i<sizeof($customer);$i++){ if($i == 8*$page){ break;} $row = $customer[$i];?>
            <tr>
                <td><?php echo $row->customerID?></td>
                <td><?php echo $row->firstName.' '.$row->lastName;?></td>
                <td><?php echo $row->email;?></td>
                <td><?php echo $row->password;?></td>
                <td><?php echo $row->phone;?></td>
                <td style="text-align: center;"><img src="<?php echo base_url().'assets/avatar/default.jpg';?>" /></td>
                <td style="text-align: center;"><a href="<?php echo base_url().'admin/customer/'.$row->customerID;?>"><button class="btn">View</button></a></td>
                <td style="text-align: center;letter-spacing: 10px;"><img data-toggle="modal" data-target="#myModal" style="padding-right: 10px;" onclick="confirmDelete(<?php echo $row->customerID ?>)" src="<?php echo base_url()?>assets/icon_delete.png"/><a href="<?php echo base_url().'admin/editcustomer/'.$row->customerID;?>"><img src="<?php echo base_url()?>assets/icon_edit.png"/></a></td>
            </tr>
       <?php  } ?>
       </table>
    </div>
    <div class="row" id="content-bottom">
        <?php 
           
            if(sizeof($customer)%8 != 0){
                 $tmp = 1 + sizeof($customer)/8;
                 $numerpage = (int)$tmp;
            }else{
                 $tmp = sizeof($customer)/8;
                 $numerpage = (int)$tmp;
            }
            if($numerpage >= 5){
                if($page <= 5){
                    $minpage = 1;
                    $maxpage = 5;
                }else if($page >= $numerpage){
                    $minpage = $numerpage-4;
                    $maxpage = $numerpage;
                }else{
                    $minpage = $page - 2;
                    $maxpage = $page + 2;
                }            
            }else{
                $minpage = 1;
                $maxpage = $numerpage;
            }
        ?>
        <nav>
          <ul class="pagination">
            <li <?php $back = $page - 1; if($back == 0) echo "class='disabled'"; ?>><?php if($back > 0){ echo "<a href='".base_url().'admin?tab_active=1&page='.$back."'";}?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_back.png';?>" /></span><?php if($back > 0){ echo "</a>";} ?></li>
            <?php for($j = $minpage;$j<$maxpage+1;$j++){ ?>
            <li <?php if($j == $page)  echo "class='active'";?>><a href="<?php echo base_url().'admin?tab_active=1&page='.$j ; ?>"><?php echo $j; ?></a></li>
            <?php } ?>
            <li <?php $next = $page+1; if($next > $numerpage) echo "class='disabled'"; ?>><?php if($next <= $numerpage){ echo "<a href='".base_url().'admin?tab_active=1&page='.$next."'";}?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_next.png';?>" /></span><?php if($next <= $numerpage){ echo "</a>";} ?></li>
          </ul>
        </nav>
    </div> 

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" style="text-align: center;">
               <p><h3>Are you sure want to delele this Customer ?</h3></p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                <a id="delete_confirm" href="#"><button type="button" class="btn btn-danger">YES</button></a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
              </div>
            </div>
          </div>
        </div>

                     
</div>      