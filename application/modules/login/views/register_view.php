<style type="text/css">
    p{
        color: #E13300;
    }
</style>

<h3>Register new Account </h3>
<h6>It is free and always will be.</h6>
<?php
$attribute = array(
    'class' => 'form-horizontal',
    'id' => 'register',
    'name' => 'register'
);
echo form_open('login/verifyLogin/register', $attribute);
?>
<fieldset>
    <div class="form-group has-error col-lg-12">
        <p><?php echo $error;?></p>
    </div>
    <div class="row">                    
        <div class="col-lg-6">
            <label class="sr-only" for="firstname">First name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
            <p><?php echo form_error('firstname'); ?></p>        
        </div>
        <div class="col-lg-5">     
            <label class="sr-only" for="lastname">Last name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
            <p><?php echo form_error('lastname'); ?></p>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-11">
            <label class="sr-only" for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            <p><?php echo form_error('email'); ?></p>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-11">
            <label class="sr-only" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            <p><?php echo form_error('password'); ?></p>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-11">
            <label class="sr-only" for="repassword">Re-Password</label>
            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Enter re-password">
            <p><?php echo form_error('repassword'); ?></p>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row col-lg-11">
        <label class="sr-only" for="">Sex</label>
        <label class="radio-inline">
            <input type="radio" id="sex" name="sex" value="male"> Male
        </label>
        <label class="radio-inline">
            <input type="radio" id="sex" name="sex" value="female"> Female
        </label>
        <p><?php echo form_error('sex'); ?></p>
    </div>                
    <div class="row">
        <label class="sr-only" for="">Birthday</label>
        <div class="col-lg-3">
            <h4>Your birthday</h4>        
        </div>    
        <div style="margin-left: -40px;" class="col-lg-3">
            <select class="form-control" name="day" id="day">
                <option>Day...</option>
                <?php
                $i = 1;
                while ($i <= 31) {
                    ?>
                    <option><?php echo $i++; ?></option>
                <?php }
                ?>
            </select>     
            <p><?php echo form_error('day'); ?></p>
        </div>
        <div style="margin-left: -10px;" class="col-lg-3">
            <select class="form-control" name="month" id="month">
                <option>Month...</option>
                <?php
                $j = 1;
                while ($j <= 12) {
                    ?>
                    <option><?php echo $j++; ?></option>
                <?php }
                ?>
            </select>
            <p><?php echo form_error('month'); ?></p>
        </div>
        <div style="margin-left: -10px;" class="col-lg-3">
            <select class="form-control" name="year" id="year">
                <option>Year...</option>
                <?php
                $k = 1920;
                while ($k <= 2009) {
                    ?>
                    <option><?php echo $k++; ?></option>
                <?php }
                ?>
            </select>
            <p><?php echo form_error('year'); ?></p>
        </div>
    </div>
    <div class="row col-lg-12">
        <h6>By clicking Register, you agree to our Terms and that you have read our <a href="#">Data Use Policy</a>, including our <a href="#">Cookie Use</a>.</h6>
    </div>
    <div class="row col-lg-11">
        <button type="submit" name="submitregister" id="submitregister" value="Register" class="btn btn-primary">Register</button>
        <button type="button" name="cancel" id="cancel" value="cancel" class="btn btn-info">Cancel</button>
    </div>
</fieldset>
