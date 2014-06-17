<style type="text/css">
    p{
        color: #E13300;
    }
</style>
<?php
$attribute = array('class' => 'form-horizontal', 'id' => 'login');
echo form_open('login/verifylogin/resetpass', $attribute);
?>
<h3>Reset Password</h3>
<form class="form-horizontal" role="form">
    <fieldset>
        <div class="form-group">
            <label for="email" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-7">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                <p><?php echo form_error('email');echo $message; ?></p> 
            </div>         
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary">Reset</button>
                <button type="button" class="btn btn-info" onclick="window.location='../';">Cancel</button>
            </div>
        </div>
    </fieldset>
</form>

