<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url();?>" />
	<title><?php echo $this->config->item('company') . ' | ' .  $this->lang->line('login_login'); ?></title>
		<!-- start css template tags -->
	<link rel="stylesheet" type="text/css" href="dist/login.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo 'dist/bootswatch/' . (empty($this->config->item('theme')) ? 'flatly' : $this->config->item('theme')) . '/bootstrap.min.css' ?>"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
	<!-- end css template tags -->
</head>

<body class="login-page login-page-red-light rtl rtl-inv">
 <div class="login-box">
		 <div class="login-logo">
					<img id="image" src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>" alt="company_logo" />
			           <!-- <img src="<?php echo base_url();?>/images/logo.png">-->
		 </div>
        <div class="login-box-body">
            
            <p class="login-box-msg"><?php echo $this->lang->line('login_to_account')?></p>
            <?php echo form_open('login'); ?>
			<div align="center" style="color:red"><?php echo validation_errors(); ?></div>
            <div class="form-group has-feedback">
                <input type="text" name="username" value="" class="form-control" placeholder="<?php echo $this->lang->line('login_username')?>" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" value="" class="form-control" placeholder="<?php echo $this->lang->line('login_password')?>" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
			

            

            <button type="submit" name="loginButton" class="btn btn-primary btn-block btn-flat"><i class="glyphicon glyphicon-log-in"></i> &nbsp;<?php echo $this->lang->line('sign_in')?></button>

            <?= form_close(); ?>

            <div class="">
                <p>&nbsp;</p>
                @<b>IPOS-<i>Powered by Infostrategy</i></b>
                </div>

            </div>
        </div>
		 
<script src="dist/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	
    <script src="dist/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            if ($('#identity').val())
                $('#password').focus();
            else
                $('#identity').focus();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>

	
</body>
</html>
