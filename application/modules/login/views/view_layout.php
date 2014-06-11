<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />        <!--bootstrap-->
        <?php
        echo loadBootstrap3_css();
        ?>
        <link href="<?php echo base_url(); ?>/assets/systemfile/css/templatelogin.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .layout-header {
                background-color: #08c;
                height: 70px;
            }
            .font-header {
                color: #f7fafb;
                font-size: 30px;
                text-align: center;
                margin-top: 15px;
                font-family: cursive;
                position: relative;
            }
            .title {
                text-align: center;
                margin-top: 20px;
                font-size: 24px;
            }

            body {
                background-color: #EBF3EC;
            }
            .my-left {
                margin-top: 20px;
            }
            .img-circle {
                height: 40px;
                width: 40px;
                float: right;    
                position: relative;                    
            }
            img:hover {
                width: 140px;
                height: 140px;
                position: static;
            }
            .text {
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="row layout-header">
            <div class="col-lg-6 font-header">
                <b>Website Clinic </b>
            </div>
            <div class="col-lg-6"></div>
        </div>
        <div class="row my-left">
            <div class="col-lg-1">

            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="row my-left">
                        <div class="col-lg-4">
                            <img border="0" src="<?php echo base_url(); ?>/assets/userfile/img/login/plan.jpg" alt="find" class="img-circle">
                        </div>
                        <div class="col-lg-8 text">
                            <b>Quản lý bệnh nhân</b>
                        </div>
                    </div>
                    <div class="row my-left">
                        <div class="col-lg-4">
                            <img border="0" src="<?php echo base_url(); ?>/assets/userfile/img/login/update.jpg" alt="find" class="img-circle">
                        </div>                                  
                        <div class="col-lg-8 text">
                            <b>Quản lý hồ sơ khám bệnh</b>
                        </div>
                    </div>
                    <div class="row my-left">
                        <div class="col-lg-4">
                            <img border="0" src="<?php echo base_url(); ?>/assets/userfile/img/login/share.jpg" alt="find" class="img-circle">
                        </div>
                        <div class="col-lg-8 text">
                            <b>Cài đặt lịch hẹn</b>
                        </div>
                    </div>
                    <div class="row my-left">
                        <div class="col-lg-4">
                            <img border="0" src="<?php echo base_url(); ?>/assets/userfile/img/login/find.png" alt="find" class="img-circle">
                        </div>
                        <div class="col-lg-8 text">
                            <b>Tư vấn chuyên khoa</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <?php
                $this->load->view($module . '/' . $view_file);
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
echo loadBootstrap3_js();
?>