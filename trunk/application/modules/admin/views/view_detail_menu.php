 <div class="col-md-12" id="content">
    <div class="row" id="content-top">
        <div class="col-md-1" style="padding-top: 40px;">
          <a href="<?php echo base_url().'admin?tab_active=0' ?>"><img src="<?php echo base_url().'assets/icon_arrow_back.png';?>" /></a>
        </div>
        <div class="col-md-2">
          <img src="<?php echo base_url().'assets/avatar/default_2x.jpg';?>" />
        </div>
        <div class="col-md-8">
            <p style="color: #4dd6ce; margin:0px;font-size: 30px;"><b>Customer Name</b></p>
            <p style="margin-bottom: 5px;">Email:</p>
            <p style="margin-bottom: 5px;">Phone:</p>
            <p style="margin-bottom: 5px;">Address:</p>
        </div>
    </div> 
    <div class="row" id="content-top1" >
    <div class="col-md-2">
        <p>Card Name:</p>
        <p>Card Number:</p>
    </div>
    <div class="col-md-2" >
        <p>All Customer</p>
        <p>All Customer</p>
    </div>
    <div class="col-md-2">
        <p>CCV:</p>
        <p>Expire Day:</p>
    </div>
    <div class="col-md-2">
        <p>All Customer</p>
        <p>All Customer</p>
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
       <?php for($i=1;$i<9;$i++){ ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo "Name";?></td>
                <td><?php echo "Customer Name";?></td>
                <td><?php echo "Email";?></td>
                <td><?php echo "Password";?></td>
                <td style="text-align: center;"><button class="btn">View</button></td>
                <td style="text-align: center;letter-spacing: 10px;"><img style="padding-right: 10px;"src="<?php echo base_url()?>assets/icon_delete.png"/><img src="<?php echo base_url()?>assets/icon_edit.png"/></td>
            </tr>
       <?php } ?>
       </table>
    </div>
    <div class="row" id="content-bottom">
        <nav>
          <ul class="pagination">
            <li><a href="#"><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_back.png';?>" /></span><span class="sr-only">Previous</span></a></li>
            <li><a href="#">1</a></li>
            <li class="active"><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#"><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_next.png';?>" /> </span><span class="sr-only">Next</span></a></li>
          </ul>
        </nav>
    </div>                       
</div>      