<style type="text/css">
    p{
        color: #E13300;
    }
    .checkbox {

    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ckfinder/ckfinder.js"></script>
<h3>Insert Hotel </h3>
<?php
$attribute = array(
    'class' => 'form-horizontal',
    'id' => 'register',
    'name' => 'register'
);
echo form_open('admin/adminclinic/verifyinsertclinic/' . $hotelID, $attribute);
?>
<fieldset>
    <div class="row">
        <div class="col-lg-8">
            <div class="form-group has-error col-lg-12">
                <p><?php //echo $error;        ?></p>
            </div>
            <div class="row">
                <div class="col-lg-11 form-group">
                    <label class="col-sm-2 control-label" for="hotelName">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="col-lg-9 form-control" id="hotelName" name="hotelName" value="<?php echo $hotelName; ?>" >
                        <p><?php echo form_error('hotelName'); ?></p>
                    </div>            
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-11 form-group">
                    <label class="col-sm-2 control-label" for="city">City</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="city" id="city">
                            <?php
                            $this->load->model('mdlhotel');
                            $tmp = $this->mdlhotel->getListCity();
                            foreach ($tmp as $tmprow) {
                                ?>
                                <option <?php
                                if ($cityID == $tmprow->cityID)
                                    echo 'selected="selected"';
                                ?>><?php echo $tmprow->cityName; ?></option>                        
                                <?php }
                                ?>
                        </select>                
                        <p><?php echo form_error('city'); ?></p>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-11 form-group">
                    <label class="col-sm-2 control-label" for="address">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" value="<?php echo $address; ?>" name="address" >
                        <p><?php echo form_error('address'); ?></p>
                    </div>             
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-11 form-group">
                    <label class="col-sm-2 control-label" for="hotelStar">Star</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="hotelStar" id="hotelStar">
                            <?php
                            $tmp = 1;
                            while ($tmp < 6) {
                                ?>
                                <option 
                                    <?php
                                        if ($tmp == $hotelStar)  echo 'selected="selected"';?>
                                 >
                                     <?php echo $tmp; ?></option>                        
                                    <?php
                                    $tmp += 1;
                                }
                                ?>
                        </select>                
                        <p><?php echo form_error('hotelStar'); ?></p>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-11 form-group">
                    <label class="col-sm-2 control-label" for="des">Description</label>
                    <div class="col-sm-10">
                        <span class="right"><textarea id="des" name="des" style="width:100%; height:400px;"><?php echo $description; ?></textarea></span> 
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row col-lg-11  form-group">
                <div class="col-sm-2 control-label"></div>
                <div class="col-sm-10">
                    <button type="submit" name="submitinsert" id="submitinsert" value="insert" class="btn btn-primary">Insert</button>
                    <a type="button" href="<?php echo base_url(); ?>index.php/admin/adminclinic" name="cancel" id="cancel" value="cancel" class="btn btn-info">Cancel</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h3>Facilities</h3>
            <div class="checkbox">
                <?php
                $this->load->model('mdlhotel');
                $result = $this->mdlhotel->getHotelFacilities();
                $facilities = $this->mdlhotel->getHotelFacilitiesSubply($hotelID);
                foreach ($result as $row) {
                    ?>
                <div class="row">
                    <label>
                        <input type="checkbox"  <?php foreach ($facilities as $facilitiesrow) {if ($facilitiesrow->facilityID == $row->facilityID) echo 'checked';}  ?> 
                               name="facilities[]" value="<?php echo $row->facilityID; ?> "> <?php echo $row->facilityName; ?>
                    </label>  
                    </div>
                   
                    <?php
                }
                ?>                
            </div>
        </div>

    </div>
</fieldset>

<script type="text/javascript">
//    $(function() {
//        if (CKEDITOR.instances['des']) {
//            CKEDITOR.remove(CKEDITOR.instances['des']);
//        }
//        CKEDITOR.config.width = 847;
//        CKEDITOR.config.height = 150;
//        CKEDITOR.replace('des', {});
//    });

    $(function() {
        var editor = CKEDITOR.replace('des', {filebrowserBrowseUrl: '<?php echo base_url() . "ckfinder/ckfinder.html"; ?>',
            filebrowserImageBrowseUrl: '<?php echo base_url() . "ckfinder/ckfinder.html?Type=Images"; ?>', 
            filebrowserFlashBrowseUrl: '<?php echo base_url() . "ckfinder/ckfinder.html?Type=Flash" ?>', 
            filebrowserUploadUrl: '<?php echo base_url() . "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files" ?>', 
            filebrowserImageUploadUrl: '<?php echo base_url() . "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images"; ?>', 
            filebrowserFlashUploadUrl: '<?php echo base_url() . "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"; ?>', 
            filebrowserWindowWidth: '800', 
            filebrowserWindowHeight: '480'});
        CKFinder.setupCKEditor(editor, "<?php echo base_url() . 'ckfinder/' ?>");
    });
</script>