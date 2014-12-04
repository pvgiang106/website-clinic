﻿<?php
   // var_dump($cardInfo);
   if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }
    //var_dump($listTransaction);
    $current_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>
<script>
    function confirmDelete(idTransaction){
        var url = "<?php echo base_url().'admin/verifycustomer/deletetransaction/'?>"+idTransaction;
        $("#delete_confirm").attr('href', url);
    }
 </script>
 <div class="col-md-12" id="content">
    <div class="row" id="content-top">
        <div class="col-md-1" style="padding-top: 40px;">
          <a href="<?php echo base_url().'admin?tab_active=1' ?>"><img src="<?php echo base_url().'assets/icon_arrow_back.png';?>" /></a>
        </div>
        <div class="col-md-2">
          <img src="<?php echo base_url().'assets/avatar/default_2x.jpg';?>" />
        </div>
        <div class="col-md-8">
            <p style="color: #4dd6ce; margin:0px;font-size: 30px;"><b><?php echo $customer->firstName.' '.$customer->lastName ?></b></p>
            <p style="margin-bottom: 5px;">Email: <?php echo $customer->email ?></p>
            <p style="margin-bottom: 5px;">Phone: <?php echo $customer->phone ?></p>
            <p style="margin-bottom: 5px;">Address: <?php echo $customer->address ?></p>
        </div>
    </div> 
    <div class="row" id="content-top1" >
    <div class="col-md-2">
        <p>Card Name:</p>
        <p>Card Number:</p>
    </div>
    <div class="col-md-2" >
        <p><?php if($cardInfo!= null) echo $cardInfo->name ?></p>
        <p><?php if($cardInfo!= null) echo $cardInfo->number ?></p>
    </div>
    <div class="col-md-2">
        <p>CCV:</p>
        <p>Expire Day:</p>
    </div>
    <div class="col-md-2">
        <p><?php if($cardInfo!= null) echo $cardInfo->ccv ?></p>
        <p><?php if($cardInfo!= null) echo $cardInfo->expire_date ?></p>
    </div>
    <div class="col-md-3 col-md-offset-1" id="div_search">
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
                <td><b>Transaction ID</b></td>
                <td><b>Date time</b></td>
                <td><b>Description</b></td>
                <td><b>Note</b></td>
                <td><b>Payment Method</b></td>
                <td><b>Total</b></td>
                <td><b>Funtions</b></td>
            </tr>
       <?php if($listTransaction != null){ for($i=8*($page-1);$i<sizeof($listTransaction);$i++){ if($i == 8*$page){ break;} $row = $listTransaction[$i]; ?>
            <tr>
                <td><?php echo $row->transactionID?></td>
                <td><?php echo $row->dateTime;?></td>
                <td>
                <?php $listItem = $row->description;
                    for($j = 0; $j<sizeof($listItem);$j++){
                        echo "<p>".$listItem[$j]->title." x ".$listItem[$j]->quantity."<p>";
                    }
                ?>
                </td>
                <td><?php echo $row->note;?></td>
                <td><?php echo $row->paymentMethod;?></td>
                <td><?php echo $row->totalCost."$";?></td>
                <td style="text-align: center;letter-spacing: 10px;"><img data-toggle="modal" data-target="#myModal" onclick="confirmDelete(<?php echo $row->transactionID ?>)" style="padding-right: 10px;"src="<?php echo base_url()?>assets/icon_delete.png"/></td>
            </tr>
       <?php }} ?>
       </table>
    </div>
    <div class="row" id="content-bottom">
        <?php 
            if($listTransaction != null){
                if(sizeof($listTransaction)%8 != 0){
                     $tmp = 1 + sizeof($listTransaction)/8;
                     $numberpage = (int)$tmp;
                }else{
                     $tmp = sizeof($listTransaction)/8;
                     $numberpage = (int)$tmp;
                }
                if($numberpage >= 5){
                    if($page <= 5){
                        $minpage = 1;
                        $maxpage = 5;
                    }else if($page >= $numberpage-2){
                        $minpage = $numberpage-4;
                        $maxpage = $numberpage;
                    }else{
                        $minpage = $page - 2;
                        $maxpage = $page + 2;
                    }            
                }else{
                    $minpage = 1;
                    $maxpage = $numberpage;
                }
            }else{
                $minpage = 1;
                $maxpage = 1;
                $numberpage = 0;
            }
           
            
        ?>
        <nav>
          <ul class="pagination">
            <li <?php $back = $page - 1; if($back == 0) echo "class='disabled'"; ?>><?php if($back > 0){ echo "<a href='".base_url().'admin/customer/'.$customer->customerID.'?tab_active=1&page='.$back."'>";}?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_back.png';?>" /></span><?php if($back > 0){ echo "</a>";} ?></li>
            <?php for($j = $minpage;$j<$maxpage+1;$j++){ ?>
            <li <?php if($j == $page)  echo "class='active'";?>><a href="<?php echo base_url().'admin/customer/'.$customer->customerID.'?tab_active=1&page='.$j ; ?>"><?php echo $j; ?></a></li>
            <?php } ?>
            <li <?php $next = $page+1; if($next > $numberpage) echo "class='disabled'"; ?>><?php if($next <= $numberpage){ echo "<a href='".base_url().'admin/customer/'.$customer->customerID.'?tab_active=1&page='.$next."'>";}?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_next.png';?>" /></span><?php if($next <= $numberpage){ echo "</a>";} ?></li>
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