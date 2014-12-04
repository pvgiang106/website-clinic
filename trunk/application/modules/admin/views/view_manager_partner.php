 <div class="col-md-12" id="content">
    <div class="row" id="content-top">
        <div class="col-md-8" style="padding: 0px;">
            <p style="color: #4dd6ce;"><b>Business partners</b></p>
        </div>
        <div class="col-md-4" style="padding: 0px;">
            <p style="color: #4dd6ce; text-align: right;">New Partner  <a href="<?php echo base_url().'admin/addpartner?tab_active=1' ?>"><img src="<?php echo base_url() ?>assets/icon_add_new.png"/></a></p>
        </div>
    </div> 
    <div class="row">
    <div class="col-md-9">
        <p style="color: #797979;"><b>All Business Partners</b></p>
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
                <td><b>Business Name</b></td>
                <td><b>Email</b></td>
                <td><b>Password</b></td>
                <td><b>Phone Number</b></td>
                <td><b>Avatar</b></td>
                <td><b>Details</b></td>
                <td><b>Funtions</b></td>
            </tr>
       <?php for($i=1;$i<9;$i++){ ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo "Name";?></td>
                <td><?php echo "Customer Name";?></td>
                <td><?php echo "Email";?></td>
                <td><?php echo "Password";?></td>
                <td style="text-align: center;"><img src="<?php echo base_url().'assets/avatar/default.jpg';?>" /></td>
                <td style="text-align: center;"><a href="<?php echo base_url().'admin/partner?tab_active=0';?>"><button class="btn">View</button></a></td>
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
            <li><a href="#">2</a></li>
            <li class="active"><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#"><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_next.png';?>" /> </span><span class="sr-only">Next</span></a></li>
          </ul>
        </nav>
    </div>                       
</div>      