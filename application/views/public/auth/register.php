<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2>Register</h2>
<?php if (validation_errors() != false): ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php echo form_open('authentication/processregistration'); ?>
<div class="form-group <?php if(form_error('username') != false) echo "has-error"; ?>">
    <label class="control-label" for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>"
           id="username">
</div>
<div class="form-group <?php if(form_error('firstname') != false) echo "has-error"; ?>">
    <label class="control-label" for="firstname">First Name</label>
    <input type="text" class="form-control" name="firstname" value="<?php echo set_value('firstname'); ?>"
           id="firstname">
</div>
<div class="form-group <?php if(form_error('lastname') != false) echo "has-error"; ?>">
    <label class="control-label" for="username">Last Name</label>
    <input type="text" class="form-control" name="lastname" value="<?php echo set_value('lastname'); ?>"
           id="lastname">
</div>
<div class="form-group <?php if(form_error('email') != false) echo "has-error"; ?>">
    <label class="control-label" for="email">E-Mail Address</label>
    <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" id="email">
</div>
<div class="form-group <?php if(form_error('password') != false) echo "has-error"; ?>">
    <label class="control-label" for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password">
</div>
<div class="form-group <?php if(form_error('passwordconfirmation') != false) echo "has-error"; ?>">
    <label class="control-label" for="passwordconfirmation" >Password Confirmation</label>
    <input type="password" class="form-control" name="passwordconfirmation" id="passwordconfirmation">
</div>
<div class="form-group">
    <input type="reset" class="btn btn-default"/>
    <input type="submit" class="btn btn-primary"/>
</div>
<?php echo form_close(); ?>
