<div class="panel-group" id="accordion">
<?php //var_dump($chuatraloi);
	foreach($chuatraloi as $row){
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $row->id_faq; ?>">
					<?php echo $row->question;echo ' ?'; ?>
				</a>
			</h4>
		</div>
		<div id="<?php echo $row->id_faq; ?>" class="panel-collapse collapse">
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="faqs/updateFaq"">
					<div class="form-group">
						<div class="col-sm-12">
							<textarea  class="form-control" id="answer" name="answer" rows="4"></textarea>
						</div>
					</div>
					<div id="submitform" style="text-align:center;padding-bottom:10px;">
						<input type="hidden" name="email" value="<?php echo $row->email;?>" />
						<input type="hidden" name="id_faq" value="<?php echo $row->id_faq;?>" />
						<input type="hidden" name="question" value="<?php echo $row->question;?>" />
						<button type="submit" class="btn btn-primary">Lưu</button>
						<button type="reset" class="btn btn-danger" >Hủy</button>												
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>
</div>