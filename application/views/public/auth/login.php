<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2><?php echo $title; ?></h2>
<?php echo form_open('authenticationcontroller/processlogin'); ?>
<div class="form-group">
    <label class="control-label" for="username">Username</label>
    <input type="text" class="form-control" id="username">
</div>
<div class="form-group">
    <label class="control-label" for="password">Password</label>
    <input type="password" class="form-control" id="password">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary"
           value="<?php echo $this->lang->line('authentication_general_login'); ?>"/>
    <input type="reset" class="btn btn-default"/>
</div>
<?php echo form_close(); ?>
