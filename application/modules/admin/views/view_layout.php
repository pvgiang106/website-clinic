<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />        <!--bootstrap-->
        <?php
        echo loadBootstrap3_css();
        ?>
        <!-- bootstrap widget theme -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/theme.bootstrap.css'); ?>" />
        <!--<link rel="stylesheet" href="<?php //echo base_url('/assets/systemfile/css/jquery.tablesorter.pager.css'); ?>" />-->
       
        <?php
        echo loadBootstrap3_js();
        ?>

<!-- plugin tablesorter -->
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.widgets.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.custom.js');?>"></script>

<!-- add on pager plugin tablesorter -->
<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/js/jquery.tablesorter.pager.js');?>"></script>
    </head>
    <body class="container">
        <div class="row">
            <ul class="nav nav-pills">
                <li <?php if($tab == 0) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>admin">Manager User</a></li>
                <li <?php if($tab == 1) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>index.php/admin/adminclinic">Manager Clinic</a></li>
            </ul>
        </div>
        <div class="row">
            <?php
            $this->load->view($module . '/' . $view_file);
            ?>
            
            <div class="pager">
            <form>
              <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/first.png');?>" class="first"/>
              <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/prev.png');?>" class="prev"/>
              <input type="text" class="pagedisplay"/>
              <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/next.png');?>" class="next"/>
              <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/last.png');?>" class="last"/>
              <select class="pagesize">
                <option selected="selected"  value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option  value="40">40</option>
              </select>
            </form>
          </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                 $("table").tablesorter().tablesorterPager({container: $(".pager")});    
            }); 
        
        </script>
    </body>
</html>
