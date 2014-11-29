<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2><?php echo $this->lang->line('authentication_general_register'); ?></h2>
<?php if (validation_errors() != false): ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php echo form_open('authentication/processregistration'); ?>
<div class="form-group <?php if (form_error('username') != false) echo "has-error"; ?>">
    <label class="control-label"
           for="username"><?php echo $this->lang->line('authentication_fields_username'); ?></label>
    <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>"
           id="username">
</div>
<div class="form-group <?php if (form_error('firstName') != false) echo "has-error"; ?>">
    <label class="control-label"
           for="firstName"><?php echo $this->lang->line('authentication_fields_firstname'); ?></label>
    <input type="text" class="form-control" name="firstName" value="<?php echo set_value('firstName'); ?>"
           id="firstName">
</div>
<div class="form-group <?php if (form_error('lastName') != false) echo "has-error"; ?>">
    <label class="control-label"
           for="lastName"><?php echo $this->lang->line('authentication_fields_lastname'); ?></label>
    <input type="text" class="form-control" name="lastName" value="<?php echo set_value('lastName'); ?>"
           id="lastName">
</div>
<div class="form-group <?php if (form_error('email') != false) echo "has-error"; ?>">
    <label class="control-label" for="email"><?php echo $this->lang->line('authentication_fields_email'); ?></label>
    <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" id="email">
</div>
<div class="form-group <?php if (form_error('password') != false) echo "has-error"; ?>">
    <label class="control-label"
           for="password"><?php echo $this->lang->line('authentication_fields_password'); ?></label>
    <input type="password" class="form-control" name="password" id="password">
</div>
<div class="form-group <?php if (form_error('passwordconfirmation') != false) echo "has-error"; ?>">
    <label class="control-label"
           for="passwordconfirmation"><?php echo $this->lang->line('authentication_fields_passwordconfirmation'); ?></label>
    <input type="password" class="form-control" name="passwordconfirmation" id="passwordconfirmation">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary"
           value="<?php echo $this->lang->line('authentication_general_register'); ?>"/>
    <input type="reset" class="btn btn-default"/>
</div>
<?php echo form_close(); ?>
