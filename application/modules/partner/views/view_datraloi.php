<div class="panel-group" id="accordion">
<?php //var_dump($datraloi);
	$i = 0;
	foreach($datraloi as $row){
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion"  onclick="canceledit();" href="#<?php echo $row->id_faq; ?>">
					<?php echo $row->question;echo ' ?'; ?>
				</a>
			</h4>
		</div>
		<div id="<?php echo $row->id_faq; ?>" class="panel-collapse collapse">
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="faqs/updateFaq">
					<fieldset class="view">
						<div class="form-group">
							<div class="col-sm-10">
								<p class="form-control-static"><?php echo $row->answer; ?></p>					
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-default">Sửa</button>				
							</div>
						</div>
					</fieldset>
					<fieldset class="edit">
						<div class="form-group">
							<div class="col-sm-12">
								<textarea  class="form-control" id="answer" name="answer" rows="4"><?php echo $row->answer; ?></textarea>
							</div>
						</div>
						<div id="submitform" style="text-align:center;padding-bottom:10px;">
							<input type="hidden" name="email" value="<?php echo $row->email;?>" />
							<input type="hidden" name="tieu_de" value="<?php echo $row->tieu_de;?>" />
							<input type="hidden" name="tieu_de" value="<?php echo $row->tieu_de;?>" />
							<input type="hidden" name="id_faq" value="<?php echo $row->id_faq;?>" />
							<input type="hidden" name="question" value="<?php echo $row->question;?>" />
							<button type="submit" class="btn btn-primary">Lưu</button>
							<button type="reset" class="btn btn-danger" onclick="canceledit();" >Hủy</button>												
						</div>
					</fieldset>
					
				</form>
			</div>
		</div>
	</div>
<?php $i++;} ?>
</div>