<?php
	$tab0 = base_url().'clinic';
	$tab1 = base_url().'clinic/medicalprofile';
	$tab2 = base_url().'clinic/faqs';
	if(isset($_GET['option'])){ $view = $_GET['option'];$view_file = 'view_'.$_GET['option'];}else{$view = 'chuatraloi';$view_file = 'view_chuatraloi';};
	//var_dump($datraloi);
	//var_dump($chuatraloi);
	$size = sizeof($datraloi);
	$name = $this->session->userdata['logged_in']['name'];
?>
<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />
	<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/dhtmlxscheduler.js'); ?>" ></script>
	<script type="text/javascript" src="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/ext/dhtmlxscheduler_limit.js'); ?>" ></script>
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/plugin/dhtmlxscheduler/dhtmlxscheduler.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/bootstrap.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('/assets/systemfile/css/style_menuclinic.css'); ?>" />
	<?php
        //echo loadBootstrap3_css();
		echo loadBootstrap3_js();
    ?>
	
	<style>
		body{
			width:1170px;
			margin:auto;
			background: #EBF3EC;
			font-size:14px;
		}
	</style>
	<script>
		$(document).ready(function(){
			var size = <?php echo $size; ?>;
			for(i=0;i<size;i++){
				$(".edit").hide();
				$(".btn-default").click(function(){
					$(".view").hide();
					$(".edit").show();
				});
			}
		});
		function canceledit(){
				$(".view").show();
				$(".edit").hide();
		};
	</script>
</head>
    <body ><!-- Menu 2 -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li><a style="color: #104AD3;" href='<?php echo base_url(); ?>'><?php echo $name ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href='<?php echo site_url("login/login/logout") ?>'>Logout</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
    </ul>
 </div>
<section>
	<input type="radio" style="display:none;" id="profile" value="1" name="tractor" <?php if($tab == 0) echo "checked='checked'"; ?> />    
	<input type="radio" style="display:none;" id="settings" value="2" name="tractor"  <?php if($tab == 1) echo "checked='checked'"; ?> />      
	<input type="radio" style="display:none;" id="books" value="3" name="tractor"  <?php if($tab == 2) echo "checked='checked'"; ?> />
	
	<nav>   
		<label for="profile"  onclick="window.location.href=<?php echo '\''.$tab0.'\''; ?>" class='fontawesome-calendar'>QUẢN LÝ CUỘC HẸN</label>
		<label for="settings" onclick="window.location.href=<?php echo '\''.$tab1.'\''; ?>" class='fontawesome-film'>QUẢN LÝ BỆNH NHÂN</label>
		<label for="books" onclick="window.location.href=<?php echo '\''.$tab2.'\''; ?>" class='fontawesome-list-alt'>HỎI - ĐÁP</label>
	</nav>
	<div style="padding-top:20px;padding-left:20px;">
		<button type="button" class="btn btn-default<?php if($view=='datraloi') echo ' active'?>" onclick="window.location.href='?option=datraloi'" >Câu hỏi đã trả lời</button>
		<button type="button" class="btn btn-default<?php if($view=='chuatraloi') echo ' active'?>" onclick="window.location.href='?option=chuatraloi'" >Câu hỏi mới</button>
	</div>
<?php
	//var_dump($view_file);
	$this->load->view($module . '/' . $view_file);
?>
<div class="pager">
			<form>
			  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/first.png');?>" class="first"/>
			  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/prev.png');?>" class="prev"/>
			  <input type="text" class="pagedisplay" style="text-align:center" />
			  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/next.png');?>" class="next"/>
			  <img src="<?php echo base_url('/assets/systemfile/plugin/tablesorter/icons/last.png');?>" class="last"/>
			  <input class="pagesize" value="10" type="hidden">
			  </input>
			</form>
		</div>
</section>	
	<script type="text/javascript">
            $(document).ready(function() {
                 $("table").tablesorter().tablesorterPager({container: $(".pager")});    
            }); 
        
        </script>	
	</body>
</html>
