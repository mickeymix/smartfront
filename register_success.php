<?php  ob_start(); ?>
<?php  session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>ร้านไทยจราจร</title>

    <?php 
    require_once("header.php");
    require_once("account/login_user.php");
    ?>
</head>
<body>
    <div class="row">
    <br>
    <center><a href="index.php"><img src="images/DSC_6956-2.gif" width="50%" alt=""></a></center><br>
    </div>
</body>

<?php
include 'footer.php';
?>