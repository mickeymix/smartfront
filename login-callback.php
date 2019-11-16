<?php
session_start();
ini_set('display_errors', 1);
include 'backoffice/conn.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");

// $result = mysqli_query($conn,$sql);
// $row = mysqli_fetch_array($result);
  // Check Exists ID
  $strSQL = "SELECT * FROM users WHERE facebook_id = '".$_POST["hdnFbID"]."' ";
  $objQuery = mysqli_query($conn ,$strSQL);
  $objResult = mysqli_fetch_array($objQuery);
  if($objResult)
  {
	  $_SESSION["facebook_id"] = $_POST["hdnFbID"];
	  $_SESSION["customer_name"] = $_POST["hdnName"];
	  header("location:index.php");
	  exit();
  }
  else
  {
	  // Create New ID
	  $digits = 4;
    $ranId = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
$startId = "SMART".$ranId."" ;

		  $strPicture = "https://graph.facebook.com/".$user['id']."/picture?type=large";

		  $strSQL ="  INSERT INTO  users (facebook_id	,firstname,email,facebook_image
		  ,facebook_link,user_type,insert_date,customer_user_login) 
			  VALUES
			  ('".trim($_POST["hdnFbID"])."',
				'".trim($_POST["hdnName"])."',
				'".trim($_POST["hdnEmail"])."',
			  '".trim($strPicture)."',
			  '".trim($user['link'])."',
			  'fb',
			  '".trim(date("Y-m-d H:i:s"))."',
			  '".trim($startId)."')";
		  $objQuery  = mysqli_query($conn ,$strSQL);

		  $_SESSION["facebook_id"] = $_POST["hdnFbID"];
		  $_SESSION["customer_name"] = $_POST["hdnName"];
		  header("location:index.php");
		  exit();
  }

  mysql_close();

?>