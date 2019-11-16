<?php
session_start();
$code_error=$_SESSION["code_error"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="css/login.css" />
<script>
$(".user").focusin(function(){
  $(".inputUserIcon").css("color", "#e74c3c");
}).focusout(function(){
  $(".inputUserIcon").css("color", "white");
});

$(".pass").focusin(function(){
  $(".inputPassIcon").css("color", "#e74c3c");
}).focusout(function(){
  $(".inputPassIcon").css("color", "white");
});
</script>
</head>

<body>
<form action="checklogin.php" method="post">
  <h2><span class="entypo-login"></span> Login</h2>
  <button class="submit"><span class="entypo-lock"></span></button>
  <span class="entypo-user inputUserIcon"></span>
  <input name="username_log" type="text" class="user" id="username_log" placeholder="ursername"/>
  <span class="entypo-key inputPassIcon"></span>
  <input name="password_log" type="password" class="pass" id="password_log"placeholder="password"/>
</form>
<div style="text-align:center; color:#FF0000"><?php echo "$code_error";?></div>
</body>
</html>
