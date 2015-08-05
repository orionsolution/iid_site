<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IID > Log In</title>
<link href="<?php echo base_url(); ?>css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
// This adds 'placeholder' to the items listed in the jQuery .support object. 
jQuery(function() {
   jQuery.support.placeholder = false;
   test = document.createElement('input');
   if('placeholder' in test) jQuery.support.placeholder = true;
});
// This adds placeholder support to browsers that wouldn't otherwise support it. 
$(function() {
   if(!$.support.placeholder) { 
      var active = document.activeElement;
      $(':text, :password').focus(function () {
         if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
            $(this).val('').removeClass('hasPlaceholder');
         }
      }).blur(function () {
         if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
            $(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
         }
      });
      $(':text, :password').blur();
      $(active).focus();
      /*$('form:eq(0)').submit(function () {
         $(':text.hasPlaceholder, :password.hasPlaceholder').val('');
      });*/
   }
});
</script>
</head>

<body>
<!-- start of container -->
<div id="login_container">
	<div id="top">IID Pune &nbsp; <?php echo date("g : i A. "); ?> &nbsp;<?php echo date(" l. F j. Y"); ?><!--10 : 25 AM.   Thursday. 23. 2014--></div>
	<div id="loginbox">
		<h2>Sign in to your account</h2>
		<?php if(isset($error)) echo $error; ?>
        <form action="<?php echo base_url(); ?>login/verifylogin" method="post"  enctype="multipart/form-data" name="loginform" id="loginform">
			<input type="hidden" name="user_id" value="<?php echo isset($user["user_id"])?$user["user_id"]:'' ?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td align="left"><?php echo validation_errors(); ?></td>
			  </tr>
			  <tr>
				<td><input type="text" name="user" id="user" placeholder="Username" /></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><input type="password" name="pswd" id="pswd" placeholder="Password" /></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><input type="submit" value="Sign In" class="login" name="saveForm" id="saveForm" /></td>
			  </tr>
			  <tr>
				<td class="forgot"><a href="#">Forgot password?</a></td>
			  </tr>
			</table>
		</form>
	</div>
   
</div>
<!--end of container -->
</body>
</html>
		