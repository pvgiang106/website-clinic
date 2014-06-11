<style type="text/css">
    p{
        color: #E13300;
    }
</style>

<?php
$attribute = array('class' => 'form-horizontal', 'id' => 'login');
echo form_open('login/verifylogin', $attribute);
?>
<h3>Đăng nhập</h3>
<form class="form-horizontal" role="form">
    <fieldset> 
        <div class="form-group col-lg-12">
            <p><?php echo $error; ?></p>                        
        </div>
        <div class="form-group">
            <label for="email" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-7">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                <p><?php echo form_error('email'); ?></p> 
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-lg-2 control-label">Mật khẩu</label>
            <div class="col-lg-7">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <p><?php echo form_error('password'); ?></p> 
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="remember" name="remember" value="remember"> Ghi nhớ
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                <button type="button" class="btn btn-info">Hủy bỏ</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <a href="<?php base_url(); ?>login/resetpassword">Quên mật khẩu</a><br/>
            </div>
        </div>
    </fieldset>
</form>

